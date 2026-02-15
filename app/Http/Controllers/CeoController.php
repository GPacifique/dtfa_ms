<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use App\Models\Payment;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Student;
use App\Models\User;
use App\Models\Branch;
use App\Models\Group;
use App\Models\TrainingSession;
use App\Models\StudentAttendance;
use Barryvdh\DomPDF\Facade\Pdf;

class CeoController extends Controller
{
    public function index(Request $request)
    {
        // Handle filters
        $dateRange = $request->get('date_range', 'this_month');
        $branchFilter = $request->get('branch_id');

        // Calculate date ranges based on filter
        [$startDate, $endDate] = $this->getDateRange($dateRange);

        $today = now()->toDateString();
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        // Apply branch filter to queries
        $branchQuery = function($query) use ($branchFilter) {
            if ($branchFilter) {
                $query->whereHas('student', function($q) use ($branchFilter) {
                    $q->where('branch_id', $branchFilter);
                });
            }
        };

        // Cache heavy aggregates briefly
        $cacheKey = 'ceo.metrics.' . $dateRange . '.' . ($branchFilter ?? 'all');
        $metrics = Cache::remember($cacheKey, 30, function () use ($startDate, $endDate, $branchQuery, $startOfMonth, $endOfMonth) {
            $revenueThisMonth = Payment::where('status', 'succeeded')
                ->whereBetween('paid_at', [$startDate, $endDate])
                ->when($branchQuery, $branchQuery)
                ->sum('amount_cents');
            $totalRevenue = Payment::where('status', 'succeeded')
                ->when($branchQuery, $branchQuery)
                ->sum('amount_cents');

            $otherIncomeThisMonth = Income::whereBetween('received_at', [$startDate, $endDate])->sum('amount_cents');
            $totalOtherIncome = Income::sum('amount_cents');

            $expensesThisMonth = Expense::whereIn('status', ['approved', 'paid'])
                ->whereBetween('expense_date', [$startDate, $endDate])
                ->sum('amount_cents');
            $totalExpenses = Expense::whereIn('status', ['approved', 'paid'])->sum('amount_cents');

            return compact('revenueThisMonth', 'totalRevenue', 'otherIncomeThisMonth', 'totalOtherIncome', 'expensesThisMonth', 'totalExpenses');
        });

        $netProfitThisMonth = (($metrics['revenueThisMonth'] ?? 0) + ($metrics['otherIncomeThisMonth'] ?? 0)) - ($metrics['expensesThisMonth'] ?? 0);

        // MoM revenue change
        $lastMonthStart = now()->subMonth()->startOfMonth();
        $lastMonthEnd = now()->subMonth()->endOfMonth();
        $lastMonthRevenue = Payment::where('status', 'succeeded')
            ->whereBetween('paid_at', [$lastMonthStart, $lastMonthEnd])
            ->when($branchQuery, $branchQuery)
            ->sum('amount_cents');
        $revenueChange = $lastMonthRevenue > 0 ? round((($metrics['revenueThisMonth'] - $lastMonthRevenue) / $lastMonthRevenue) * 100, 1) : 0;
        $revenueChangeDirection = ($metrics['revenueThisMonth'] ?? 0) >= $lastMonthRevenue ? 'up' : 'down';

        // Org stats with filters
        $orgStats = [
            'totalStudents' => Student::when($branchFilter, function($q) use ($branchFilter) {
                $q->where('branch_id', $branchFilter);
            })->count(),
            'activeStudents' => Student::where('status', 'active')
                ->when($branchFilter, function($q) use ($branchFilter) {
                    $q->where('branch_id', $branchFilter);
                })->count(),
            'totalUsers' => User::count(),
            'totalCoaches' => User::role('coach')->count(),
            'totalBranches' => Branch::count(),
            'totalGroups' => Group::when($branchFilter, function($q) use ($branchFilter) {
                $q->where('branch_id', $branchFilter);
            })->count(),
            'sessionsThisWeek' => TrainingSession::whereBetween('date', [now()->startOfWeek()->toDateString(), now()->endOfWeek()->toDateString()])
                ->when($branchFilter, function($q) use ($branchFilter) {
                    $q->where('branch_id', $branchFilter);
                })->count(),
        ];

        // New metrics
        $newMetrics = $this->calculateNewMetrics($branchFilter, $startDate, $endDate);

        // Top branches by revenue this month (via student branch)
        $topBranchRows = DB::table('payments')
            ->join('students', 'payments.student_id', '=', 'students.id')
            ->where('payments.status', 'succeeded')
            ->whereBetween('payments.paid_at', [$startDate, $endDate])
            ->whereNotNull('students.branch_id')
            ->when($branchFilter, function($q) use ($branchFilter) {
                $q->where('students.branch_id', $branchFilter);
            })
            ->groupBy('students.branch_id')
            ->orderByDesc(DB::raw('SUM(payments.amount_cents)'))
            ->limit(5)
            ->select('students.branch_id', DB::raw('SUM(payments.amount_cents) as total'))
            ->get();
        $branchNames = Branch::whereIn('id', $topBranchRows->pluck('branch_id')->all())
            ->pluck('name', 'id');
        $topBranches = $topBranchRows->map(function ($row) use ($branchNames) {
            return [
                'branch' => $branchNames[$row->branch_id] ?? 'Unknown',
                'total' => (int) $row->total,
            ];
        });

        // Recent sessions snapshot
        $upcomingSessions = TrainingSession::with(['coach','group','branch'])
            ->where('date', '>=', $today)
            ->when($branchFilter, function($q) use ($branchFilter) {
                $q->where('branch_id', $branchFilter);
            })
            ->orderBy('date')
            ->orderBy('start_time')
            ->limit(6)
            ->get();

        // Chart data - Revenue trend (last 6 months)
        $revenueTrend = $this->getRevenueTrend($branchFilter);

        // Chart data - Student growth (last 6 months)
        $studentGrowth = $this->getStudentGrowth($branchFilter);

        // Chart data - Expense breakdown
        $expenseBreakdown = $this->getExpenseBreakdown($startDate, $endDate);

        // Breakdown statistics
        $statsBySport = $this->getStatsBySport($branchFilter);
        $statsByBranch = $this->getStatsByBranch();
        $statsByGender = $this->getStatsByGender($branchFilter);
        $statsByGroup = $this->getStatsByGroup($branchFilter, $startDate, $endDate);

        // All branches for filter
        $branches = Branch::orderBy('name')->get();

        return view('ceo.dashboard', [
            'metrics' => $metrics,
            'netProfitThisMonth' => $netProfitThisMonth,
            'revenueChange' => $revenueChange,
            'revenueChangeDirection' => $revenueChangeDirection,
            'orgStats' => $orgStats,
            'newMetrics' => $newMetrics,
            'topBranches' => $topBranches,
            'upcomingSessions' => $upcomingSessions,
            'revenueTrend' => $revenueTrend,
            'studentGrowth' => $studentGrowth,
            'expenseBreakdown' => $expenseBreakdown,
            'statsBySport' => $statsBySport,
            'statsByBranch' => $statsByBranch,
            'statsByGender' => $statsByGender,
            'statsByGroup' => $statsByGroup,
            'branches' => $branches,
            'selectedBranch' => $branchFilter,
            'dateRange' => $dateRange,
        ]);
    }

