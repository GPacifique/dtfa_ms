<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Income;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\IncomeCategory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AccountantController extends Controller
{
    public function index(Request $request)
    {
        $user     = Auth::user();
        $isGlobal = $user->hasRole(['super-admin', 'CEO']);
        $branchId = $isGlobal ? null : (int) $user->branch_id;

        // Shorthand: apply optional branch filter to any query builder
        $b = fn ($q) => $branchId ? $q->where('branch_id', $branchId) : $q;

        $now = now();
        $startOfMonth = $now->copy()->startOfMonth();
        $endOfMonth = $now->copy()->endOfMonth();

        // Total income this month
        $totalIncomeCents = $b(Income::whereBetween('received_at', [$startOfMonth, $endOfMonth]))->sum('amount_cents');

        // Total expenses this month (approved + paid)
        $totalExpensesThisMonth = $b(Expense::whereIn('status', ['approved', 'paid'])
            ->whereBetween('expense_date', [$startOfMonth, $endOfMonth]))->sum('amount_cents');

        // Pending expenses count
        $pendingExpenses = $b(Expense::where('status', 'pending'))->count();

        // Calculate net profit
        $netProfitThisMonth = $totalIncomeCents - $totalExpensesThisMonth;
        $netProfitColor = $netProfitThisMonth >= 0 ? 'green' : 'rose';

        // Month-over-month comparison (this vs last month income)
        $lastMonthStart = $now->copy()->subMonth()->startOfMonth();
        $lastMonthEnd = $now->copy()->subMonth()->endOfMonth();
        $lastMonthIncome = $b(Income::whereBetween('received_at', [$lastMonthStart, $lastMonthEnd]))->sum('amount_cents');
        $incomeChange = $lastMonthIncome > 0 ? round((($totalIncomeCents - $lastMonthIncome) / $lastMonthIncome) * 100, 1) : 0;
        $incomeChangeDirection = $totalIncomeCents >= $lastMonthIncome ? 'up' : 'down';

        // Income categories breakdown (this month, branch-scoped)
        $incomeCategories = IncomeCategory::withSum(['incomes as total' => function($query) use ($startOfMonth, $endOfMonth, $branchId) {
            $query->whereBetween('received_at', [$startOfMonth, $endOfMonth]);
            if ($branchId) $query->where('branch_id', $branchId);
        }], 'amount_cents')
            ->orderByDesc('total')
            ->get()
            ->filter(fn($cat) => ($cat->total ?? 0) > 0)
            ->mapWithKeys(fn($cat) => [$cat->name => (int)($cat->total ?? 0)]);

        // Expense categories breakdown (this month, branch-scoped)
        $expenseCategories = ExpenseCategory::withSum(['expenses as total' => function($query) use ($startOfMonth, $endOfMonth, $branchId) {
            $query->whereIn('status', ['approved', 'paid'])
                ->whereBetween('expense_date', [$startOfMonth, $endOfMonth]);
            if ($branchId) $query->where('branch_id', $branchId);
        }], 'amount_cents')
            ->orderByDesc('total')
            ->get()
            ->filter(fn($cat) => ($cat->total ?? 0) > 0)
            ->mapWithKeys(fn($cat) => [$cat->name => (int)($cat->total ?? 0)]);

        // Fetch recent incomes
        $recentIncomes = $b(Income::with(['branch', 'incomeCategory'])
            ->latest('received_at'))->limit(10)->get();

        // Fetch recent expenses
        $recentExpenses = $b(Expense::with(['branch', 'expenseCategory', 'approver'])
            ->latest('expense_date'))->limit(10)->get();

        // Finance Stats: Daily, Weekly, Monthly, Yearly income and expenses
        $financeStats = [
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
        ];

        // All-time totals
        $totalIncomeAllTime   = $b(Income::query())->sum('amount_cents');
        $totalExpensesAllTime = $b(Expense::whereIn('status', ['approved', 'paid']))->sum('amount_cents');

        // Category counts
        $incomeCategoryCount = IncomeCategory::active()->count();
        $expenseCategoryCount = ExpenseCategory::active()->count();

        return view('accountant.dashboard', [
            'totalIncomeCents' => $totalIncomeCents,
            'totalExpensesThisMonth' => $totalExpensesThisMonth,
            'pendingExpenses' => $pendingExpenses,
            'recentIncomes' => $recentIncomes,
            'recentExpenses' => $recentExpenses,
            'netProfitThisMonth' => $netProfitThisMonth,
            'netProfitColor' => $netProfitColor,
            'lastMonthIncome' => $lastMonthIncome,
            'incomeChange' => $incomeChange,
            'incomeChangeDirection' => $incomeChangeDirection,
            'incomeCategories' => $incomeCategories,
            'expenseCategories' => $expenseCategories,
            'financeStats' => $financeStats,
            'totalIncomeAllTime' => $totalIncomeAllTime,
            'totalExpensesAllTime' => $totalExpensesAllTime,
            'incomeCategoryCount' => $incomeCategoryCount,
            'expenseCategoryCount' => $expenseCategoryCount,
        ]);
    }

    /**
     * Return JSON metrics for dashboard charts.
     * - monthlyIncome: labels (month) and data (amount in cents)
     * - monthlyExpenses: labels (month) and data (amount in cents)
     */
    public function metrics(Request $request)
    {
        $user     = Auth::user();
        $isGlobal = $user->hasRole(['super-admin', 'CEO']);
        $branchId = $isGlobal ? null : (int) $user->branch_id;
        $b = fn ($q) => $branchId ? $q->where('branch_id', $branchId) : $q;

        $now = now();
        $labels = [];
        $incomeData = [];
        $expenseData = [];

        // last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $start = $now->copy()->subMonths($i)->startOfMonth();
            $end = $now->copy()->subMonths($i)->endOfMonth();
            $label = $start->format('M Y');
            $labels[] = $label;

            $incomeSum = $b(Income::whereBetween('received_at', [$start, $end]))->sum('amount_cents');
            $incomeData[] = (int) $incomeSum;

            $expenseSum = $b(Expense::whereIn('status', ['approved', 'paid'])
                ->whereBetween('expense_date', [$start, $end]))->sum('amount_cents');
            $expenseData[] = (int) $expenseSum;
        }

        // Income by category (this year, branch-scoped)
        $startOfYear = $now->copy()->startOfYear();
        $endOfYear = $now->copy()->endOfYear();

        $incomeByCat = IncomeCategory::withSum(['incomes as total' => function($query) use ($startOfYear, $endOfYear, $branchId) {
            $query->whereBetween('received_at', [$startOfYear, $endOfYear]);
            if ($branchId) $query->where('branch_id', $branchId);
        }], 'amount_cents')
            ->orderByDesc('total')
            ->limit(10)
            ->get()
            ->filter(fn($cat) => ($cat->total ?? 0) > 0);

        // Expense by category (this year, branch-scoped)
        $expenseByCat = ExpenseCategory::withSum(['expenses as total' => function($query) use ($startOfYear, $endOfYear, $branchId) {
            $query->whereIn('status', ['approved', 'paid'])
                ->whereBetween('expense_date', [$startOfYear, $endOfYear]);
            if ($branchId) $query->where('branch_id', $branchId);
        }], 'amount_cents')
            ->orderByDesc('total')
            ->limit(10)
            ->get()
            ->filter(fn($cat) => ($cat->total ?? 0) > 0);

        return response()->json([
            'monthlyIncome' => [
                'labels' => $labels,
                'data' => $incomeData,
            ],
            'monthlyExpenses' => [
                'labels' => $labels,
                'data' => $expenseData,
            ],
            'incomeByCategory' => [
                'labels' => $incomeByCat->pluck('name')->toArray(),
                'data' => $incomeByCat->pluck('total')->map(fn($v) => (int)$v)->toArray(),
                'colors' => $incomeByCat->pluck('color')->toArray(),
            ],
            'expenseByCategory' => [
                'labels' => $expenseByCat->pluck('name')->toArray(),
                'data' => $expenseByCat->pluck('total')->map(fn($v) => (int)$v)->toArray(),
                'colors' => $expenseByCat->pluck('color')->toArray(),
            ],
        ]);
    }

    /**
     * Return JSON metrics for dashboard charts.
     * - monthlyRevenue: labels (month) and data (amount in cents)
     * - agingBuckets: associative array of bucket => amount_cents
     */
    public function metrics2(Request $request)
    {
        $now = now();
        $months = [];
        $labels = [];
        $data = [];

        // last 12 months
        for ($i = 11; $i >= 0; $i--) {
            $start = $now->copy()->subMonths($i)->startOfMonth();
            $end = $now->copy()->subMonths($i)->endOfMonth();
            $label = $start->format('M Y');
            $months[] = [$start, $end];
            $labels[] = $label;
            $sum = \App\Models\Payment::where('status', 'succeeded')
                ->whereBetween('paid_at', [$start, $end])
                ->sum('amount_cents');
            $data[] = (int) $sum;
        }

        // Aging buckets based on invoice due_date and outstanding balance
        $today = now()->startOfDay();
        $buckets = [
            'current' => 0,
            '1-30' => 0,
            '31-60' => 0,
            '61-90' => 0,
            '90+' => 0,
        ];

        $invoices = \App\Models\Invoice::select('id', 'amount_cents', 'due_date', 'status')
            ->whereIn('status', ['pending','overdue'])
            ->get();

        foreach ($invoices as $inv) {
            $balance = $inv->outstanding_balance ?? ($inv->amount_cents ?? 0);
            $due = $inv->due_date ? \Illuminate\Support\Carbon::parse($inv->due_date)->startOfDay() : null;
            if (!$due) {
                $buckets['current'] += (int) $balance;
                continue;
            }
            $days = $due->diffInDays($today, false); // positive if due in past
            if ($days <= 0) {
                // not yet due or due today
                $buckets['current'] += (int) $balance;
            } elseif ($days <= 30) {
                $buckets['1-30'] += (int) $balance;
            } elseif ($days <= 60) {
                $buckets['31-60'] += (int) $balance;
            } elseif ($days <= 90) {
                $buckets['61-90'] += (int) $balance;
            } else {
                $buckets['90+'] += (int) $balance;
            }
        }

        // Subscriptions last 6 months: active count and new subscriptions per month
        $subsLabels = [];
        $subsActive = [];
        $subsNew = [];
        for ($i = 5; $i >= 0; $i--) {
            $start = $now->copy()->subMonths($i)->startOfMonth();
            $end = $now->copy()->subMonths($i)->endOfMonth();
            $subsLabels[] = $start->format('M');
            // Active: subscriptions with status active and started before end, not ended before start
            $activeCount = \App\Models\Subscription::where('status', 'active')
                ->whereDate('start_date', '<=', $end)
                ->when(\Illuminate\Support\Facades\Schema::hasColumn('subscriptions', 'end_date'), function($q) use ($start) {
                    $q->where(function($q2) use ($start) {
                        $q2->whereNull('end_date')->orWhereDate('end_date', '>=', $start);
                    });
                })
                ->count();
            $subsActive[] = (int) $activeCount;
            // New: subscriptions created in month
            $newCount = \App\Models\Subscription::whereBetween('created_at', [$start, $end])->count();
            $subsNew[] = (int) $newCount;
        }

        return response()->json([
            'monthlyRevenue' => [
                'labels' => $labels,
                'data' => $data,
            ],
            'agingBuckets' => $buckets,
            'subscriptionsLastSixMonths' => [
                'labels' => $subsLabels,
                'active' => $subsActive,
                'new' => $subsNew,
            ],
        ]);
    }
}
