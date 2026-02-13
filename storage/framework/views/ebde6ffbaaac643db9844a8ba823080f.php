<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Training Session Report</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">Record attendance, incidents, and session feedback</p>
        </div>
        <a href="<?php echo e(route('admin.training_session_records.index')); ?>" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 font-medium transition">
            ← Back to Records
        </a>
    </div>

    <!-- Session Info Card -->
    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 rounded-xl shadow-xl p-6 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm opacity-90 mb-2"><?php echo e($trainingSessionRecord->date?->format('l, F j, Y') ?? 'N/A'); ?></p>
                <div class="flex items-center gap-4 text-2xl font-bold">
                    <span><?php echo e($trainingSessionRecord->sport_discipline ?? 'Training Session'); ?></span>
                    <span class="opacity-75">•</span>
                    <span><?php echo e($trainingSessionRecord->coach_name ?? 'Coach'); ?></span>
                </div>
                <p class="text-sm opacity-90 mt-2">
                    📍 <?php echo e($trainingSessionRecord->training_pitch ?? 'N/A'); ?> •
                    ⏰ <?php echo e($trainingSessionRecord->start_time); ?> - <?php echo e($trainingSessionRecord->finish_time); ?>

                </p>
            </div>
        </div>
    </div>

    <form action="<?php echo e(route('admin.training_session_records.update', $trainingSessionRecord)); ?>" method="POST" class="bg-white dark:bg-neutral-900 shadow rounded-xl p-8">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Attendance Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-blue-500">
                👥 Attendance
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Number of Kids</label>
                    <input type="number" name="number_of_kids" value="<?php echo e($trainingSessionRecord->number_of_kids ?? ''); ?>" min="0" class="w-full text-4xl font-bold text-center border-2 border-blue-300 dark:border-blue-700 rounded-lg px-4 py-6 dark:bg-neutral-800 focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="0">
                    <?php $__errorArgs = ['number_of_kids'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-2 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <p class="text-center text-sm text-gray-500 mt-2">Total attendees</p>
                </div>

                <div class="md:col-span-2 p-6 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Attendance Notes</label>
                    <textarea rows="5" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="List names of attendees, absent students, late arrivals, etc..." readonly>This field is for display only. Use the student attendance module for detailed tracking.</textarea>
                    <p class="text-xs text-gray-500 mt-2">💡 Tip: Use the Student Attendance module for detailed individual tracking</p>
                </div>
            </div>
        </div>

        <!-- Incidents & Issues Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-orange-500">
                ⚠️ Incidents & Issues
            </h2>

            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Incident Report</label>
                    <textarea name="incident_report" rows="5" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-orange-500 focus:border-transparent" placeholder="Describe any incidents, injuries, conflicts, or unusual events during the session..."><?php echo e($trainingSessionRecord->incident_report ?? ''); ?></textarea>
                    <?php $__errorArgs = ['incident_report'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Missed or Damaged Equipment</label>
                    <textarea name="missed_damaged_equipment" rows="4" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-orange-500 focus:border-transparent" placeholder="List any missing or damaged equipment (balls, cones, bibs, goals, etc.)..."><?php echo e($trainingSessionRecord->missed_damaged_equipment ?? ''); ?></textarea>
                    <?php $__errorArgs = ['missed_damaged_equipment'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
        </div>

        <!-- Session Evaluation Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-teal-500">
                📊 Session Evaluation & Feedback
            </h2>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Comments & Overall Feedback</label>
                <textarea name="comments" rows="8" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-teal-500 focus:border-transparent" placeholder="Overall session evaluation:
- How well did the session go?
- Were the objectives achieved?
- Student engagement and performance
- Areas of improvement for next session
- Standout performers
- Challenges faced
- Recommendations"><?php echo e($trainingSessionRecord->comments ?? ''); ?></textarea>
                <?php $__errorArgs = ['comments'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span class="text-red-600 text-sm mt-1 block"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <!-- Session Summary (Read-only) -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-purple-500">
                📋 Session Summary (Reference)
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                    <h3 class="font-semibold text-purple-900 dark:text-purple-200 mb-2">Training Objective</h3>
                    <p class="text-sm text-gray-700 dark:text-gray-300"><?php echo e($trainingSessionRecord->training_objective ?? 'N/A'); ?></p>
                </div>

                <div class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                    <h3 class="font-semibold text-purple-900 dark:text-purple-200 mb-2">Main Topic</h3>
                    <p class="text-sm text-gray-700 dark:text-gray-300"><?php echo e($trainingSessionRecord->main_topic ?? 'N/A'); ?></p>
                </div>

                <div class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                    <h3 class="font-semibold text-purple-900 dark:text-purple-200 mb-2">Area of Performance</h3>
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                        <?php if($trainingSessionRecord->area_performance): ?>
                            <?php if($trainingSessionRecord->area_performance == 'Physical'): ?> 💪
                            <?php elseif($trainingSessionRecord->area_performance == 'Technical'): ?> ⚙️
                            <?php elseif($trainingSessionRecord->area_performance == 'Tactical'): ?> ♟️
                            <?php elseif($trainingSessionRecord->area_performance == 'Mental'): ?> 🧠
                            <?php endif; ?>
                            <?php echo e($trainingSessionRecord->area_performance); ?>

                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </p>
                </div>

                <div class="p-4 bg-purple-50 dark:bg-purple-900/20 rounded-lg">
                    <h3 class="font-semibold text-purple-900 dark:text-purple-200 mb-2">Location</h3>
                    <p class="text-sm text-gray-700 dark:text-gray-300">
                        <?php echo e($trainingSessionRecord->branch ?? 'N/A'); ?> • <?php echo e($trainingSessionRecord->city ?? 'N/A'); ?>

                    </p>
                </div>
            </div>

            <?php if($trainingSessionRecord->part1_activities || $trainingSessionRecord->part2_activities): ?>
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php if($trainingSessionRecord->part1_activities): ?>
                <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <h3 class="font-semibold text-blue-900 dark:text-blue-200 mb-2">Part 1 Activities</h3>
                    <p class="text-sm text-gray-700 dark:text-gray-300"><?php echo e($trainingSessionRecord->part1_activities); ?></p>
                </div>
                <?php endif; ?>

                <?php if($trainingSessionRecord->part2_activities): ?>
                <div class="p-4 bg-teal-50 dark:bg-teal-900/20 rounded-lg">
                    <h3 class="font-semibold text-teal-900 dark:text-teal-200 mb-2">Part 2 Activities</h3>
                    <p class="text-sm text-gray-700 dark:text-gray-300"><?php echo e($trainingSessionRecord->part2_activities); ?></p>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-neutral-700">
            <a href="<?php echo e(route('admin.training_session_records.index')); ?>" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 font-semibold transition">
                Cancel
            </a>
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 hover:to-teal-700 text-white rounded-lg font-semibold shadow-lg transition transform hover:scale-105">
                ✅ Save Report
            </button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/admin/training_session_records/report.blade.php ENDPATH**/ ?>