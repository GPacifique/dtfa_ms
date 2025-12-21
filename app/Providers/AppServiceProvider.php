<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Carbon;
use App\Models\Income;
use App\Models\Payment;
use App\Models\TrainingSession;
use App\Models\Student;
use App\Models\Branch;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff;
use App\Models\StaffTask;
use App\Models\Communication;
use App\Models\Subscription;
use App\Models\Invoice;
use App\Models\Expense;
use App\Models\Group;
use App\Models\Team;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Fix for MySQL "Specified key was too long" error
        Schema::defaultStringLength(191);

        // Sidebar composer: compute counts once per request and share with the sidebar view
        View::composer(['layouts.sidebar', 'layouts.sidebar-navigation'], function ($view) {
            $data = [
                'pendingTasksCount' => 0,
                'unreadCommsCount' => 0,
                'activeSubscriptions' => 0,
                'pendingInvoices' => 0,
                'pendingExpenses' => 0,
                'totalgroup' => 0,
                'totalteams' => 0,
            ];

            try {
                if (Schema::hasTable('groups')) {
                    $data['totalgroup'] = Group::count();
                }

                if (Schema::hasTable('teams')) {
                    $data['totalteams'] = Team::count();
                }

                if (Schema::hasTable('staff_tasks')) {
                    $data['pendingTasksCount'] = StaffTask::where('status', '!=', 'done')->count();
                }

                if (Schema::hasTable('communications')) {
                    $data['unreadCommsCount'] = Communication::count();
                }

                if (Schema::hasTable('subscriptions')) {
                    $data['activeSubscriptions'] = Subscription::where('status', 'active')->count();
                }

                if (Schema::hasTable('invoices')) {
                    $data['pendingInvoices'] = Invoice::whereIn('status', ['pending', 'overdue'])->count();
                }

                if (Schema::hasTable('expenses')) {
                    $data['pendingExpenses'] = Expense::where('status', 'pending')->count();
                }

                // If authenticated and there's a Staff record for the user, compute staff-specific counts
                $user = Auth::user();
                if ($user && Schema::hasTable('staff')) {
                    $staffRecord = Staff::where('email', $user->email)->first();
                    if ($staffRecord) {
                        $data['pendingTasksCount'] = StaffTask::where('assigned_to', $staffRecord->id)->where('status','!=','done')->count();
                        $data['unreadCommsCount'] = Communication::whereJsonContains('recipients', $staffRecord->id)->count();
                    }
                }
            } catch (\Exception $e) {
                // keep defaults on error
            }

            $view->with($data);
        });

        // Dashboard metrics composer: cache heavyweight aggregates for short period
        View::composer('admin.dashboard', function ($view) {
            $metrics = Cache::remember('dashboard.metrics', 30, function () {
                $m = [
                    'revenueThisMonth' => 0,
                    'totalRevenue' => 0,
                    'incomeThisMonth' => 0,
                    'totalIncome' => 0,
                    'subscriptionRevenueThisMonth' => 0,
                    'totalSubscriptionRevenue' => 0,
                    'totalExpensesThisMonth' => 0,
                    'totalExpenses' => 0,
                    'pendingExpenses' => 0,
                ];

                try {
                    if (Schema::hasTable('payments')) {
                        $m['revenueThisMonth'] = Payment::where('status', 'succeeded')
                            ->whereBetween('paid_at', [now()->startOfMonth(), now()->endOfMonth()])
                            ->sum('amount_cents');

                        $m['totalRevenue'] = Payment::where('status', 'succeeded')->sum('amount_cents');

                        $m['subscriptionRevenueThisMonth'] = Payment::whereNotNull('subscription_id')
                            ->where('status', 'succeeded')
                            ->whereBetween('paid_at', [now()->startOfMonth(), now()->endOfMonth()])
                            ->sum('amount_cents');

                        $m['totalSubscriptionRevenue'] = Payment::whereNotNull('subscription_id')
                            ->where('status', 'succeeded')
                            ->sum('amount_cents');
                    }

                    if (Schema::hasTable('incomes')) {
                        $m['incomeThisMonth'] = Income::whereBetween('received_at', [now()->startOfMonth(), now()->endOfMonth()])->sum('amount_cents');
                        $m['totalIncome'] = Income::sum('amount_cents');
                    }

                    if (Schema::hasTable('expenses')) {
                        $m['totalExpensesThisMonth'] = Expense::whereIn('status', ['approved', 'paid'])
                            ->whereBetween('expense_date', [now()->startOfMonth(), now()->endOfMonth()])
                            ->sum('amount_cents');

                        $m['totalExpenses'] = Expense::whereIn('status', ['approved', 'paid'])->sum('amount_cents');
                        $m['pendingExpenses'] = Expense::where('status', 'pending')->count();
                    }
                } catch (\Throwable $e) {
                    // swallow and return defaults
                }

                return $m;
            });

            $view->with('cachedMetrics', $metrics);
        });
    }
}