    protected function getDateRange($dateRange)
    {
        return match($dateRange) {
            'today' => [now()->startOfDay(), now()->endOfDay()],
            'this_week' => [now()->startOfWeek(), now()->endOfWeek()],
            'this_month' => [now()->startOfMonth(), now()->endOfMonth()],
            'last_month' => [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()],
            'this_quarter' => [now()->startOfQuarter(), now()->endOfQuarter()],
            'this_year' => [now()->startOfYear(), now()->endOfYear()],
            'last_year' => [now()->subYear()->startOfYear(), now()->subYear()->endOfYear()],
            default => [now()->startOfMonth(), now()->endOfMonth()],
        };
    }

    protected function calculateNewMetrics($branchFilter, $startDate, $endDate)
    {
        // Attendance rate - based on student attendance records
        $totalSessions = TrainingSession::whereBetween('date', [$startDate, $endDate])
            ->when($branchFilter, function($q) use ($branchFilter) {
                $q->where('branch_id', $branchFilter);
            })->count();

        // Count present attendances in date range
        $totalAttendances = StudentAttendance::whereBetween('attendance_date', [$startDate, $endDate])
            ->where('status', 'present')
            ->when($branchFilter, function($q) use ($branchFilter) {
                $q->whereHas('student', function($sq) use ($branchFilter) {
                    $sq->where('branch_id', $branchFilter);
                });
            })->count();

        // Calculate expected attendances based on sessions and group sizes
        $sessions = TrainingSession::whereBetween('date', [$startDate, $endDate])
            ->when($branchFilter, function($q) use ($branchFilter) {
                $q->where('branch_id', $branchFilter);
            })
            ->with('group.students')
            ->get();

        $expectedAttendances = $sessions->sum(function($session) {
            return $session->group ? $session->group->students()->count() : 0;
        });

        $attendanceRate = $expectedAttendances > 0 ? round(($totalAttendances / $expectedAttendances) * 100, 1) : 0;

        // Student retention rate (students active for > 3 months)
        $threeMonthsAgo = now()->subMonths(3);
        $retainedStudents = Student::where('status', 'active')
            ->where('created_at', '<=', $threeMonthsAgo)
            ->when($branchFilter, function($q) use ($branchFilter) {
                $q->where('branch_id', $branchFilter);
            })->count();

        $totalOldStudents = Student::where('created_at', '<=', $threeMonthsAgo)
            ->when($branchFilter, function($q) use ($branchFilter) {
                $q->where('branch_id', $branchFilter);
            })->count();

        $retentionRate = $totalOldStudents > 0 ? round(($retainedStudents / $totalOldStudents) * 100, 1) : 0;

        // Average revenue per student
        $activeStudentsCount = Student::where('status', 'active')
            ->when($branchFilter, function($q) use ($branchFilter) {
                $q->where('branch_id', $branchFilter);
            })->count();

        $totalRevenueFiltered = Payment::where('status', 'succeeded')
            ->whereBetween('paid_at', [$startDate, $endDate])
            ->when($branchFilter, function($q) use ($branchFilter) {
                $q->whereHas('student', function($sq) use ($branchFilter) {
                    $sq->where('branch_id', $branchFilter);
                });
            })->sum('amount_cents');

        $avgRevenuePerStudent = $activeStudentsCount > 0 ? round($totalRevenueFiltered / $activeStudentsCount) : 0;

        // Student growth rate (last 30 days)
        $thirtyDaysAgo = now()->subDays(30);
        $newStudents = Student::where('created_at', '>=', $thirtyDaysAgo)
            ->when($branchFilter, function($q) use ($branchFilter) {
                $q->where('branch_id', $branchFilter);
            })->count();

        $studentsBeforeThirtyDays = Student::where('created_at', '<', $thirtyDaysAgo)
            ->when($branchFilter, function($q) use ($branchFilter) {
                $q->where('branch_id', $branchFilter);
            })->count();

        $growthRate = $studentsBeforeThirtyDays > 0 ? round(($newStudents / $studentsBeforeThirtyDays) * 100, 1) : 0;

        return [
            'attendanceRate' => $attendanceRate,
            'retentionRate' => $retentionRate,
            'avgRevenuePerStudent' => $avgRevenuePerStudent,
            'growthRate' => $growthRate,
            'newStudents' => $newStudents,
        ];
    }

