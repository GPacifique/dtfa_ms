
<?php $__env->startSection('title', __('app.admin_dashboard')); ?>

<?php $__env->startSection('content'); ?>
<?php
    $__regLabels = isset($regLabels) && is_array($regLabels) ? $regLabels : ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    $__regCounts = isset($regCounts) && is_array($regCounts) ? $regCounts : [12, 19, 7, 15, 22, 18, 25, 17, 20, 23, 16, 21];
?>
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-emerald-50 to-teal-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">

    
    <div class="footer-like-hero relative overflow-hidden">
        <div class="hero-blob-layer">
            <div class="hero-blob blob-1"></div>
            <div class="hero-blob blob-2"></div>
            <div class="hero-blob blob-3"></div>
        </div>

        <div class="relative z-10 container mx-auto px-6 py-8">
            <h1 class="flex items-center gap-3 text-3xl md:text-4xl font-bold text-white mb-2">
                <img src="<?php echo e(asset('logo.jpeg')); ?>" alt="Logo" class="w-9 h-9 md:w-10 md:h-10 rounded-md object-cover shadow-sm ring-2 ring-white/20">
                <span><?php echo e(__('app.admin_dashboard')); ?></span>
            </h1>
            <p class="text-emerald-100"><?php echo e(__('app.high_level_view')); ?></p>
        </div>
    </div>

    <div class="container mx-auto px-6 -mt-8">

        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            <a href="<?php echo e(route('admin.students.index')); ?>" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1"><?php echo e(__('app.students')); ?></p>
                            <h3 class="text-3xl font-bold text-blue-600 dark:text-blue-400" data-animate-count>
                                <?php echo e($stats['totalStudents'] ?? 0); ?>

                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                <?php echo e(__('app.all_time_registered')); ?>

                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            
            <a href="<?php echo e(route('admin.students.index')); ?>" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1"><?php echo e(__('app.active_students')); ?></p>
                            <h3 class="text-3xl font-bold text-emerald-600 dark:text-emerald-400" data-animate-count>
                                <?php echo e($stats['activeStudents'] ?? 0); ?>

                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                <?php echo e(__('app.currently_enrolled')); ?>

                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            
            <a href="<?php echo e(route('admin.training_session_records.index')); ?>" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1"><?php echo e(__('app.sessions')); ?> (<?php echo e($rangeLabel ?? __('app.today')); ?>)</p>
                            <h3 class="text-3xl font-bold text-purple-600 dark:text-purple-400" data-animate-count>
                                <?php echo e($stats['todaySessions'] ?? 0); ?>

                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                <?php echo e(__('app.scheduled')); ?>

                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            
            <a href="<?php echo e(route('admin.incomes.index')); ?>" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1"><?php echo e(__('app.income_this_month')); ?></p>
                            <h3 class="text-3xl font-bold text-teal-600 dark:text-teal-400" data-animate-count>
                                <?php echo e(number_format($stats['incomeThisMonth'] ?? 0)); ?> RWF
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                <?php echo e(__('app.from_all_sources')); ?>

                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            
            <div class="card lg:col-span-2">
                <div class="card-body">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl md:text-2xl font-semibold text-slate-900 dark:text-white">💰 <?php echo e(__('app.income_vs_expenses')); ?> (<?php echo e(__('app.last_12_months')); ?>)</h3>
                        <div class="flex items-center gap-4 text-sm">
                            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-emerald-500"></span> <?php echo e(__('app.income')); ?></span>
                            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-red-500"></span> <?php echo e(__('app.expenses')); ?></span>
                            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-sm bg-blue-500"></span> <?php echo e(__('app.net_profit')); ?></span>
                        </div>
                    </div>
                    <div class="h-80">
                        <canvas id="incomeExpensesChart"></canvas>
                    </div>
                </div>
            </div>
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
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-xl md:text-2xl font-semibold text-slate-900 dark:text-white"><?php echo e(__('app.monthly_registrations')); ?></h3>
                    </div>
                    <canvas id="adminRegistrationsChart" height="200"></canvas>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-xl md:text-2xl font-semibold text-slate-900 dark:text-white"><?php echo e(__('app.expense_categories')); ?></h3>
                    </div>
                    <canvas id="adminExpenseCategoriesChart" height="200"></canvas>
                </div>
            </div>
        </div>

        <?php $__env->startPush('scripts'); ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (window.Chart) {
                    // Income vs Expenses Chart (new prominent chart)
                    const incExpCtx = document.getElementById('incomeExpensesChart');
                    if (incExpCtx) {
                        const finLabels = <?php echo json_encode($financeLabels ?? [], 15, 512) ?>;
                        const incomeData = <?php echo json_encode($incomeTotals ?? [], 15, 512) ?>;
                        const expenseData = <?php echo json_encode($expenseTotals ?? [], 15, 512) ?>;
                        const netflowData = <?php echo json_encode($netflowTotals ?? [], 15, 512) ?>;

                        new Chart(incExpCtx, {
                            type: 'bar',
                            data: {
                                labels: finLabels,
                                datasets: [
                                    {
                                        type: 'bar',
                                        label: '<?php echo e(__('app.income')); ?>',
                                        data: incomeData,
                                        backgroundColor: 'rgba(16, 185, 129, 0.8)',
                                        borderColor: '#10b981',
                                        borderWidth: 1,
                                        borderRadius: 4,
                                        order: 2
                                    },
                                    {
                                        type: 'bar',
                                        label: '<?php echo e(__('app.expenses')); ?>',
                                        data: expenseData,
                                        backgroundColor: 'rgba(239, 68, 68, 0.8)',
                                        borderColor: '#ef4444',
                                        borderWidth: 1,
                                        borderRadius: 4,
                                        order: 3
                                    },
                                    {
                                        type: 'line',
                                        label: '<?php echo e(__('app.net_profit')); ?>',
                                        data: netflowData,
                                        borderColor: '#3b82f6',
                                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                        borderWidth: 3,
                                        fill: true,
                                        tension: 0.4,
                                        pointRadius: 4,
                                        pointBackgroundColor: '#3b82f6',
                                        order: 1
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                interaction: {
                                    mode: 'index',
                                    intersect: false
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'bottom',
                                        labels: {
                                            usePointStyle: true,
                                            padding: 20
                                        }
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                return context.dataset.label + ': ' + new Intl.NumberFormat('en-RW').format(context.raw) + ' RWF';
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        grid: {
                                            display: false
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            callback: function(value) {
                                                return new Intl.NumberFormat('en-RW', { notation: 'compact' }).format(value) + ' RWF';
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }

                    const regCtx = document.getElementById('adminRegistrationsChart');
                    const __regLabels = <?php echo json_encode($__regLabels, 15, 512) ?>;
                    const __regCounts = <?php echo json_encode($__regCounts, 15, 512) ?>;
                    new Chart(regCtx, {
                        type: 'bar',
                        data: {
                            labels: __regLabels,
                            datasets: [{
                                label: '<?php echo e(__('app.registrations')); ?>',
                                data: __regCounts,
                                backgroundColor: 'rgba(99, 102, 241, 0.5)',
                                borderColor: '#6366f1',
                                borderWidth: 1
                            }]
                        },
                        options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
                    });

                    const expCatCtx = document.getElementById('adminExpenseCategoriesChart');
                    if (expCatCtx) {
                        <?php
                            $catLabels = $expenseCategoryLabels ?? ['Operations', 'Salaries', 'Utilities', 'Supplies', 'Other'];
                            $catAmounts = $expenseCategoryAmounts ?? [30, 25, 15, 20, 10];
                        ?>
                        const expCatLabels = <?php echo json_encode($catLabels, 15, 512) ?>;
                        const expCatData = <?php echo json_encode($catAmounts, 15, 512) ?>;
                        new Chart(expCatCtx, {
                            type: 'doughnut',
                            data: {
                                labels: expCatLabels,
                                datasets: [{
                                    data: expCatData,
                                    backgroundColor: ['#ef4444', '#f59e0b', '#3b82f6', '#10b981', '#8b5cf6'],
                                    borderWidth: 1
                                }]
                            },
                            options: { plugins: { legend: { position: 'bottom' } } }
                        });
                    }
                }
            });
        </script>
        <?php $__env->stopPush(); ?>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <a href="<?php echo e(route('admin.incomes.index')); ?>" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1"><?php echo e(__('app.income_this_month')); ?></p>
                            <h3 class="text-3xl font-bold text-emerald-600 dark:text-emerald-400" data-animate-count>
                                <?php echo e(number_format($stats['incomeThisMonth'] ?? 0)); ?> RWF
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2"><?php echo e(__('app.from_all_sources')); ?></p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="<?php echo e(route('admin.incomes.index')); ?>" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1"><?php echo e(__('app.total_income')); ?></p>
                            <h3 class="text-3xl font-bold text-slate-900" data-animate-count>
                                <?php echo e(number_format($stats['totalIncome'] ?? 0)); ?> RWF
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2"><?php echo e(__('app.all_time')); ?></p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-slate-500 to-slate-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4l3 8 4-16 3 8h4"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="<?php echo e(route('admin.expenses.index')); ?>" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1"><?php echo e(__('app.expenses_this_month')); ?></p>
                            <h3 class="text-3xl font-bold text-red-600 dark:text-red-400" data-animate-count>
                                <?php echo e(number_format($stats['expensesThisMonth'] ?? 0)); ?> RWF
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2"><?php echo e(__('app.from_all_sources')); ?></p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="<?php echo e(route('admin.expenses.index')); ?>" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1"><?php echo e(__('app.total_expenses')); ?></p>
                            <h3 class="text-3xl font-bold text-slate-900" data-animate-count>
                                <?php echo e(number_format($stats['totalExpenses'] ?? 0)); ?> RWF
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2"><?php echo e(__('app.all_time')); ?></p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-slate-700 to-slate-800 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <a href="<?php echo e(route('admin.branches.index')); ?>" class="card cursor-pointer hover:shadow-lg transition-shadow">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.branches')); ?></p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e($stats['totalBranches'] ?? 0); ?></p>
                        </div>
                        <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="<?php echo e(route('admin.groups.index')); ?>" class="card cursor-pointer hover:shadow-lg transition-shadow">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.groups')); ?></p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e($stats['totalGroups'] ?? 0); ?></p>
                        </div>
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="<?php echo e(route('admin.training_session_records.index')); ?>" class="card cursor-pointer hover:shadow-lg transition-shadow">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.training_sessions')); ?></p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e($stats['totalSessions'] ?? 0); ?></p>
                        </div>
                        <div class="w-10 h-10 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="<?php echo e(route('admin.equipment.index')); ?>" class="card cursor-pointer hover:shadow-lg transition-shadow">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.equipment')); ?></p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e($stats['totalEquipment'] ?? 0); ?></p>
                        </div>
                        <div class="w-10 h-10 bg-teal-100 dark:bg-teal-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        
        <div class="mb-8">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">✅ <?php echo e(__('app.attendance_overview')); ?></h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="<?php echo e(route('admin.student-attendance.index')); ?>" class="card group hover:shadow-xl transition-all duration-300 cursor-pointer">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.student_attendance')); ?></p>
                                <p class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e($stats['totalStudentAttendance'] ?? 0); ?></p>
                            </div>
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="<?php echo e(route('coach.attendance.index')); ?>" class="card group hover:shadow-xl transition-all duration-300 cursor-pointer">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.coach_attendance')); ?></p>
                                <p class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e($stats['totalCoachAttendance'] ?? 0); ?></p>
                            </div>
                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="<?php echo e(route('admin.staff_attendances.index')); ?>" class="card group hover:shadow-xl transition-all duration-300 cursor-pointer">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.staff_attendance')); ?></p>
                                <p class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e($stats['totalStaffAttendance'] ?? 0); ?></p>
                            </div>
                            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white">📋 <?php echo e(__('app.todays_student_attendance')); ?></h2>
                <a href="<?php echo e(route('admin.student-attendance.index')); ?>" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                    <?php echo e(__('app.view_all_arrow')); ?>

                </a>
            </div>

            
            <?php if(isset($todayAttendanceStats)): ?>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-4">
                <div class="bg-slate-100 dark:bg-slate-800 rounded-lg p-3 text-center">
                    <p class="text-2xl font-bold text-slate-700 dark:text-slate-300"><?php echo e($todayAttendanceStats['total'] ?? 0); ?></p>
                    <p class="text-xs text-slate-500 dark:text-slate-400"><?php echo e(__('app.total_recorded')); ?></p>
                </div>
                <div class="bg-emerald-100 dark:bg-emerald-900/30 rounded-lg p-3 text-center">
                    <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400"><?php echo e($todayAttendanceStats['present'] ?? 0); ?></p>
                    <p class="text-xs text-emerald-600 dark:text-emerald-400"><?php echo e(__('app.present')); ?></p>
                </div>
                <div class="bg-red-100 dark:bg-red-900/30 rounded-lg p-3 text-center">
                    <p class="text-2xl font-bold text-red-600 dark:text-red-400"><?php echo e($todayAttendanceStats['absent'] ?? 0); ?></p>
                    <p class="text-xs text-red-600 dark:text-red-400"><?php echo e(__('app.absent')); ?></p>
                </div>
                <div class="bg-yellow-100 dark:bg-yellow-900/30 rounded-lg p-3 text-center">
                    <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400"><?php echo e($todayAttendanceStats['late'] ?? 0); ?></p>
                    <p class="text-xs text-yellow-600 dark:text-yellow-400"><?php echo e(__('app.late')); ?></p>
                </div>
                <div class="bg-blue-100 dark:bg-blue-900/30 rounded-lg p-3 text-center">
                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400"><?php echo e($todayAttendanceStats['excused'] ?? 0); ?></p>
                    <p class="text-xs text-blue-600 dark:text-blue-400"><?php echo e(__('app.excused')); ?></p>
                </div>
            </div>
            <?php endif; ?>

            
            <div class="card">
                <div class="card-body p-0">
                    <?php if(isset($todayAttendances) && $todayAttendances->count() > 0): ?>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                            <thead class="bg-slate-50 dark:bg-slate-800">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider"><?php echo e(__('app.student')); ?></th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider"><?php echo e(__('app.status')); ?></th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider"><?php echo e(__('app.time')); ?></th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider"><?php echo e(__('app.remarks')); ?></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-slate-900 divide-y divide-slate-200 dark:divide-slate-700">
                                <?php $__currentLoopData = $todayAttendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8">
                                                <?php if($attendance->student && $attendance->student->photo_path): ?>
                                                    <img class="h-8 w-8 rounded-full object-cover" src="<?php echo e($attendance->student->photo_url); ?>" alt="">
                                                <?php else: ?>
                                                    <div class="h-8 w-8 rounded-full bg-slate-300 dark:bg-slate-600 flex items-center justify-center">
                                                        <span class="text-xs font-medium text-slate-600 dark:text-slate-300">
                                                            <?php echo e($attendance->student ? strtoupper(substr($attendance->student->first_name, 0, 1) . substr($attendance->student->second_name ?? '', 0, 1)) : '?'); ?>

                                                        </span>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-slate-900 dark:text-white">
                                                    <?php echo e($attendance->student ? $attendance->student->first_name . ' ' . ($attendance->student->second_name ?? '') : __('app.unknown_student')); ?>

                                                </p>
                                                <p class="text-xs text-slate-500 dark:text-slate-400">
                                                    <?php echo e(__('app.id')); ?>: <?php echo e($attendance->student->student_id ?? $attendance->student_id); ?>

                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <?php
                                            $statusColors = [
                                                'present' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400',
                                                'absent' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                                                'late' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                                                'excused' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                            ];
                                            $statusIcons = [
                                                'present' => '✅',
                                                'absent' => '❌',
                                                'late' => '⏰',
                                                'excused' => 'ℹ️',
                                            ];
                                        ?>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?php echo e($statusColors[$attendance->status] ?? 'bg-slate-100 text-slate-800'); ?>">
                                            <?php echo e($statusIcons[$attendance->status] ?? ''); ?> <?php echo e(ucfirst($attendance->status)); ?>

                                        </span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                        <?php echo e($attendance->created_at->format('h:i A')); ?>

                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                        <?php echo e($attendance->remarks ?? '-'); ?>

                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php else: ?>
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-slate-900 dark:text-white mb-2"><?php echo e(__('app.no_attendance_recorded_today')); ?></h3>
                        <p class="text-slate-500 dark:text-slate-400 mb-4"><?php echo e(__('app.start_recording_attendance')); ?> <?php echo e(now()->format('F j, Y')); ?></p>
                        <a href="<?php echo e(route('students-modern.index')); ?>" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <?php echo e(__('app.record_attendance')); ?>

                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="mb-8">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">📋 <?php echo e(__('app.upcoming_events')); ?></h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="<?php echo e(route('admin.upcoming-events.index')); ?>" class="card group hover:shadow-xl transition-all duration-300 cursor-pointer">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.total_events')); ?></p>
                                <p class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e($stats['totalUpcomingEvents'] ?? 0); ?></p>
                                <p class="text-xs text-emerald-600 mt-1"><?php echo e(__('app.future')); ?>: <?php echo e($stats['futureEvents'] ?? 0); ?></p>
                            </div>
                            <div class="w-10 h-10 bg-rose-100 dark:bg-rose-900/30 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-rose-600 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="<?php echo e(route('admin.capacity-buildings.index')); ?>" class="card group hover:shadow-xl transition-all duration-300 cursor-pointer">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-600 dark:text-slate-400"><?php echo e(__('app.capacity_building')); ?></p>
                                <p class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e($stats['capacityCount'] ?? 0); ?></p>
                                <p class="text-xs text-slate-500 mt-1"><?php echo e(__('app.total_cost')); ?>: <?php echo e(number_format($stats['capacityTotalCost'] ?? 0)); ?> RWF</p>
                            </div>
                            <div class="w-10 h-10 bg-sky-100 dark:bg-sky-900/30 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-sky-600 dark:text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        

        
        <div class="mb-8">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">⚡ <?php echo e(__('app.quick_actions')); ?></h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">

                
                <?php if(Route::has('students-modern.index')): ?>
                <a href="<?php echo e(route('students-modern.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">🎓</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.students')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.manage')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('staff.index')): ?>
                <a href="<?php echo e(route('staff.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">👔</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.staff')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.profiles')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('admin.players.index')): ?>
                <a href="<?php echo e(route('admin.players.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">🏃</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.players')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.match_players')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('admin.users.index')): ?>
                <a href="<?php echo e(route('admin.users.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">👥</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.users')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.system_users')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('admin.roles.index')): ?>
                <a href="<?php echo e(route('admin.roles.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">🛡️</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.roles')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.permissions')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                
                <?php if(Route::has('admin.training_session_records.index')): ?>
                <a href="<?php echo e(route('admin.training_session_records.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">📅</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.sessions')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.scheduling')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('admin.games.index')): ?>
                <a href="<?php echo e(route('admin.games.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">⚽</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.matches')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.games')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('admin.minutes.index')): ?>
                <a href="<?php echo e(route('admin.minutes.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">⏱️</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.minutes')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.records')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('admin.upcoming-events.index')): ?>
                <a href="<?php echo e(route('admin.upcoming-events.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">🎉</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.events')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.upcoming')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('admin.activity-plans.index')): ?>
                <a href="<?php echo e(route('admin.activity-plans.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">📝</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.plans')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.activities')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('admin.sports-equipment.index')): ?>
                <a href="<?php echo e(route('admin.sports-equipment.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">👟</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.sports_equipment')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.inventory')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('admin.office-equipment.index')): ?>
                <a href="<?php echo e(route('admin.office-equipment.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">💻</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.office_equipment')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.inventory')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('kit-manager.dashboard')): ?>
                <a href="<?php echo e(route('kit-manager.dashboard')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">👕</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.kit_manager')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.dashboard')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('admin.student-attendance.index')): ?>
                <a href="<?php echo e(route('admin.student-attendance.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">✅</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.student_att')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.attendance')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('admin.staff_attendances.index')): ?>
                <a href="<?php echo e(route('admin.staff_attendances.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">📋</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.staff_att')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.attendance')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('admin.inhousetrainings.index')): ?>
                <a href="<?php echo e(route('admin.inhousetrainings.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">🏫</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.inhouse_training')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.training')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                
                <?php if(Route::has('admin.incomes.index')): ?>
                <a href="<?php echo e(route('admin.incomes.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">📈</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.incomes')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.revenue')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('admin.expenses.index')): ?>
                <a href="<?php echo e(route('admin.expenses.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">📉</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.expenses')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.costs')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                
                <?php if(Route::has('admin.equipment.index')): ?>
                <a href="<?php echo e(route('admin.equipment.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">📦</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.equipment')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.general')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('admin.branches.index')): ?>
                <a href="<?php echo e(route('admin.branches.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">🏢</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.branches')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.locations')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('admin.groups.index')): ?>
                <a href="<?php echo e(route('admin.groups.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">👥</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.groups')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.manage')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('admin.teams.index')): ?>
                <a href="<?php echo e(route('admin.teams.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">🏆</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.teams')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.squads')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('admin.tasks.index')): ?>
                <a href="<?php echo e(route('admin.tasks.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">✅</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.tasks')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.to_do')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('admin.communications.index')): ?>
                <a href="<?php echo e(route('admin.communications.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">📧</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.communications')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.messages')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                
                <?php if(Route::has('reports.index')): ?>
                <a href="<?php echo e(route('reports.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">📊</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.reports')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.analytics')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

                <?php if(Route::has('admin.imports.index')): ?>
                <a href="<?php echo e(route('admin.imports.index')); ?>" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">📥</div>
                        <div class="text-sm font-semibold text-slate-900"><?php echo e(__('app.import')); ?></div>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(__('app.data')); ?></div>
                    </div>
                </a>
                <?php endif; ?>

            </div>
        </div>

        <!-- Today's Incomes -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white">💰 <?php echo e(__('app.todays_incomes')); ?></h2>
                <div class="flex items-center gap-4">
                    <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 rounded-full text-sm font-semibold">
                        <?php echo e(__('app.total')); ?>: <?php echo e(number_format($todayIncomeStats['total'] ?? 0)); ?> RWF
                    </span>
                    <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-sm font-semibold">
                        <?php echo e($todayIncomeStats['count'] ?? 0); ?> <?php echo e(__('app.records')); ?>

                    </span>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                <?php if(($todayIncomes ?? collect())->isEmpty()): ?>
                    <div class="text-center py-12">
                        <svg class="mx-auto h-16 w-16 text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-slate-500 dark:text-slate-400 font-medium text-lg"><?php echo e(__('app.no_income_recorded_today')); ?></p>
                        <a href="<?php echo e(route('admin.incomes.create')); ?>" class="inline-block mt-4 px-6 py-2 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition">
                            <?php echo e(__('app.record_income')); ?>

                        </a>
                    </div>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-slate-50 dark:bg-slate-700">
                                <tr class="text-slate-600 dark:text-slate-300">
                                    <th class="px-4 py-3 font-semibold"><?php echo e(__('app.time')); ?></th>
                                    <th class="px-4 py-3 font-semibold"><?php echo e(__('app.amount')); ?></th>
                                    <th class="px-4 py-3 font-semibold"><?php echo e(__('app.category')); ?></th>
                                    <th class="px-4 py-3 font-semibold"><?php echo e(__('app.source')); ?></th>
                                    <th class="px-4 py-3 font-semibold"><?php echo e(__('app.branch')); ?></th>
                                    <th class="px-4 py-3 font-semibold"><?php echo e(__('app.recorded_by')); ?></th>
                                    <th class="px-4 py-3 font-semibold"><?php echo e(__('app.notes')); ?></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                <?php $__currentLoopData = $todayIncomes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $income): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                                        <td class="px-4 py-3 text-slate-900 dark:text-white">
                                            <?php echo e($income->received_at ? $income->received_at->format('H:i') : '-'); ?>

                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="font-bold text-emerald-600 dark:text-emerald-400">
                                                <?php echo e(number_format($income->amount_cents, 0)); ?> <?php echo e($income->currency ?? 'RWF'); ?>

                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="px-2 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 rounded text-xs font-medium">
                                                <?php echo e(ucfirst($income->category ?? '-')); ?>

                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-slate-600 dark:text-slate-300"><?php echo e($income->source ?? '-'); ?></td>
                                        <td class="px-4 py-3 text-slate-600 dark:text-slate-300"><?php echo e($income->branch->name ?? '-'); ?></td>
                                        <td class="px-4 py-3 text-slate-600 dark:text-slate-300"><?php echo e($income->recordedBy->name ?? '-'); ?></td>
                                        <td class="px-4 py-3 text-slate-500 dark:text-slate-400 text-xs"><?php echo e(Str::limit($income->notes, 30) ?? '-'); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="px-4 py-3 bg-slate-50 dark:bg-slate-700 border-t border-slate-200 dark:border-slate-600">
                        <a href="<?php echo e(route('admin.incomes.index')); ?>" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm font-medium">
                            <?php echo e(__('app.view_all_incomes')); ?> →
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Analytics & Insights Section -->
        <div>
            <h2 class="text-xl font-bold text-slate-900 mb-4">📈 <?php echo e(__('app.analytics_insights')); ?></h2>

        <!-- Recent Students -->
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-3">🆕 <?php echo e(__('app.recent_students')); ?></h3>
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
                <?php if(($recentStudents ?? collect())->isEmpty()): ?>
                    <div class="text-center py-6 text-slate-500"><?php echo e(__('app.no_recent_students')); ?></div>
                <?php else: ?>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead>
                                <tr class="text-slate-600">
                                    <th class="px-3 py-2"><?php echo e(__('app.name')); ?></th>
                                    <th class="px-3 py-2"><?php echo e(__('app.group')); ?></th>
                                    <th class="px-3 py-2"><?php echo e(__('app.branch')); ?></th>
                                    <th class="px-3 py-2"><?php echo e(__('app.enrolled')); ?></th>
                                    <th class="px-3 py-2"><?php echo e(__('app.status')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $recentStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="border-t">
                                        <td class="px-3 py-2"><?php echo e($student->first_name); ?> <?php echo e($student->last_name); ?></td>
                                        <td class="px-3 py-2"><?php echo e(optional($student->group)->name ?? '-'); ?></td>
                                        <td class="px-3 py-2"><?php echo e(optional($student->branch)->name ?? '-'); ?></td>
                                        <td class="px-3 py-2"><?php echo e($student->created_at ? $student->created_at->format('M d, Y') : '-'); ?></td>
                                        <td class="px-3 py-2"><?php echo e(ucfirst($student->status ?? '-')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="text-xs text-slate-500 font-semibold"><?php echo e(__('app.equipment_utilization')); ?></div>
                        <div class="mt-2 text-2xl font-bold text-slate-900"><?php echo e($equipmentUtilization ?? 0); ?>%</div>
                        <div class="text-xs text-slate-400 mt-1"><?php echo e(__('app.assets_in_use')); ?></div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-5">
                        <div class="text-xs text-slate-500 font-semibold"><?php echo e(__('app.net_profit_month')); ?></div>
                        <div class="mt-2 text-2xl font-bold <?php echo e(($netProfit ?? 0) >= 0 ? 'text-emerald-600' : 'text-rose-600'); ?>">
                            <?php echo e(number_format($netProfit ?? 0)); ?> RWF
                        </div>
                        <div class="text-xs text-slate-400 mt-1"><?php echo e(__('app.revenue_minus_expenses')); ?></div>
                        <div class="mt-3 text-xs text-slate-500">
                            <div><?php echo e(__('app.expenses_this_month')); ?>: <span class="font-medium"><?php echo e(number_format($stats['totalExpensesThisMonth'] ?? 0)); ?> RWF</span></div>
                            <div><?php echo e(__('app.total_expenses')); ?>: <span class="font-medium"><?php echo e(number_format($stats['totalExpenses'] ?? 0)); ?> RWF</span></div>
                            <div><?php echo e(__('app.pending_expenses')); ?>: <span class="font-medium"><?php echo e($stats['pendingExpenses'] ?? 0); ?></span></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-5">
                        <div class="text-xs text-slate-500 font-semibold"><?php echo e(__('app.groups_coaches')); ?></div>
                        <div class="mt-2 text-2xl font-bold text-slate-900"><?php echo e($stats['totalGroups'] ?? 0); ?> / <?php echo e($stats['coachUsers'] ?? 0); ?></div>
                        <div class="text-xs text-slate-400 mt-1"><?php echo e(__('app.active_groupings')); ?></div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-5">
                        <div class="text-xs text-slate-500 font-semibold"><?php echo e(__('app.sessions_this_week')); ?></div>
                        <div class="mt-2 text-2xl font-bold text-slate-900"><?php echo e($stats['sessionsThisWeek'] ?? 0); ?></div>
                        <div class="text-xs text-slate-400 mt-1"><?php echo e(__('app.scheduled')); ?></div>
                    </div>
                </div>
            </div>

            <!-- System Health & Performance -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="card">
                    <div class="card-body p-6">
                        <h3 class="font-bold text-indigo-900 mb-4">⚙️ <?php echo e(__('app.system_health')); ?></h3>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 p-3 bg-emerald-50 border border-emerald-300 rounded-lg">
                                <span class="text-xl">✅</span>
                                <span class="text-sm font-semibold text-emerald-900"><?php echo e(__('app.database_optimal')); ?></span>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-emerald-50 border border-emerald-300 rounded-lg">
                                <span class="text-xl">✅</span>
                                <span class="text-sm font-semibold text-emerald-900"><?php echo e(__('app.api_endpoints_responsive')); ?></span>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-emerald-50 border border-emerald-300 rounded-lg">
                                <span class="text-xl">✅</span>
                                <span class="text-sm font-semibold text-emerald-900"><?php echo e(__('app.file_storage_adequate')); ?></span>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-amber-50 border border-amber-300 rounded-lg">
                                <span class="text-xl">⚠️</span>
                                <span class="text-sm font-semibold text-amber-900"><?php echo e(__('app.backup_last_2_hours')); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 card">
                    <div class="card-body p-6">
                        <h3 class="font-bold text-slate-900 mb-4">📋 <?php echo e(__('app.performance_metrics')); ?></h3>
                        <?php
                            $metricsBars = [
                                [__('app.student_enrollment_rate'), 'bg-gradient-to-r from-blue-500 to-blue-600', (isset($studentEnrollmentRate) ? $studentEnrollmentRate : 75) . '%'],
                                [__('app.session_attendance'), 'bg-gradient-to-r from-emerald-500 to-emerald-600', (isset($sessionAttendanceRate) ? $sessionAttendanceRate : 83) . '%'],
                                [__('app.revenue_target'), 'bg-gradient-to-r from-amber-500 to-amber-600', (isset($revenueProgress) ? $revenueProgress : 66) . '%'],
                                [__('app.equipment_status'), 'bg-gradient-to-r from-green-500 to-green-600', (isset($equipmentUtilPct) ? $equipmentUtilPct : 80) . '%'],
                            ];
                        ?>
                        <div class="space-y-4">
                            <?php $__currentLoopData = $metricsBars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-700"><?php echo e($m[0]); ?></span>
                                    <div class="w-3/12 h-2 bg-slate-200 rounded-full overflow-hidden">
                                        <div class="h-full <?php echo e($m[1]); ?>" style="width: <?php echo e($m[2]); ?>"></div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function(){
            if (typeof Chart === 'undefined') { console.error('Chart.js not found. Skipping chart initialization.'); return; }

            // Capacity sparkline
            try {
                const capCtx = document.getElementById('capacitySpendChart');
                if (capCtx) {
                    const capLabels = <?php echo json_encode($capacityMonthlyLabels ?? [], 15, 512) ?>;
                    const capTotals = <?php echo json_encode($capacityMonthlyTotals ?? [], 15, 512) ?>;
                    new Chart(capCtx, { type:'line', data:{ labels:capLabels, datasets:[{ data:capTotals, borderColor:'#0ea5e9', backgroundColor:'rgba(14,165,233,0.08)', fill:true, pointRadius:0 }] }, options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}}, scales:{ x:{display:false}, y:{display:false} } } });
                }
            } catch (err) { console.error('capacitySpendChart init error', err); }

        })();
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>