<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Models\TrainingSession;
use App\Models\User;
use App\Models\Branch;
use App\Models\Student;
use App\Models\Group;
use App\Models\Expense;
use App\Models\Income;
use App\Models\StudentAttendance;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $user     = Auth::user();
        $isGlobal = $user->hasRole(['super-admin', 'CEO']);
        $today = now()->toDateString();
        $range = $request->query('range', 'today'); // today|week|month|all

        // Branch: super-admin/CEO can pick freely; every other role is locked to their own branch
        $branchId = $isGlobal
            ? ($request->filled('branch_id') ? (int) $request->branch_id : null)
            : (int) $user->branch_id;

        // Shorthand helper: conditionally apply branch filter to any query builder
        $b = fn ($q) => $branchId ? $q->where('branch_id', $branchId) : $q;

        $totalteams = $b(Team::query())->count();
        // Determine date window
        $start = null; $end = null; $rangeLabel = 'Today';
        switch ($range) {
            case 'week':
                $start = now()->startOfWeek()->toDateString();
                $end = now()->endOfWeek()->toDateString();
                $rangeLabel = 'This Week';
                break;
            case 'month':
                $start = now()->startOfMonth()->toDateString();
                $end = now()->endOfMonth()->toDateString();
                $rangeLabel = 'This Month';
                break;
            case 'all':
                $start = $end = null;
                $rangeLabel = 'All Time';
                break;
            case 'today':
            default:
                $start = $today; $end = $today; $rangeLabel = 'Today';
        }

        // Sessions query for list and count
        $sessionListQuery = TrainingSession::with(['coach','branch','group'])
            ->when($start && $end, fn($q) => $q->whereBetween('date', [$start, $end]))
            ->when(($start && !$end) || (!$start && $end), fn($q) => $q->where('date', $start ?? $end))
            ->when(!$start && !$end, fn($q) => $q)
            ->when($branchId, fn($q) => $q->where('branch_id', $branchId))
            ->orderBy('date')
            ->orderBy('start_time');

        $sessionsForRange = (clone $sessionListQuery)->limit(8)->get();
        $sessionsCount = (clone $sessionListQuery)->count();

        // Stats
        // Use cached heavyweight aggregates; cache key includes branch so each role sees its own data
        $cacheKey = 'dashboard.metrics.' . ($branchId ?: 'all');
        $metrics = Cache::remember($cacheKey, 30, function () use ($b) {
            return [
                'incomeThisMonth' => $b(Income::whereBetween('received_at', [now()->startOfMonth(), now()->endOfMonth()]))->sum('amount_cents'),
                'totalIncome' => $b(Income::query())->sum('amount_cents'),
                'pendingExpenses' => $b(Expense::where('status', 'pending'))->count(),
                'totalExpensesThisMonth' => $b(Expense::whereIn('status', ['approved', 'paid'])
                    ->whereBetween('expense_date', [now()->startOfMonth(), now()->endOfMonth()]))->sum('amount_cents'),
                'totalExpenses' => $b(Expense::whereIn('status', ['approved', 'paid']))->sum('amount_cents'),
                // Capacity building aggregates (global — not branch-scoped)
                'capacityCount' => \App\Models\CapacityBuilding::count(),
                'capacityTotalCost' => \App\Models\CapacityBuilding::sum('cost_amount'),
                'capacityAverageCost' => (int) (\App\Models\CapacityBuilding::avg('cost_amount') ?? 0),
                'capacityMinCost' => (int) (\App\Models\CapacityBuilding::min('cost_amount') ?? 0),
                'capacityMaxCost' => (int) (\App\Models\CapacityBuilding::max('cost_amount') ?? 0),
            ];
        });

        $stats = [
            'gameSessionsToday' => $b(TrainingSession::where('date', $today))->count(),
            'upcomingSessions'  => $b(TrainingSession::where('date', '>=', $today))->count(),
            'completedSessions' => $b(TrainingSession::where('date', '<', $today))->count(),
            'totalUsers' => User::count(),
            'totalCoaches' => User::role('coach')->count(),
            'totalAdmins' => User::role('admin')->count(),
            'totalIncomeRecords' => $b(Income::query())->count(),
            'totalExpensesRecords' => $b(Expense::query())->count(),
            'totalSessions' => $b(TrainingSession::query())->count(),

            'totalteams' => $b(Team::query())->count(),

            'totalStudents' => $b(Student::query())->count(),
            'totalBranches' => Branch::count(),
            'activeStudents' => $b(Student::where('status', 'active'))->count(),
            'todaySessions' => $sessionsCount,
            'deactivatedUsers' => User::onlyTrashed()->count(),
            'coachUsers' => User::role('coach')->count(),
            'totalGroups' => $b(Group::query())->count(),
            'sessionsThisWeek' => $b(TrainingSession::whereBetween('date', [
                now()->startOfWeek()->toDateString(),
                now()->endOfWeek()->toDateString(),
            ]))->count(),
            // Income & Expense stats (from cache)
            'incomeThisMonth' => $metrics['incomeThisMonth'] ?? 0,
            'totalIncome' => $metrics['totalIncome'] ?? 0,
            'expensesThisMonth' => $metrics['totalExpensesThisMonth'] ?? 0,

            // Expenses (from cache)
            'pendingExpenses' => $metrics['pendingExpenses'] ?? 0,
            'totalExpensesThisMonth' => $metrics['totalExpensesThisMonth'] ?? 0,
            'totalExpenses' => $metrics['totalExpenses'] ?? 0,
            // Capacity building summary (costs stored as cents)
            'capacityCount' => $metrics['capacityCount'] ?? 0,
            'capacityTotalCost' => $metrics['capacityTotalCost'] ?? 0,
            'capacityAverageCost' => $metrics['capacityAverageCost'] ?? 0,
            'capacityMinCost' => $metrics['capacityMinCost'] ?? 0,
            'capacityMaxCost' => $metrics['capacityMaxCost'] ?? 0,

            // Staff module
            'totalStaff' => \App\Models\Staff::count(),
            'activeStaff' => \Illuminate\Support\Facades\Schema::hasColumn('staff', 'status')
                ? \App\Models\Staff::where('status', 'active')->count()
                : \App\Models\Staff::count(),

            // Minutes module
            'totalMinutes' => \App\Models\Minute::count(),
            'recentMinutes' => \Illuminate\Support\Facades\Schema::hasColumn('minutes', 'meeting_date')
                ? \App\Models\Minute::where('meeting_date', '>=', now()->subDays(30))->count()
                : \App\Models\Minute::where('created_at', '>=', now()->subDays(30))->count(),

            // Training records
            'totalTrainingRecords' => $b(\App\Models\TrainingSessionRecord::query())->count(),
            'recentTrainingRecords' => $b(\App\Models\TrainingSessionRecord::where('created_at', '>=', now()->subDays(30)))->count(),

            // Inhouse training
            'totalInhouseTraining' => $b(\App\Models\InhouseTraining::query())->count(),
            'upcomingInhouseTraining' => \Illuminate\Support\Facades\Schema::hasColumn('inhouse_trainings', 'training_date')
                ? $b(\App\Models\InhouseTraining::where('training_date', '>=', $today))->count()
                : 0,

            // Equipment breakdown
            'totalSportsEquipment' => $b(\App\Models\SportsEquipment::query())->count(),
            'totalOfficeEquipment' => $b(\App\Models\OfficeEquipment::query())->count(),

            // Communications
            'totalCommunications' => $b(\App\Models\Communication::query())->count(),
            'recentCommunications' => $b(\App\Models\Communication::where('created_at', '>=', now()->subDays(30)))->count(),

            // Tasks & Staff Tasks
            'totalTasks' => $b(\App\Models\Task::query())->count(),
            'totalStaffTasks' => $b(\App\Models\StaffTask::query())->count(),
            'pendingStaffTasks' => $b(\App\Models\StaffTask::where('status', 'pending'))->count(),
            'completedStaffTasks' => $b(\App\Models\StaffTask::where('status', 'completed'))->count(),
            'ongoingTasks' => $b(\App\Models\Task::where('end_date', '>=', $today))->count(),
            'completedTasks' => $b(\App\Models\Task::where('end_date', '<', $today))->count(),

            // Reports
            'totalReports' => $b(\App\Models\Report::query())->count(),

            // Games
            'totalGames' => $b(\App\Models\Game::query())->count(),
            'upcomingGames' => $b(\App\Models\Game::where('date', '>=', $today))->count(),

            // Attendance (check if tables exist first)
            'totalStudentAttendance' => \Illuminate\Support\Facades\Schema::hasTable('student_attendance')
                ? $b(\App\Models\StudentAttendance::query())->count()
                : 0,
            'totalCoachAttendance' => \Illuminate\Support\Facades\Schema::hasTable('coach_attendances')
                ? $b(\App\Models\CoachAttendance::query())->count()
                : 0,
            'totalStaffAttendance' => \Illuminate\Support\Facades\Schema::hasTable('staff_attendances')
                ? $b(\App\Models\StaffAttendance::query())->count()
                : 0,

            // Activity Plans
            'totalActivityPlans' => \Illuminate\Support\Facades\Schema::hasTable('activity_plans')
                ? $b(\App\Models\ActivityPlan::query())->count()
                : 0,

            // Upcoming Events
            'totalUpcomingEvents' => $b(\App\Models\UpcomingEvent::query())->count(),
            'futureEvents' => $b(\App\Models\UpcomingEvent::where('date', '>=', $today))->count(),
        ];

        // Calculate net profit (income - expenses)
        $netProfit = ($stats['incomeThisMonth'] ?? 0) - ($stats['totalExpensesThisMonth'] ?? 0);

        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        // Monthly Registrations (last 12 months for admin chart)
        $regLabels = [];
        $regCounts = [];
        for ($i = 11; $i >= 0; $i--) {
            $startM = now()->copy()->subMonths($i)->startOfMonth();
            $endM = now()->copy()->subMonths($i)->endOfMonth();
            $regLabels[] = $startM->format('M');
            $regCounts[] = (int) $b(Student::whereBetween('created_at', [$startM, $endM]))->count();
        }

        // Expense Categories breakdown for chart (scoped to branch)
        $expenseCategories = \App\Models\ExpenseCategory::withCount(['expenses' => function($q) use ($startOfMonth, $endOfMonth, $branchId) {
            $q->whereIn('status', ['approved', 'paid'])
              ->whereBetween('expense_date', [$startOfMonth, $endOfMonth]);
            if ($branchId) $q->where('branch_id', $branchId);
        }])->withSum(['expenses' => function($q) use ($startOfMonth, $endOfMonth, $branchId) {
            $q->whereIn('status', ['approved', 'paid'])
              ->whereBetween('expense_date', [$startOfMonth, $endOfMonth]);
            if ($branchId) $q->where('branch_id', $branchId);
        }], 'amount_cents')->get();

        $expenseCategoryLabels = $expenseCategories->pluck('name')->toArray();
        $expenseCategoryAmounts = $expenseCategories->map(fn($c) => (int) ($c->expenses_sum_amount_cents ?? 0))->toArray();

        // Performance Metrics (branch-scoped)
        $totalStudents = $b(Student::query())->count();
        $enrolledThisMonth = $b(Student::whereBetween('created_at', [$startOfMonth, $endOfMonth]))->count();
        $studentEnrollmentRate = $totalStudents > 0 ? round(($enrolledThisMonth / max(1, $totalStudents)) * 100, 1) : 0;

        $totalSessionsMonth = $b(TrainingSession::whereBetween('date', [$startOfMonth->toDateString(), $endOfMonth->toDateString()]))->count();
        $attendedSessionsMonth = $b(\App\Models\StudentAttendance::whereBetween('created_at', [$startOfMonth, $endOfMonth]))->count();
        $sessionAttendanceRate = $totalSessionsMonth > 0 ? round(($attendedSessionsMonth / $totalSessionsMonth) * 100, 1) : 0;

        // Income Target: compare this month income to last month (10% MoM growth target)
        $lastMonthIncome = $b(Income::whereBetween('received_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()]))->sum('amount_cents');
        $targetIncomeCents = (int) round($lastMonthIncome * 1.10);
        $incomeProgress = $targetIncomeCents > 0 ? round(($stats['incomeThisMonth'] ?? 0) * 100 / $targetIncomeCents, 1) : 0;

        // Equipment Status: percentage in use vs total
        $equipmentTotal = $b(\App\Models\Equipment::query())->count();
        $equipmentInUse = $b(\App\Models\Equipment::where('status', 'in_use'))->count();
        $equipmentUtilPct = $equipmentTotal > 0 ? round(($equipmentInUse / $equipmentTotal) * 100, 1) : 0;

        // Additional trend data for charts: last 8 weeks of sessions
        $weeklyTrends = [];
        for ($i = 7; $i >= 0; $i--) {
            $weekStart = now()->subWeeks($i)->startOfWeek();
            $weekEnd   = now()->subWeeks($i)->endOfWeek();
            $count = $b(TrainingSession::whereBetween('date', [$weekStart->toDateString(), $weekEnd->toDateString()]))->count();
            $weeklyTrends[] = [
                'label' => $weekStart->format('M d'),
                'sessions' => $count,
            ];
        }

        // Coach workload (top 5 coaches by session count this month)
        $coachWorkloadQuery = TrainingSession::selectRaw('coach_user_id, COUNT(*) as session_count')
            ->whereBetween('date', [now()->startOfMonth()->toDateString(), now()->endOfMonth()->toDateString()])
            ->whereNotNull('coach_user_id');
        if ($branchId) {
            $coachWorkloadQuery->where('branch_id', $branchId);
        }
        $coachWorkload = $coachWorkloadQuery
            ->groupBy('coach_user_id')
            ->orderByDesc('session_count')
            ->limit(5)
            ->with('coach:id,name')
            ->get()
            ->map(fn($item) => [
                'coach' => $item->coach->name ?? 'Unknown',
                'sessions' => $item->session_count,
            ]);

        // Equipment utilization
        $equipmentCount       = $b(\App\Models\Equipment::query())->count();
        $equipmentInUse       = $b(\App\Models\Equipment::where('status', 'in_use'))->count();
        $equipmentUtilization = $equipmentCount > 0 ? round(($equipmentInUse / $equipmentCount) * 100, 1) : 0;

        // Capacity building monthly totals (last 12 months)
        $dateFormat = config('database.default') === 'sqlite'
            ? "strftime('%Y-%m', start_date)"
            : "DATE_FORMAT(start_date, '%Y-%m')";
        $capacityByMonth = \App\Models\CapacityBuilding::selectRaw("{$dateFormat} as month, SUM(cost_amount) as total")
            ->whereNotNull('start_date')
            ->whereBetween('start_date', [now()->subMonths(11)->startOfMonth()->toDateString(), now()->endOfMonth()->toDateString()])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $capacityMonthlyLabels = $capacityByMonth->pluck('month')->toArray();
        // RWF values - no conversion needed
        $capacityMonthlyTotals = $capacityByMonth->pluck('total')->map(fn($v) => (float) $v)->toArray();

        // Finance time series (last 12 months): incomes, expenses, netflow
        $financeStart = now()->subMonths(11)->startOfMonth()->toDateString();
        $financeEnd = now()->endOfMonth()->toDateString();

        // Incomes by month (Income model)
        $incomeDateFormat = config('database.default') === 'sqlite'
            ? "strftime('%Y-%m', received_at)"
            : "DATE_FORMAT(received_at, '%Y-%m')";
        $incomesByMonth = $b(\App\Models\Income::selectRaw("{$incomeDateFormat} as month, SUM(amount_cents) as total")
            ->whereNotNull('received_at')
            ->whereBetween('received_at', [$financeStart, $financeEnd]))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        // Expenses (approved/paid)
        $expenseDateFormat = config('database.default') === 'sqlite'
            ? "strftime('%Y-%m', expense_date)"
            : "DATE_FORMAT(expense_date, '%Y-%m')";
        $expensesByMonth = $b(\App\Models\Expense::selectRaw("{$expenseDateFormat} as month, SUM(amount_cents) as total")
            ->whereIn('status', ['approved', 'paid'])
            ->whereNotNull('expense_date')
            ->whereBetween('expense_date', [$financeStart, $financeEnd]))
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        // Build 12-month label array (YYYY-MM)
        $financeLabels = [];
        $period = now()->subMonths(11);
        for ($i = 0; $i < 12; $i++) {
            $financeLabels[] = $period->copy()->addMonths($i)->format('Y-m');
        }

        $incomeTotals = [];
        $expenseTotals = [];
        foreach ($financeLabels as $m) {
            $income = (isset($incomesByMonth[$m]) ? $incomesByMonth[$m]->total : 0); // RWF
            $expense = (isset($expensesByMonth[$m]) ? $expensesByMonth[$m]->total : 0);
            $incomeTotals[] = (float) $income;
            $expenseTotals[] = (float) $expense;
        }

        $netflowTotals = array_map(fn($inc, $exp) => round($inc - $exp, 2), $incomeTotals, $expenseTotals);

        return view('admin.dashboard', [
            'totalteams' => $totalteams,
            'todaysSessions' => $sessionsForRange,
            'sessions' => $sessionsForRange,
            'rangeLabel' => $rangeLabel,
            'currentRange' => $range,
            'currentBranchId' => $branchId,
            'branches' => $isGlobal ? Branch::orderBy('name')->get() : Branch::where('id', $branchId)->get(),
            'netProfit' => $netProfit,
            'weeklyTrends' => $weeklyTrends,
            'coachWorkload' => $coachWorkload,
            'equipmentUtilization' => $equipmentUtilization,
            'stats' => array_merge($stats, [
                'totalEquipment' => $equipmentCount,
            ]),
            'capacityMonthlyLabels' => $capacityMonthlyLabels ?? [],
            'capacityMonthlyTotals' => $capacityMonthlyTotals ?? [],
            // Finance chart data
            'financeLabels' => $financeLabels ?? [],
            'incomeTotals' => $incomeTotals ?? [],
            'expenseTotals' => $expenseTotals ?? [],
            'netflowTotals' => $netflowTotals ?? [],
            'recentStudents' => $b(Student::orderBy('created_at', 'desc'))->limit(10)->get(),
            'todayAttendances' => $b(StudentAttendance::with('student')
                ->whereDate('attendance_date', now()->toDateString())
                ->orderBy('created_at', 'desc'))->limit(20)->get(),
            'todayAttendanceStats' => [
                'total'   => $b(StudentAttendance::whereDate('attendance_date', now()->toDateString()))->count(),
                'present' => $b(StudentAttendance::whereDate('attendance_date', now()->toDateString())->where('status', 'present'))->count(),
                'absent'  => $b(StudentAttendance::whereDate('attendance_date', now()->toDateString())->where('status', 'absent'))->count(),
                'late'    => $b(StudentAttendance::whereDate('attendance_date', now()->toDateString())->where('status', 'late'))->count(),
                'excused' => $b(StudentAttendance::whereDate('attendance_date', now()->toDateString())->where('status', 'excused'))->count(),
            ],
            'todayIncomes' => $b(Income::with(['branch', 'recordedBy'])
                ->whereDate('received_at', now()->toDateString())
                ->orderBy('received_at', 'desc'))->limit(20)->get(),
            'todayIncomeStats' => [
                'total' => $b(Income::whereDate('received_at', now()->toDateString()))->sum('amount_cents'),
                'count' => $b(Income::whereDate('received_at', now()->toDateString()))->count(),
            ],
            // Finance Summary by Period (Daily, Weekly, Monthly, Yearly)
            'financeStats' => [
                'daily' => [
                    'income'   => $b(Income::whereDate('received_at', now()->toDateString()))->sum('amount_cents'),
                    'expenses' => $b(Expense::whereIn('status', ['approved', 'paid'])->whereDate('expense_date', now()->toDateString()))->sum('amount_cents'),
                ],
                'weekly' => [
                    'income'   => $b(Income::whereBetween('received_at', [now()->startOfWeek(), now()->endOfWeek()]))->sum('amount_cents'),
                    'expenses' => $b(Expense::whereIn('status', ['approved', 'paid'])->whereBetween('expense_date', [now()->startOfWeek(), now()->endOfWeek()]))->sum('amount_cents'),
                ],
                'monthly' => [
                    'income'   => $b(Income::whereBetween('received_at', [now()->startOfMonth(), now()->endOfMonth()]))->sum('amount_cents'),
                    'expenses' => $b(Expense::whereIn('status', ['approved', 'paid'])->whereBetween('expense_date', [now()->startOfMonth(), now()->endOfMonth()]))->sum('amount_cents'),
                ],
                'yearly' => [
                    'income'   => $b(Income::whereBetween('received_at', [now()->startOfYear(), now()->endOfYear()]))->sum('amount_cents'),
                    'expenses' => $b(Expense::whereIn('status', ['approved', 'paid'])->whereBetween('expense_date', [now()->startOfYear(), now()->endOfYear()]))->sum('amount_cents'),
                ],
            ],
            // Admin charts real data
            'regLabels' => $regLabels,
            'regCounts' => $regCounts,
            // Expense categories chart
            'expenseCategoryLabels' => $expenseCategoryLabels ?? [],
            'expenseCategoryAmounts' => $expenseCategoryAmounts ?? [],
            // Performance metrics
            'studentEnrollmentRate' => $studentEnrollmentRate,
            'sessionAttendanceRate' => $sessionAttendanceRate,
            'incomeProgress' => $incomeProgress ?? 0,
            'equipmentUtilPct' => $equipmentUtilPct,
        ]);
    }
}
