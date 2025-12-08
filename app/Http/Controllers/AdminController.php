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
use App\Models\Payment;
use App\Models\Subscription;
use App\Models\Invoice;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $today = now()->toDateString();
        $range = $request->query('range', 'today'); // today|week|month|all
        $branchId = $request->query('branch_id');
 $totalteams = Team::count();
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
        // Use cached heavyweight aggregates when possible to reduce DB load
        $metrics = Cache::remember('dashboard.metrics', 30, function () {
            return [
                'revenueThisMonth' => Payment::where('status', 'succeeded')
                    ->whereBetween('paid_at', [now()->startOfMonth(), now()->endOfMonth()])
                    ->sum('amount_cents'),
                'totalRevenue' => Payment::where('status', 'succeeded')->sum('amount_cents'),
                'incomeThisMonth' => Income::whereBetween('received_at', [now()->startOfMonth(), now()->endOfMonth()])->sum('amount_cents'),
                'totalIncome' => Income::sum('amount_cents'),
                'subscriptionRevenueThisMonth' => Payment::whereNotNull('subscription_id')
                    ->where('status', 'succeeded')
                    ->whereBetween('paid_at', [now()->startOfMonth(), now()->endOfMonth()])
                    ->sum('amount_cents'),
                'totalSubscriptionRevenue' => Payment::whereNotNull('subscription_id')
                    ->where('status', 'succeeded')
                    ->sum('amount_cents'),
                'pendingExpenses' => Expense::where('status', 'pending')->count(),
                'totalExpensesThisMonth' => Expense::whereIn('status', ['approved', 'paid'])
                    ->whereBetween('expense_date', [now()->startOfMonth(), now()->endOfMonth()])
                    ->sum('amount_cents'),
                'totalExpenses' => Expense::whereIn('status', ['approved', 'paid'])->sum('amount_cents'),
                // Capacity building aggregates
                'capacityCount' => \App\Models\CapacityBuilding::count(),
                'capacityTotalCost' => \App\Models\CapacityBuilding::sum('cost_amount'),
                'capacityAverageCost' => (int) (\App\Models\CapacityBuilding::avg('cost_amount') ?? 0),
                'capacityMinCost' => (int) (\App\Models\CapacityBuilding::min('cost_amount') ?? 0),
                'capacityMaxCost' => (int) (\App\Models\CapacityBuilding::max('cost_amount') ?? 0),
            ];
        });

        $stats = [
            'gameSessionsToday' => TrainingSession::where('date', $today)->count(),
            'upcomingSessions' => TrainingSession::where('date', '>=', $today)->count(),
            'completedSessions' => TrainingSession::where('date', '<', $today)->count(),
            'totalUsers' => User::count(),
            'totalCoaches' => User::role('coach')->count(),
            'totalAdmins' => User::role('admin')->count(),
            'totalPayments' => Payment::where('status', 'succeeded')->count(),
            'totalIncomeRecords' => Income::count(),
            'totalExpensesRecords' => Expense::count(),
            'totalSessions' => TrainingSession::count(),

             'totalteams' => Team::count(),

            'totalStudents' => Student::count(),
            'totalBranches' => Branch::count(),
            'activeStudents' => Student::where('status', 'active')->count(),
            'todaySessions' => $sessionsCount,
            'deactivatedUsers' => User::onlyTrashed()->count(),
            'coachUsers' => User::role('coach')->count(),
            'totalGroups' => Group::count(),
            'sessionsThisWeek' => TrainingSession::whereBetween('date', [
                now()->startOfWeek()->toDateString(),
                now()->endOfWeek()->toDateString(),
            ])->count(),
            // Payment & Subscription stats (from cache)
            'activeSubscriptions' => Subscription::where('status', 'active')->count(),
            'totalSubscriptions' => Subscription::count(),
            'revenueThisMonth' => $metrics['revenueThisMonth'] ?? 0,
            'incomeThisMonth' => $metrics['incomeThisMonth'] ?? 0,
            'totalIncome' => $metrics['totalIncome'] ?? 0,
            'subscriptionRevenueThisMonth' => $metrics['subscriptionRevenueThisMonth'] ?? 0,
            'totalSubscriptionRevenue' => $metrics['totalSubscriptionRevenue'] ?? 0,
            'pendingInvoices' => Invoice::whereIn('status', ['pending', 'overdue'])->count(),
            'totalRevenue' => $metrics['totalRevenue'] ?? 0,

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
            'totalTrainingRecords' => \App\Models\TrainingSessionRecord::count(),
            'recentTrainingRecords' => \App\Models\TrainingSessionRecord::where('created_at', '>=', now()->subDays(30))->count(),

            // Inhouse training
            'totalInhouseTraining' => \App\Models\InhouseTraining::count(),
            'upcomingInhouseTraining' => \Illuminate\Support\Facades\Schema::hasColumn('inhouse_trainings', 'training_date')
                ? \App\Models\InhouseTraining::where('training_date', '>=', $today)->count()
                : 0,

            // Equipment breakdown
            'totalSportsEquipment' => \App\Models\SportsEquipment::count(),
            'totalOfficeEquipment' => \App\Models\OfficeEquipment::count(),

            // Communications
            'totalCommunications' => \App\Models\Communication::count(),
            'recentCommunications' => \App\Models\Communication::where('created_at', '>=', now()->subDays(30))->count(),

            // Tasks & Staff Tasks
            'totalTasks' => \App\Models\Task::count(),
            'totalStaffTasks' => \App\Models\StaffTask::count(),
            'pendingStaffTasks' => \App\Models\StaffTask::where('status', 'pending')->count(),
            'completedStaffTasks' => \App\Models\StaffTask::where('status', 'completed')->count(),
            'ongoingTasks' => \App\Models\Task::where('end_date', '>=', $today)->count(),
            'completedTasks' => \App\Models\Task::where('end_date', '<', $today)->count(),

            // Reports
            'totalReports' => \App\Models\Report::count(),

            // Games
            'totalGames' => \App\Models\Game::count(),
            'upcomingGames' => \App\Models\Game::where('date', '>=', $today)->count(),

            // Attendance
            'totalStudentAttendance' => \App\Models\StudentAttendance::count(),
            'totalCoachAttendance' => \App\Models\CoachAttendance::count(),
            'totalStaffAttendance' => \App\Models\StaffAttendance::count(),

            // Activity Plans
            'totalActivityPlans' => \Illuminate\Support\Facades\Schema::hasTable('activity_plans')
                ? \App\Models\ActivityPlan::count()
                : 0,

            // Upcoming Events
            'totalUpcomingEvents' => \App\Models\UpcomingEvent::count(),
            'futureEvents' => \App\Models\UpcomingEvent::where('date', '>=', $today)->count(),
        ];

        // Calculate net profit
        $netProfit = (($stats['revenueThisMonth'] ?? 0) + ($stats['incomeThisMonth'] ?? 0)) - ($stats['totalExpensesThisMonth'] ?? 0);

        // Fees Status (counts): Paid via succeeded payments this month, Pending invoices, Overdue invoices
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();
        $feesPaidCount = Payment::where('status', 'succeeded')
            ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
            ->count();
        $feesPendingCount = Invoice::where('status','pending')->count();
        $feesOverdueCount = Invoice::where('status','overdue')->count();

        // Monthly Registrations (last 12 months for admin chart)
        $regLabels = [];
        $regCounts = [];
        for ($i = 11; $i >= 0; $i--) {
            $startM = now()->copy()->subMonths($i)->startOfMonth();
            $endM = now()->copy()->subMonths($i)->endOfMonth();
            $regLabels[] = $startM->format('M');
            $regCounts[] = (int) Student::whereBetween('created_at', [$startM, $endM])->count();
        }

        // Performance Metrics (real data)
        $totalStudents = Student::count();
        $enrolledThisMonth = Student::whereBetween('created_at', [$startOfMonth, $endOfMonth])->count();
        $studentEnrollmentRate = $totalStudents > 0 ? round(($enrolledThisMonth / max(1, $totalStudents)) * 100, 1) : 0; // % of growth this month

        $totalSessionsMonth = TrainingSession::whereBetween('date', [$startOfMonth->toDateString(), $endOfMonth->toDateString()])->count();
        $attendedSessionsMonth = \App\Models\StudentAttendance::whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->distinct('training_session_id')
            ->count('training_session_id');
        $sessionAttendanceRate = $totalSessionsMonth > 0 ? round(($attendedSessionsMonth / $totalSessionsMonth) * 100, 1) : 0; // % sessions with attendance

        // Revenue Target: compare this month revenue to last month or a simple target (e.g., 10% MoM growth)
        $lastMonthRevenue = Payment::where('status', 'succeeded')
            ->whereBetween('paid_at', [now()->subMonth()->startOfMonth(), now()->subMonth()->endOfMonth()])
            ->sum('amount_cents');
        $targetRevenueCents = (int) round($lastMonthRevenue * 1.10); // 10% growth target
        $revenueProgress = $targetRevenueCents > 0 ? round(($stats['revenueThisMonth'] ?? 0) * 100 / $targetRevenueCents, 1) : 0; // % of target achieved

        // Equipment Status: percentage in use vs total
        $equipmentTotal = \App\Models\Equipment::count();
        $equipmentInUse = \App\Models\Equipment::where('status', 'in_use')->count();
        $equipmentUtilPct = $equipmentTotal > 0 ? round(($equipmentInUse / $equipmentTotal) * 100, 1) : 0;

        // Additional trend data for charts: last 8 weeks of sessions
        $weeklyTrends = [];
        for ($i = 7; $i >= 0; $i--) {
            $weekStart = now()->subWeeks($i)->startOfWeek();
            $weekEnd = now()->subWeeks($i)->endOfWeek();
            $count = TrainingSession::whereBetween('date', [$weekStart->toDateString(), $weekEnd->toDateString()])->count();
            $weeklyTrends[] = [
                'label' => $weekStart->format('M d'),
                'sessions' => $count,
            ];
        }

        // Coach workload (top 5 coaches by session count this month)
        $coachWorkload = TrainingSession::selectRaw('coach_user_id, COUNT(*) as session_count')
            ->whereBetween('date', [now()->startOfMonth()->toDateString(), now()->endOfMonth()->toDateString()])
            ->whereNotNull('coach_user_id')
            ->groupBy('coach_user_id')
            ->orderByDesc('session_count')
            ->limit(5)
            ->with('coach:id,name')
            ->get()
            ->map(fn($item) => [
                'coach' => $item->coach->name ?? 'Unknown',
                'sessions' => $item->session_count,
            ]);

        // Equipment utilization (assume Equipment model tracks usage)
        $equipmentCount = \App\Models\Equipment::count();
        $equipmentInUse = \App\Models\Equipment::where('status', 'in_use')->count();
        $equipmentUtilization = $equipmentCount > 0 ? round(($equipmentInUse / $equipmentCount) * 100, 1) : 0;

        // Capacity building monthly totals (last 12 months)
        $capacityByMonth = \App\Models\CapacityBuilding::selectRaw("DATE_FORMAT(start_date, '%Y-%m') as month, SUM(cost_amount) as total")
            ->whereNotNull('start_date')
            ->whereBetween('start_date', [now()->subMonths(11)->startOfMonth()->toDateString(), now()->endOfMonth()->toDateString()])
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $capacityMonthlyLabels = $capacityByMonth->pluck('month')->toArray();
        // convert to RWF (assumes stored in cents)
        $capacityMonthlyTotals = $capacityByMonth->pluck('total')->map(fn($v) => (float) ($v / 100))->toArray();

        // Finance time series (last 12 months): incomes, expenses, netflow
        $financeStart = now()->subMonths(11)->startOfMonth()->toDateString();
        $financeEnd = now()->endOfMonth()->toDateString();

        // Payments (succeeded)
        $paymentsByMonth = \App\Models\Payment::selectRaw("DATE_FORMAT(paid_at, '%Y-%m') as month, SUM(amount_cents) as total")
            ->where('status', 'succeeded')
            ->whereNotNull('paid_at')
            ->whereBetween('paid_at', [$financeStart, $financeEnd])
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        // Other incomes (Income model)
        $otherIncomeByMonth = \App\Models\Income::selectRaw("DATE_FORMAT(received_at, '%Y-%m') as month, SUM(amount_cents) as total")
            ->whereNotNull('received_at')
            ->whereBetween('received_at', [$financeStart, $financeEnd])
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->keyBy('month');

        // Expenses (approved/paid)
        $expensesByMonth = \App\Models\Expense::selectRaw("DATE_FORMAT(expense_date, '%Y-%m') as month, SUM(amount_cents) as total")
            ->whereIn('status', ['approved', 'paid'])
            ->whereNotNull('expense_date')
            ->whereBetween('expense_date', [$financeStart, $financeEnd])
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
            $payments = isset($paymentsByMonth[$m]) ? $paymentsByMonth[$m]->total : 0;
            $other = isset($otherIncomeByMonth[$m]) ? $otherIncomeByMonth[$m]->total : 0;
            $income = ($payments + $other) / 100.0; // to RWF
            $expense = (isset($expensesByMonth[$m]) ? $expensesByMonth[$m]->total : 0) / 100.0;
            $incomeTotals[] = (float) $income;
            $expenseTotals[] = (float) $expense;
        }

        $netflowTotals = array_map(fn($inc, $exp) => round($inc - $exp, 2), $incomeTotals, $expenseTotals);

        // Subscriptions last 6 months: active and new per month
        $subsLabels = [];
        $subsActive = [];
        $subsNew = [];
        for ($i = 5; $i >= 0; $i--) {
            $start = now()->copy()->subMonths($i)->startOfMonth();
            $end = now()->copy()->subMonths($i)->endOfMonth();
            $subsLabels[] = $start->format('M');
            $activeCount = Subscription::where('status', 'active')
                ->whereDate('start_date', '<=', $end)
                ->when(\Illuminate\Support\Facades\Schema::hasColumn('subscriptions', 'end_date'), function($q) use ($start) {
                    $q->where(function($q2) use ($start) {
                        $q2->whereNull('end_date')->orWhereDate('end_date', '>=', $start);
                    });
                })
                ->count();
            $subsActive[] = (int) $activeCount;
            $subsNew[] = (int) Subscription::whereBetween('created_at', [$start, $end])->count();
        }

        return view('admin.dashboard', [
            'totalteams' => $totalteams,
            'todaysSessions' => $sessionsForRange,
            'sessions' => $sessionsForRange,
            'rangeLabel' => $rangeLabel,
            'currentRange' => $range,
            'currentBranchId' => $branchId,
            'branches' => Branch::orderBy('name')->get(),
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
            'recentStudents' => Student::orderBy('created_at', 'desc')->limit(10)->get(),
            'subsLabels' => $subsLabels,
            'subsActive' => $subsActive,
            'subsNew' => $subsNew,
            // Admin charts real data
            'regLabels' => $regLabels,
            'regCounts' => $regCounts,
            'feesPaidCount' => $feesPaidCount,
            'feesPendingCount' => $feesPendingCount,
            'feesOverdueCount' => $feesOverdueCount,
            // Performance metrics
            'studentEnrollmentRate' => $studentEnrollmentRate,
            'sessionAttendanceRate' => $sessionAttendanceRate,
            'revenueProgress' => $revenueProgress,
            'equipmentUtilPct' => $equipmentUtilPct,
        ]);
    }
}
