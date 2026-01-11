<?php $__env->startSection('title', __('app.financial_dashboard')); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-emerald-50 to-teal-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">

    
    <div class="footer-like-hero relative overflow-hidden">
        <div class="hero-blob-layer">
            <div class="hero-blob blob-1"></div>
            <div class="hero-blob blob-2"></div>
            <div class="hero-blob blob-3"></div>
        </div>

        <div class="relative z-10 container mx-auto px-6 py-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2"><?php echo e(__('app.financial_dashboard')); ?></h1>
            <p class="text-emerald-100"><?php echo e(__('app.monitor_finances')); ?></p>
        </div>
    </div>

    <div class="container mx-auto px-6 -mt-8">

        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            <a href="<?php echo e(route('admin.incomes.index')); ?>" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 block">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1"><?php echo e(__('app.income_this_month')); ?></p>
                            <h3 class="text-3xl font-bold text-emerald-600 dark:text-emerald-400" data-animate-count>
                                <?php echo e(number_format($totalIncomeCents)); ?>

                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                <span class="<?php echo e($incomeChangeDirection === 'up' ? 'text-green-600' : 'text-red-600'); ?>">
                                    <?php echo e($incomeChangeDirection === 'up' ? '↑' : '↓'); ?> <?php echo e(abs($incomeChange)); ?>%
                                </span> <?php echo e(__('app.vs_last_month')); ?>

                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            
            <a href="<?php echo e(route('admin.expenses.index')); ?>" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 block">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1"><?php echo e(__('app.expenses_this_month')); ?></p>
                            <h3 class="text-3xl font-bold text-orange-600 dark:text-orange-400" data-animate-count>
                                <?php echo e(number_format($totalExpensesThisMonth)); ?>

                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                <span class="text-amber-600 dark:text-amber-400"><?php echo e($pendingExpenses); ?></span> <?php echo e(__('app.pending')); ?>

                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            
            <div class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1"><?php echo e(__('app.net_profit')); ?></p>
                            <h3 class="text-3xl font-bold <?php echo e($netProfitColor === 'green' ? 'text-green-600 dark:text-green-400' : 'text-rose-600 dark:text-rose-400'); ?>" data-animate-count>
                                <?php echo e(number_format($netProfitThisMonth)); ?>

                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">RWF</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br <?php echo e($netProfitColor === 'green' ? 'from-green-500 to-green-600' : 'from-rose-500 to-rose-600'); ?> rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo e($netProfitColor === 'green' ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0V9m0 8l-8-8-4 4-6-6'); ?>"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1"><?php echo e(__('app.total_income_all_time')); ?></p>
                            <h3 class="text-3xl font-bold text-blue-600 dark:text-blue-400" data-animate-count>
                                <?php echo e(number_format($totalIncomeAllTime)); ?>

                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                <?php echo e(__('app.expenses')); ?>: <?php echo e(number_format($totalExpensesAllTime)); ?> RWF
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <?php if(Route::has('accountant.income-categories.index')): ?>
            <a href="<?php echo e(route('accountant.income-categories.index')); ?>" class="card block">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.income_categories')); ?></p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e($incomeCategoryCount ?? 0); ?></p>
                        </div>
                        <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
            <?php endif; ?>

            <?php if(Route::has('accountant.expense-categories.index')): ?>
            <a href="<?php echo e(route('accountant.expense-categories.index')); ?>" class="card block">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.expense_categories')); ?></p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e($expenseCategoryCount ?? 0); ?></p>
                        </div>
                        <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
            <?php endif; ?>

            <a href="<?php echo e(route('admin.incomes.index')); ?>" class="card block">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.total_incomes')); ?></p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e($totalIncomeRecords ?? 0); ?></p>
                        </div>
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="<?php echo e(route('admin.expenses.index')); ?>" class="card block">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.total_expenses')); ?></p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e($totalExpenseRecords ?? 0); ?></p>
                        </div>
                        <div class="w-10 h-10 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white"><?php echo e(__('app.finance_summary')); ?></h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                
                <div class="card bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-slate-800 dark:to-slate-700 border-l-4 border-blue-500">
                    <div class="card-body">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <h4 class="font-semibold text-blue-800 dark:text-blue-300"><?php echo e(__('app.today')); ?></h4>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.income')); ?></span>
                                <span class="font-bold text-emerald-600"><?php echo e(number_format($financeStats['daily']['income'] ?? 0)); ?> RWF</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.expenses')); ?></span>
                                <span class="font-bold text-red-600"><?php echo e(number_format($financeStats['daily']['expenses'] ?? 0)); ?> RWF</span>
                            </div>
                            <hr class="border-slate-300 dark:border-slate-600">
                            <?php $dailyBalance = ($financeStats['daily']['income'] ?? 0) - ($financeStats['daily']['expenses'] ?? 0); ?>
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300"><?php echo e(__('app.balance')); ?></span>
                                <span class="font-bold text-lg <?php echo e($dailyBalance >= 0 ? 'text-emerald-700' : 'text-red-700'); ?>">
                                    <?php echo e($dailyBalance >= 0 ? '+' : ''); ?><?php echo e(number_format($dailyBalance)); ?> RWF
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="card bg-gradient-to-br from-purple-50 to-pink-50 dark:from-slate-800 dark:to-slate-700 border-l-4 border-purple-500">
                    <div class="card-body">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <h4 class="font-semibold text-purple-800 dark:text-purple-300"><?php echo e(__('app.this_week')); ?></h4>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.income')); ?></span>
                                <span class="font-bold text-emerald-600"><?php echo e(number_format($financeStats['weekly']['income'] ?? 0)); ?> RWF</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.expenses')); ?></span>
                                <span class="font-bold text-red-600"><?php echo e(number_format($financeStats['weekly']['expenses'] ?? 0)); ?> RWF</span>
                            </div>
                            <hr class="border-slate-300 dark:border-slate-600">
                            <?php $weeklyBalance = ($financeStats['weekly']['income'] ?? 0) - ($financeStats['weekly']['expenses'] ?? 0); ?>
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300"><?php echo e(__('app.balance')); ?></span>
                                <span class="font-bold text-lg <?php echo e($weeklyBalance >= 0 ? 'text-emerald-700' : 'text-red-700'); ?>">
                                    <?php echo e($weeklyBalance >= 0 ? '+' : ''); ?><?php echo e(number_format($weeklyBalance)); ?> RWF
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="card bg-gradient-to-br from-amber-50 to-orange-50 dark:from-slate-800 dark:to-slate-700 border-l-4 border-amber-500">
                    <div class="card-body">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <h4 class="font-semibold text-amber-800 dark:text-amber-300"><?php echo e(__('app.this_month')); ?></h4>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.income')); ?></span>
                                <span class="font-bold text-emerald-600"><?php echo e(number_format($financeStats['monthly']['income'] ?? 0)); ?> RWF</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.expenses')); ?></span>
                                <span class="font-bold text-red-600"><?php echo e(number_format($financeStats['monthly']['expenses'] ?? 0)); ?> RWF</span>
                            </div>
                            <hr class="border-slate-300 dark:border-slate-600">
                            <?php $monthlyBalance = ($financeStats['monthly']['income'] ?? 0) - ($financeStats['monthly']['expenses'] ?? 0); ?>
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300"><?php echo e(__('app.balance')); ?></span>
                                <span class="font-bold text-lg <?php echo e($monthlyBalance >= 0 ? 'text-emerald-700' : 'text-red-700'); ?>">
                                    <?php echo e($monthlyBalance >= 0 ? '+' : ''); ?><?php echo e(number_format($monthlyBalance)); ?> RWF
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="card bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-slate-800 dark:to-slate-700 border-l-4 border-emerald-500">
                    <div class="card-body">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            <h4 class="font-semibold text-emerald-800 dark:text-emerald-300"><?php echo e(__('app.this_year')); ?></h4>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.income')); ?></span>
                                <span class="font-bold text-emerald-600"><?php echo e(number_format($financeStats['yearly']['income'] ?? 0)); ?> RWF</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.expenses')); ?></span>
                                <span class="font-bold text-red-600"><?php echo e(number_format($financeStats['yearly']['expenses'] ?? 0)); ?> RWF</span>
                            </div>
                            <hr class="border-slate-300 dark:border-slate-600">
                            <?php $yearlyBalance = ($financeStats['yearly']['income'] ?? 0) - ($financeStats['yearly']['expenses'] ?? 0); ?>
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300"><?php echo e(__('app.balance')); ?></span>
                                <span class="font-bold text-lg <?php echo e($yearlyBalance >= 0 ? 'text-emerald-700' : 'text-red-700'); ?>">
                                    <?php echo e($yearlyBalance >= 0 ? '+' : ''); ?><?php echo e(number_format($yearlyBalance)); ?> RWF
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            
            <div class="card">
                <div class="card-body">
                    <h3 class="text-xl md:text-2xl font-semibold text-slate-900 dark:text-white mb-4"><?php echo e(__('app.income_by_category')); ?></h3>
                    <div class="card-chart">
                        <canvas id="incomeCategoriesChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            
            <div class="card">
                <div class="card-body">
                    <h3 class="text-xl md:text-2xl font-semibold text-slate-900 dark:text-white mb-4"><?php echo e(__('app.expense_by_category')); ?></h3>
                    <div class="card-chart">
                        <canvas id="expenseCategoriesChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card mb-8">
            <div class="card-body">
                <h3 class="text-xl md:text-2xl font-semibold text-slate-900 dark:text-white mb-4"><?php echo e(__('app.income_vs_expenses')); ?></h3>
                <div class="card-chart">
                    <canvas id="monthlyComparisonChart" height="150"></canvas>
                </div>
            </div>
        </div>

        
        <div class="card mb-8">
            <div class="card-body">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4"><?php echo e(__('app.quick_actions')); ?></h3>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    <a href="<?php echo e(route('admin.incomes.create')); ?>" class="flex flex-col items-center p-4 rounded-lg bg-slate-50 dark:bg-slate-800 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-colors group">
                        <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300"><?php echo e(__('app.add_income')); ?></span>
                    </a>

                    <a href="<?php echo e(route('admin.expenses.create')); ?>" class="flex flex-col items-center p-4 rounded-lg bg-slate-50 dark:bg-slate-800 hover:bg-orange-50 dark:hover:bg-orange-900/20 transition-colors group">
                        <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/30 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300"><?php echo e(__('app.add_expense')); ?></span>
                    </a>

                    <a href="<?php echo e(route('admin.incomes.index')); ?>" class="flex flex-col items-center p-4 rounded-lg bg-slate-50 dark:bg-slate-800 hover:bg-green-50 dark:hover:bg-green-900/20 transition-colors group">
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300"><?php echo e(__('app.view_incomes')); ?></span>
                    </a>

                    <a href="<?php echo e(route('admin.expenses.index')); ?>" class="flex flex-col items-center p-4 rounded-lg bg-slate-50 dark:bg-slate-800 hover:bg-red-50 dark:hover:bg-red-900/20 transition-colors group">
                        <div class="w-12 h-12 bg-red-100 dark:bg-red-900/30 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-red-600 dark:text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300"><?php echo e(__('app.view_expenses')); ?></span>
                    </a>

                    <?php if(Route::has('accountant.income-categories.index')): ?>
                    <a href="<?php echo e(route('accountant.income-categories.index')); ?>" class="flex flex-col items-center p-4 rounded-lg bg-slate-50 dark:bg-slate-800 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors group">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300 text-center"><?php echo e(__('app.income_categories')); ?></span>
                    </a>
                    <?php endif; ?>

                    <?php if(Route::has('accountant.expense-categories.index')): ?>
                    <a href="<?php echo e(route('accountant.expense-categories.index')); ?>" class="flex flex-col items-center p-4 rounded-lg bg-slate-50 dark:bg-slate-800 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors group">
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300 text-center"><?php echo e(__('app.expense_categories')); ?></span>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <?php if(isset($recentIncomes) && $recentIncomes->count() > 0): ?>
        <div class="card mb-8">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white"><?php echo e(__('app.recent_incomes')); ?></h3>
                    <a href="<?php echo e(route('admin.incomes.index')); ?>" class="text-sm text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300 font-medium">
                        <?php echo e(__('app.view_all')); ?> &rarr;
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Branch</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Category</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Amount</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Source</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                            <?php $__currentLoopData = $recentIncomes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                                <td class="px-4 py-3 text-sm text-slate-900 dark:text-white">
                                    <?php echo e($income->branch->name ?? '-'); ?>

                                </td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">
                                    <span class="px-2 py-1 text-xs rounded-full bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400">
                                        <?php echo e($income->category_name ?? ucfirst($income->category ?? '-')); ?>

                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm font-semibold text-emerald-600 dark:text-emerald-400"><?php echo e(number_format($income->amount_cents, 0)); ?> RWF</td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">
                                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                        <?php echo e(ucfirst(str_replace('_', ' ', $income->source ?? 'other'))); ?>

                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400"><?php echo e($income->received_at ? \Carbon\Carbon::parse($income->received_at)->format('M d, Y') : 'N/A'); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>

        
        <?php if(isset($recentExpenses) && $recentExpenses->count() > 0): ?>
        <div class="card mb-8">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white"><?php echo e(__('app.recent_expenses')); ?></h3>
                    <a href="<?php echo e(route('admin.expenses.index')); ?>" class="text-sm text-orange-600 hover:text-orange-700 dark:text-orange-400 dark:hover:text-orange-300 font-medium">
                        <?php echo e(__('app.view_all')); ?> &rarr;
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Description</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Category</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Amount</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                            <?php $__currentLoopData = $recentExpenses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expense): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                                <td class="px-4 py-3 text-sm text-slate-900 dark:text-white"><?php echo e(Str::limit($expense->description ?? '-', 35)); ?></td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">
                                    <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400">
                                        <?php echo e($expense->category_name ?? ucfirst($expense->category ?? 'Other')); ?>

                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm font-semibold text-red-600 dark:text-red-400"><?php echo e(number_format($expense->amount_cents, 0)); ?> RWF</td>
                                <td class="px-4 py-3">
                                    <?php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                                            'approved' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                            'paid' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                            'rejected' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                                        ];
                                    ?>
                                    <span class="px-2 py-1 text-xs rounded-full <?php echo e($statusColors[$expense->status] ?? 'bg-gray-100 text-gray-800'); ?>">
                                        <?php echo e(ucfirst($expense->status ?? 'Unknown')); ?>

                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400"><?php echo e($expense->expense_date ? \Carbon\Carbon::parse($expense->expense_date)->format('M d, Y') : 'N/A'); ?></td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
