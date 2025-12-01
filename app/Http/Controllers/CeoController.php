<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Payment;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Student;
use App\Models\User;
use App\Models\Branch;
use App\Models\Group;
use App\Models\TrainingSession;

class CeoController extends Controller
{
    public function index(Request $request)
    {
        $today = now()->toDateString();
        $startOfMonth = now()->startOfMonth();
        $endOfMonth = now()->endOfMonth();

        // Cache heavy aggregates briefly
        $metrics = Cache::remember('ceo.metrics', 30, function () use ($startOfMonth, $endOfMonth) {
            $revenueThisMonth = Payment::where('status', 'succeeded')
                ->whereBetween('paid_at', [$startOfMonth, $endOfMonth])
                ->sum('amount_cents');
            $totalRevenue = Payment::where('status', 'succeeded')->sum('amount_cents');

            $otherIncomeThisMonth = Income::whereBetween('received_at', [$startOfMonth, $endOfMonth])->sum('amount_cents');
            $totalOtherIncome = Income::sum('amount_cents');

            $expensesThisMonth = Expense::whereIn('status', ['approved', 'paid'])
                ->whereBetween('expense_date', [$startOfMonth, $endOfMonth])
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
            ->sum('amount_cents');
        $revenueChange = $lastMonthRevenue > 0 ? round((($metrics['revenueThisMonth'] - $lastMonthRevenue) / $lastMonthRevenue) * 100, 1) : 0;
        $revenueChangeDirection = ($metrics['revenueThisMonth'] ?? 0) >= $lastMonthRevenue ? 'up' : 'down';

        // Org stats
        $orgStats = [
            'totalStudents' => Student::count(),
            'activeStudents' => Student::where('status', 'active')->count(),
            'totalUsers' => User::count(),
            'totalCoaches' => User::role('coach')->count(),
            'totalBranches' => Branch::count(),
            'totalGroups' => Group::count(),
            'sessionsThisWeek' => TrainingSession::whereBetween('date', [now()->startOfWeek()->toDateString(), now()->endOfWeek()->toDateString()])->count(),
        ];

        // Top branches by revenue this month (via student branch)
        $topBranchRows = \DB::table('payments')
            ->join('students', 'payments.student_id', '=', 'students.id')
            ->where('payments.status', 'succeeded')
            ->whereBetween('payments.paid_at', [$startOfMonth, $endOfMonth])
            ->whereNotNull('students.branch_id')
            ->groupBy('students.branch_id')
            ->orderByDesc(\DB::raw('SUM(payments.amount_cents)'))
            ->limit(5)
            ->select('students.branch_id', \DB::raw('SUM(payments.amount_cents) as total'))
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
            ->orderBy('date')
            ->orderBy('start_time')
            ->limit(6)
            ->get();

        return view('ceo.dashboard', [
            'metrics' => $metrics,
            'netProfitThisMonth' => $netProfitThisMonth,
            'revenueChange' => $revenueChange,
            'revenueChangeDirection' => $revenueChangeDirection,
            'orgStats' => $orgStats,
            'topBranches' => $topBranches,
            'upcomingSessions' => $upcomingSessions,
        ]);
    }
}
