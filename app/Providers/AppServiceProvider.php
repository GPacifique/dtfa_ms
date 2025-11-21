<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Staff;
use App\Models\StaffTask;
use App\Models\Communication;
use App\Models\Subscription;
use App\Models\Invoice;
use App\Models\Expense;

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
        View::composer('layouts.sidebar', function ($view) {
            $data = [
                'pendingTasksCount' => 0,
                'unreadCommsCount' => 0,
                'activeSubscriptions' => 0,
                'pendingInvoices' => 0,
                'pendingExpenses' => 0,
            ];

            try {
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
    }
}