</div>


<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Income Categories Chart
    const incomeCategoriesCtx = document.getElementById('incomeCategoriesChart');
    if (incomeCategoriesCtx) {
        <?php $incomeDataChart = $incomeCategories ?? []; ?>
        const incomeData = <?php echo json_encode($incomeDataChart, 15, 512) ?>;
        const incomeChart = new Chart(incomeCategoriesCtx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(incomeData),
                datasets: [{
                    data: Object.values(incomeData),
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(139, 92, 246, 0.7)',
                        'rgba(245, 158, 11, 0.7)',
                        'rgba(14, 165, 233, 0.7)',
                        'rgba(34, 197, 94, 0.7)',
                        'rgba(99, 102, 241, 0.7)',
                        'rgba(236, 72, 153, 0.7)'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // Click handler: go to incomes index filtered by category
        incomeCategoriesCtx.onclick = (evt) => {
            const points = incomeChart.getElementsAtEventForMode(evt, 'nearest', { intersect: true }, true);
            if (points && points.length) {
                const idx = points[0].index;
                const category = incomeChart.data.labels[idx];
                const url = `<?php echo e(route('admin.incomes.index')); ?>` + `?category=` + encodeURIComponent(category);
                window.location.href = url;
            }
        };
    }

    // Expense Categories Chart
    const expenseCategoriesCtx = document.getElementById('expenseCategoriesChart');
    if (expenseCategoriesCtx) {
        <?php $expenseDataChart = $expenseCategories ?? []; ?>
        const expenseData = <?php echo json_encode($expenseDataChart, 15, 512) ?>;
        const expenseChart = new Chart(expenseCategoriesCtx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(expenseData),
                datasets: [{
                    data: Object.values(expenseData),
                    backgroundColor: [
                        'rgba(239, 68, 68, 0.7)',
                        'rgba(251, 146, 60, 0.7)',
                        'rgba(234, 179, 8, 0.7)',
                        'rgba(168, 85, 247, 0.7)',
                        'rgba(236, 72, 153, 0.7)',
                        'rgba(14, 165, 233, 0.7)',
                        'rgba(139, 92, 246, 0.7)',
                        'rgba(99, 102, 241, 0.7)'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // Click handler: go to expenses index filtered by category
        expenseCategoriesCtx.onclick = (evt) => {
            const points = expenseChart.getElementsAtEventForMode(evt, 'nearest', { intersect: true }, true);
            if (points && points.length) {
                const idx = points[0].index;
                const category = expenseChart.data.labels[idx];
                const url = `<?php echo e(route('admin.expenses.index')); ?>` + `?category=` + encodeURIComponent(category);
                window.location.href = url;
            }
        };
    }

    // Monthly Income vs Expenses Comparison Chart
    const monthlyComparisonCtx = document.getElementById('monthlyComparisonChart');
    if (monthlyComparisonCtx) {
        const metricsUrl = `<?php echo e(route('accountant.dashboard.metrics')); ?>`;
        fetch(metricsUrl, { headers: { 'Accept': 'application/json' } })
            .then(resp => resp.json())
            .then(json => {
                const labels = json.monthlyLabels || [];
                const incomeData = json.monthlyIncome || [];
                const expenseData = json.monthlyExpenses || [];

                new Chart(monthlyComparisonCtx, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Income',
                            data: incomeData,
                            backgroundColor: 'rgba(16, 185, 129, 0.7)',
                            borderColor: 'rgba(16, 185, 129, 1)',
                            borderWidth: 1
                        }, {
                            label: 'Expenses',
                            data: expenseData,
                            backgroundColor: 'rgba(239, 68, 68, 0.7)',
                            borderColor: 'rgba(239, 68, 68, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: { position: 'top' }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return value.toLocaleString() + ' RWF';
                                    }
                                }
                            }
                        }
                    }
                });
            })
            .catch(err => {
                console.error('Failed to load monthly comparison metrics', err);
            });
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/accountant/dashboard.blade.php ENDPATH**/ ?>