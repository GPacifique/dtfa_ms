<?php $__env->startSection('title', 'Attendance Report'); ?>

<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">

    
    <div class="footer-like-hero relative overflow-hidden">
        <div class="hero-blob-layer">
            <div class="hero-blob blob-1"></div>
            <div class="hero-blob blob-2"></div>
            <div class="hero-blob blob-3"></div>
        </div>

        <div class="relative z-10 container mx-auto px-6 py-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">📊 Player Attendance Report</h1>
            <p class="text-blue-100">Comprehensive analytics and statistics</p>
        </div>
    </div>

    <div class="container mx-auto px-6 -mt-8 pb-12">

        
        <div class="card mb-6">
            <div class="card-body">
                <form method="GET" action="<?php echo e(route('admin.student-attendance.report')); ?>" class="flex flex-wrap items-end gap-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Date From</label>
                        <input type="date" name="date_from" value="<?php echo e($dateFrom); ?>" class="border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Date To</label>
                        <input type="date" name="date_to" value="<?php echo e($dateTo); ?>" class="border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white">
                    </div>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">
                        🔍 Generate Report
                    </button>
                    <a href="<?php echo e(route('admin.student-attendance.index')); ?>" class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition font-semibold">
                        ← Back
                    </a>
                    <a href="<?php echo e(route('admin.student-attendance.report.export', ['date_from' => $dateFrom, 'date_to' => $dateTo])); ?>" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-semibold">
                        ⬇️ Download PDF
                    </a>
                </form>
            </div>
        </div>

        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
            <div class="card group hover:shadow-xl transition-all duration-300">
                <div class="card-body text-center">
                    <div class="text-3xl mb-2">📋</div>
                    <div class="text-2xl font-bold text-slate-900 dark:text-white"><?php echo e($stats['total']); ?></div>
                    <div class="text-sm text-slate-600 dark:text-slate-400">Total Records</div>
                </div>
            </div>

            <div class="card group hover:shadow-xl transition-all duration-300">
                <div class="card-body text-center">
                    <div class="text-3xl mb-2">✅</div>
                    <div class="text-2xl font-bold text-green-600"><?php echo e($stats['present']); ?></div>
                    <div class="text-sm text-slate-600 dark:text-slate-400">Present</div>
                    <?php if($stats['total'] > 0): ?>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(round(($stats['present'] / $stats['total']) * 100, 1)); ?>%</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card group hover:shadow-xl transition-all duration-300">
                <div class="card-body text-center">
                    <div class="text-3xl mb-2">❌</div>
                    <div class="text-2xl font-bold text-red-600"><?php echo e($stats['absent']); ?></div>
                    <div class="text-sm text-slate-600 dark:text-slate-400">Absent</div>
                    <?php if($stats['total'] > 0): ?>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(round(($stats['absent'] / $stats['total']) * 100, 1)); ?>%</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card group hover:shadow-xl transition-all duration-300">
                <div class="card-body text-center">
                    <div class="text-3xl mb-2">⏰</div>
                    <div class="text-2xl font-bold text-yellow-600"><?php echo e($stats['late']); ?></div>
                    <div class="text-sm text-slate-600 dark:text-slate-400">Late</div>
                    <?php if($stats['total'] > 0): ?>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(round(($stats['late'] / $stats['total']) * 100, 1)); ?>%</div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="card group hover:shadow-xl transition-all duration-300">
                <div class="card-body text-center">
                    <div class="text-3xl mb-2">📝</div>
                    <div class="text-2xl font-bold text-blue-600"><?php echo e($stats['excused']); ?></div>
                    <div class="text-sm text-slate-600 dark:text-slate-400">Excused</div>
                    <?php if($stats['total'] > 0): ?>
                        <div class="text-xs text-slate-500 mt-1"><?php echo e(round(($stats['excused'] / $stats['total']) * 100, 1)); ?>%</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="card mb-8">
            <div class="card-body">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">📈 Attendance Distribution</h2>
                <div class="h-64">
                    <canvas id="attendanceChart"></canvas>
                </div>
            </div>
        </div>

        
        <div class="card">
            <div class="card-body">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">🏆 Top Attending Students</h2>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-slate-700 dark:text-slate-300 uppercase bg-slate-50 dark:bg-neutral-800">
                            <tr>
                                <th class="px-4 py-3">Rank</th>
                                <th class="px-4 py-3">Student Name</th>
                                <th class="px-4 py-3">Branch</th>
                                <th class="px-4 py-3">Group</th>
                                <th class="px-4 py-3">Present Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__empty_1 = true; $__currentLoopData = $topStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr class="border-b dark:border-neutral-700">
                                    <td class="px-4 py-3">
                                        <?php if($index == 0): ?>
                                            🥇
                                        <?php elseif($index == 1): ?>
                                            🥈
                                        <?php elseif($index == 2): ?>
                                            🥉
                                        <?php else: ?>
                                            <?php echo e($index + 1); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-3 font-semibold">
                                        <a href="<?php echo e(route('students-modern.show', $student)); ?>" class="text-indigo-600 hover:text-indigo-800">
                                            <?php echo e($student->first_name); ?> <?php echo e($student->second_name); ?>

                                        </a>
                                    </td>
                                    <td class="px-4 py-3"><?php echo e(optional($student->branch)->name ?? 'N/A'); ?></td>
                                    <td class="px-4 py-3"><?php echo e(optional($student->group)->name ?? 'N/A'); ?></td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded font-bold"><?php echo e($student->present_count); ?></span>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-slate-500">No attendance data available for the selected period</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('attendanceChart');
    if (ctx) {
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Present', 'Absent', 'Late', 'Excused'],
                datasets: [{
                    data: [<?php echo e($stats['present']); ?>, <?php echo e($stats['absent']); ?>, <?php echo e($stats['late']); ?>, <?php echo e($stats['excused']); ?>],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(239, 68, 68, 0.8)',
                        'rgba(234, 179, 8, 0.8)',
                        'rgba(59, 130, 246, 0.8)'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed || 0;
                                const total = <?php echo e($stats['total']); ?>;
                                const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\student-attendance\report.blade.php ENDPATH**/ ?>