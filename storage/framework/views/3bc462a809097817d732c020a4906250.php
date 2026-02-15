<?php
    $title = __('app.coach_dashboard');
?>


<?php $__env->startSection('content'); ?>
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-4xl font-bold text-slate-900 dark:text-white">🏆 <?php echo e(__('app.coach_dashboard')); ?></h1>
            <p class="text-slate-600 dark:text-slate-400 mt-2"><?php echo e(__('app.welcome_back')); ?>, <span class="font-semibold"><?php echo e(Auth::user()->name); ?></span></p>
        </div>
        <a href="<?php echo e(route('admin.training_session_records.create')); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            <?php echo e(__('app.new_session')); ?>

        </a>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Students Stat -->
        <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-emerald-900/20 dark:to-emerald-800/20 rounded-xl p-6 border border-emerald-200 dark:border-emerald-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-600 dark:text-emerald-400 text-sm font-medium"><?php echo e(__('app.students')); ?></p>
                    <p class="text-3xl font-bold text-emerald-900 dark:text-emerald-100 mt-1"><?php echo e($activeStudents->count() ?? 0); ?></p>
                </div>
                <div class="text-4xl">🎓</div>
            </div>
        </div>

        <!-- Attendance Rate -->
        <div class="bg-gradient-to-br from-fuchsia-50 to-fuchsia-100 dark:from-fuchsia-900/20 dark:to-fuchsia-800/20 rounded-xl p-6 border border-fuchsia-200 dark:border-fuchsia-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-fuchsia-600 dark:text-fuchsia-400 text-sm font-medium"><?php echo e(__('app.attendance_rate')); ?></p>
                    <p class="text-3xl font-bold text-fuchsia-900 dark:text-fuchsia-100 mt-1"><?php echo e($attendanceRate ?? 0); ?>%</p>
                </div>
                <div class="text-4xl">✅</div>
            </div>
        </div>

        <!-- Sessions Stat -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-xl p-6 border border-blue-200 dark:border-blue-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-600 dark:text-blue-400 text-sm font-medium"><?php echo e(__('app.sessions')); ?></p>
                    <p class="text-3xl font-bold text-blue-900 dark:text-blue-100 mt-1"><?php echo e($allSessions->count() ?? 0); ?></p>
                </div>
                <div class="text-4xl">🎯</div>
            </div>
        </div>

        <!-- Messages Stat -->
        <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 dark:from-indigo-900/20 dark:to-indigo-800/20 rounded-xl p-6 border border-indigo-200 dark:border-indigo-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-indigo-600 dark:text-indigo-400 text-sm font-medium"><?php echo e(__('app.messages')); ?></p>
                    <p class="text-3xl font-bold text-indigo-900 dark:text-indigo-100 mt-1"><?php echo e($recentCommunications->count() ?? 0); ?></p>
                </div>
                <div class="text-4xl">📨</div>
            </div>
        </div>
    </div>

    <!-- Main Grid: Students & Today -->
    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Students Section -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white">👥 <?php echo e(__('app.my_students')); ?></h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        <?php $__empty_1 = true; $__currentLoopData = $students->take(100); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/40 transition">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <a href="<?php echo e(route('students-modern.show', $student)); ?>">
                                            <img src="<?php echo e($student->photo_url); ?>" class="w-10 h-10 rounded-full object-cover border border-slate-200 dark:border-slate-600 hover:border-blue-500 hover:scale-110 transition" alt="<?php echo e($student->first_name); ?>" loading="lazy" onerror="this.style.display='none'">
                                        </a>
                                        <div>
                                            <a href="<?php echo e(route('students-modern.show', $student)); ?>" class="hover:text-blue-600">
                                                <p class="font-semibold text-slate-900 dark:text-white text-sm"><?php echo e($student->first_name ?? 'N/A'); ?> <?php echo e($student->second_name ?? ''); ?></p>
                                            </a>
                                            <p class="text-xs text-slate-500"><?php echo e($student->group->name ?? 'No group'); ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-right">
                                    <a href="<?php echo e(route('students-modern.show', $student)); ?>" class="inline-flex text-xs px-3 py-1.5 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 rounded-md hover:bg-indigo-200 transition"><?php echo e(__('app.view')); ?></a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="2" class="p-12 text-center">
                                    <p class="text-4xl mb-3">📭</p>
                                    <p class="text-slate-500 dark:text-slate-400 font-medium"><?php echo e(__('app.no_students_assigned')); ?></p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Today's Sessions -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 flex flex-col">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white">📋 <?php echo e(__('app.today')); ?></h2>
            </div>
            <div class="flex-1 overflow-y-auto p-4 space-y-3">
                <?php $__empty_1 = true; $__currentLoopData = $sessionsToday; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="p-4 rounded-xl bg-gradient-to-br from-indigo-50 to-blue-50 dark:from-indigo-900/20 dark:to-blue-900/20 border border-indigo-200 dark:border-indigo-800">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-sm font-bold text-indigo-900 dark:text-indigo-100"><?php echo e($s->start_time ?? 'N/A'); ?> – <?php echo e($s->finish_time ?? 'N/A'); ?></span>
                            <span class="text-xs bg-indigo-600 text-white px-2 py-1 rounded"><?php echo e($s->training_pitch ?? $s->other_training_pitch ?? 'TBA'); ?></span>
                        </div>
                        <p class="text-xs text-slate-600 dark:text-slate-400 mb-3"><strong><?php echo e(__('app.sport')); ?>:</strong> <?php echo e($s->sport_discipline ?? 'Training'); ?></p>
                        <div class="flex gap-2">
                            <a href="<?php echo e(route('admin.training_session_records.show', $s)); ?>" class="flex-1 text-center text-xs py-2 border border-slate-300 dark:border-slate-600 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition font-medium"><?php echo e(__('app.details')); ?></a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center py-8">
                        <p class="text-3xl mb-2">📭</p>
                        <p class="text-slate-500 dark:text-slate-400 text-sm"><?php echo e(__('app.no_sessions_today')); ?></p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Recent Training Records -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700">
        <div class="p-6 border-b border-slate-200 dark:border-slate-700">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white">📊 <?php echo e(__('app.training_records')); ?></h2>
                <a href="<?php echo e(route('admin.training_session_records.index')); ?>" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline font-medium"><?php echo e(__('app.view_all')); ?> →</a>
            </div>
            <!-- Training Stats Mini Cards -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
                <div class="bg-green-50 dark:bg-green-900/20 rounded-lg p-3 border border-green-200 dark:border-green-800">
                    <p class="text-xs text-green-600 dark:text-green-400 font-medium">Completed</p>
                    <p class="text-2xl font-bold text-green-900 dark:text-green-100"><?php echo e($completedRecords ?? 0); ?></p>
                </div>
                <div class="bg-blue-50 dark:bg-blue-900/20 rounded-lg p-3 border border-blue-200 dark:border-blue-800">
                    <p class="text-xs text-blue-600 dark:text-blue-400 font-medium">In Progress</p>
                    <p class="text-2xl font-bold text-blue-900 dark:text-blue-100"><?php echo e($inProgressRecords ?? 0); ?></p>
                </div>
                <div class="bg-amber-50 dark:bg-amber-900/20 rounded-lg p-3 border border-amber-200 dark:border-amber-800">
                    <p class="text-xs text-amber-600 dark:text-amber-400 font-medium">Scheduled</p>
                    <p class="text-2xl font-bold text-amber-900 dark:text-amber-100"><?php echo e($scheduledRecords ?? 0); ?></p>
                </div>
                <div class="bg-purple-50 dark:bg-purple-900/20 rounded-lg p-3 border border-purple-200 dark:border-purple-800">
                    <p class="text-xs text-purple-600 dark:text-purple-400 font-medium">Kids Trained</p>
                    <p class="text-2xl font-bold text-purple-900 dark:text-purple-100"><?php echo e($totalKidsTrained ?? 0); ?></p>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-slate-50 dark:bg-slate-900/50">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Session</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider hidden md:table-cell">Time</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider hidden lg:table-cell">Location</th>
                        <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider hidden xl:table-cell">Kids</th>
                        <th class="px-4 py-3 text-right text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    <?php $__empty_1 = true; $__currentLoopData = $recentTrainingRecords->take(8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/40 transition">
                            <td class="p-4">
                                <div class="flex items-center gap-3">
                                    <div class="flex-shrink-0">
                                        <?php if($record->status === 'completed'): ?>
                                            <span class="w-2.5 h-2.5 rounded-full bg-green-500 block" title="Completed"></span>
                                        <?php elseif($record->status === 'in_progress'): ?>
                                            <span class="w-2.5 h-2.5 rounded-full bg-blue-500 block animate-pulse" title="In Progress"></span>
                                        <?php else: ?>
                                            <span class="w-2.5 h-2.5 rounded-full bg-slate-300 dark:bg-slate-600 block" title="Scheduled"></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="min-w-0">
                                        <a href="<?php echo e(route('admin.training_session_records.show', $record)); ?>" class="font-semibold text-slate-900 dark:text-white text-sm hover:text-indigo-600 transition block truncate">
                                            <?php echo e($record->main_topic ?? $record->training_objective ?? 'Training Session'); ?>

                                        </a>
                                        <div class="flex items-center gap-2 mt-0.5">
                                            <p class="text-xs text-slate-500"><?php echo e($record->date instanceof \Carbon\Carbon ? $record->date->format('M d, Y') : $record->date); ?></p>
                                            <span class="text-slate-300 dark:text-slate-600">•</span>
                                            <p class="text-xs text-slate-500"><?php echo e($record->branch ?? 'N/A'); ?></p>
                                        </div>
                                        <span class="inline-flex md:hidden items-center px-2 py-0.5 text-xs font-medium rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 mt-1">
                                            <?php echo e($record->sport_discipline ?? 'Sport'); ?>

                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 hidden md:table-cell">
                                <div class="text-sm text-slate-900 dark:text-white font-medium">
                                    <?php echo e($record->start_time ?? 'N/A'); ?>

                                </div>
                                <div class="text-xs text-slate-500">
                                    to <?php echo e($record->finish_time ?? 'N/A'); ?>

                                </div>
                            </td>
                            <td class="p-4 hidden lg:table-cell">
                                <div class="text-sm text-slate-700 dark:text-slate-300">
                                    <?php echo e($record->training_pitch ?? $record->other_training_pitch ?? 'N/A'); ?>

                                </div>
                                <div class="text-xs text-slate-500">
                                    <?php echo e($record->city ?? ''); ?>

                                </div>
                            </td>
                            <td class="p-4 hidden xl:table-cell text-center">
                                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 font-bold text-sm">
                                    <?php echo e($record->number_of_kids ?? 0); ?>

                                </span>
                            </td>
                            <td class="p-4 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <span class="hidden md:inline-flex items-center px-2.5 py-0.5 text-xs font-medium rounded-full bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400">
                                        <?php echo e($record->sport_discipline ?? 'Sport'); ?>

                                    </span>
                                    <a href="<?php echo e(route('admin.training_session_records.show', $record)); ?>" class="p-2 bg-slate-100 dark:bg-slate-700 text-slate-500 dark:text-slate-400 rounded-lg hover:bg-indigo-50 hover:text-indigo-600 dark:hover:bg-indigo-900/30 dark:hover:text-indigo-400 transition" title="View Details">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="p-12 text-center">
                                <p class="text-4xl mb-3">📋</p>
                                <p class="text-slate-500 dark:text-slate-400 font-medium"><?php echo e(__('app.no_training_records')); ?></p>
                                <p class="text-xs text-slate-400 dark:text-slate-500 mt-2">Create your first training session record</p>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/coach/dashboard.blade.php ENDPATH**/ ?>