    protected function getRevenueTrend($branchFilter)
    {
        $months = [];
        $revenues = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $startOfMonth = $date->copy()->startOfMonth();
            $endOfMonth = $date->copy()->endOfMonth();

            $revenue = Payment::where('status', 'succeeded')
                ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
                ->when($branchFilter, function($q) use ($branchFilter) {
                    $q->whereHas('student', function($sq) use ($branchFilter) {
                        $sq->where('branch_id', $branchFilter);
                    });
                })
                ->sum('amount_cents');

            $months[] = $date->format('M Y');
            $revenues[] = $revenue / 100; // Convert to regular units
        }

        return ['labels' => $months, 'data' => $revenues];
    }

    protected function getStudentGrowth($branchFilter)
    {
        $months = [];
        $counts = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $endOfMonth = $date->copy()->endOfMonth();

            $count = Student::where('created_at', '<=', $endOfMonth)
                ->when($branchFilter, function($q) use ($branchFilter) {
                    $q->where('branch_id', $branchFilter);
                })
                ->count();

            $months[] = $date->format('M Y');
            $counts[] = $count;
        }

        return ['labels' => $months, 'data' => $counts];
    }

    protected function getExpenseBreakdown($startDate, $endDate)
    {
        $expenses = Expense::whereIn('status', ['approved', 'paid'])
            ->whereBetween('expense_date', [$startDate, $endDate])
            ->selectRaw('category, SUM(amount_cents) as total')
            ->groupBy('category')
            ->get();

        $labels = [];
        $data = [];

        foreach ($expenses as $expense) {
            $labels[] = ucfirst($expense->category ?? 'Uncategorized');
            $data[] = $expense->total / 100;
        }

        return ['labels' => $labels, 'data' => $data];
    }

    public function exportPdf(Request $request)
    {
        // Get same data as dashboard but without caching
        $dateRange = $request->get('date_range', 'this_month');
        $branchFilter = $request->get('branch_id');

        [$startDate, $endDate] = $this->getDateRange($dateRange);

        // Gather all metrics (simplified version for PDF)
        $data = [
            'dateRange' => $dateRange,
            'startDate' => $startDate->format('M d, Y'),
            'endDate' => $endDate->format('M d, Y'),
            'generatedAt' => now()->format('M d, Y H:i:s'),
        ];

        // Add metrics and stats
        // (You can expand this with more details as needed)

        $pdf = Pdf::loadView('ceo.dashboard-pdf', $data);
        return $pdf->download('ceo-dashboard-' . now()->format('Y-m-d') . '.pdf');
    }

    public function exportCsv(Request $request)
    {
        $dateRange = $request->get('date_range', 'this_month');
        $branchFilter = $request->get('branch_id');

        [$startDate, $endDate] = $this->getDateRange($dateRange);

        $payments = Payment::where('status', 'succeeded')
            ->whereBetween('paid_at', [$startDate, $endDate])
            ->when($branchFilter, function($q) use ($branchFilter) {
                $q->whereHas('student', function($sq) use ($branchFilter) {
                    $sq->where('branch_id', $branchFilter);
                });
            })
            ->with('student')
            ->get();

        $filename = 'ceo-financial-data-' . now()->format('Y-m-d') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($payments) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Date', 'Student', 'Amount (RWF)', 'Status', 'Payment Method']);

            foreach ($payments as $payment) {
                fputcsv($file, [
                    $payment->paid_at ? $payment->paid_at->format('Y-m-d') : '',
                    $payment->student ? $payment->student->name : '',
                    $payment->amount_cents / 100,
                    $payment->status,
                    $payment->payment_method ?? 'N/A',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    protected function getStatsBySport($branchFilter)
    {
        $stats = Student::selectRaw('sport_discipline,
                                     COUNT(*) as total_students,
                                     SUM(CASE WHEN status = "active" THEN 1 ELSE 0 END) as active_students')
            ->when($branchFilter, function($q) use ($branchFilter) {
                $q->where('branch_id', $branchFilter);
            })
            ->whereNotNull('sport_discipline')
            ->where('sport_discipline', '!=', '')
            ->groupBy('sport_discipline')
            ->orderByDesc('total_students')
            ->get()
            ->map(function($stat) {
                return [
                    'sport' => $stat->sport_discipline,
                    'total' => $stat->total_students,
                    'active' => $stat->active_students,
                ];
            });

        return $stats;
    }

    protected function getStatsByBranch()
    {
        $stats = Branch::withCount([
                'students as total_students',
                'students as active_students' => function($q) {
                    $q->where('status', 'active');
                },
                'groups as groups_count'
            ])
            ->with(['students' => function($q) {
                $q->select('branch_id', 'id')
                  ->with(['payments' => function($pq) {
                      $pq->where('status', 'succeeded')
                         ->whereBetween('paid_at', [now()->startOfMonth(), now()->endOfMonth()]);
                  }]);
            }])
            ->orderBy('name')
            ->get()
            ->map(function($branch) {
                $revenue = $branch->students->sum(function($student) {
                    return $student->payments->sum('amount_cents');
                });

                return [
                    'name' => $branch->name,
                    'total_students' => $branch->total_students,
                    'active_students' => $branch->active_students,
                    'revenue' => $revenue,
                    'groups' => $branch->groups_count,
                ];
            });

        return $stats;
    }

    protected function getStatsByGender($branchFilter)
    {
        $stats = Student::selectRaw('gender,
                                     COUNT(*) as total_students,
                                     SUM(CASE WHEN status = "active" THEN 1 ELSE 0 END) as active_students')
            ->when($branchFilter, function($q) use ($branchFilter) {
                $q->where('branch_id', $branchFilter);
            })
            ->whereNotNull('gender')
            ->where('gender', '!=', '')
            ->groupBy('gender')
            ->orderByDesc('total_students')
            ->get()
            ->map(function($stat) {
                return [
                    'gender' => $stat->gender,
                    'total' => $stat->total_students,
                    'active' => $stat->active_students,
                    'percentage' => 0, // Will be calculated in view
                ];
            });

        $totalCount = $stats->sum('total');
        return $stats->map(function($stat) use ($totalCount) {
            $stat['percentage'] = $totalCount > 0 ? round(($stat['total'] / $totalCount) * 100, 1) : 0;
            return $stat;
        });
    }

    protected function getStatsByGroup($branchFilter, $startDate, $endDate)
    {
        $stats = Group::withCount([
                'students as total_students',
                'students as active_students' => function($q) {
                    $q->where('status', 'active');
                }
            ])
            ->with(['branch', 'students' => function($q) use ($startDate, $endDate) {
                $q->select('group_id', 'id')
                  ->with(['payments' => function($pq) use ($startDate, $endDate) {
                      $pq->where('status', 'succeeded')
                         ->whereBetween('paid_at', [$startDate, $endDate]);
                  }]);
            }])
            ->when($branchFilter, function($q) use ($branchFilter) {
                $q->where('branch_id', $branchFilter);
            })
            ->orderBy('name')
            ->get()
            ->map(function($group) {
                $revenue = $group->students->sum(function($student) {
                    return $student->payments->sum('amount_cents');
                });

                return [
                    'name' => $group->name,
                    'branch' => $group->branch ? $group->branch->name : 'N/A',
                    'total_students' => $group->total_students,
                    'active_students' => $group->active_students,
                    'revenue' => $revenue,
                ];
            });

        return $stats;
    }
}
