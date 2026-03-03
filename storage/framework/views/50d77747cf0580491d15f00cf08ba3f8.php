<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto p-6">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-slate-900">📋 Record Attendance</h1>
        <p class="text-slate-600 mt-1">Session: <span class="font-semibold"><?php echo e($session->date->format('M d, Y')); ?> • <?php echo e($session->start_time); ?> - <?php echo e($session->end_time); ?></span></p>
        <p class="text-slate-600">📍 Location: <span class="font-semibold"><?php echo e($session->location); ?></span> • Group: <span class="font-semibold"><?php echo e(optional($session->group)->name ?? $session->group_name); ?></span></p>
    </div>

    <form method="POST" action="<?php echo e(route('coach.attendance.store', $session)); ?>" class="space-y-6">
        <?php echo csrf_field(); ?>
        
        <!-- Students Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-700 rounded-lg p-4 shadow-sm hover:shadow-md transition">
                    <!-- Student Header Card -->
                    <div class="flex items-start justify-between mb-3 pb-3 border-b border-slate-100 dark:border-neutral-700">
                        <div class="flex-1">
                            <h3 class="font-bold text-slate-900 dark:text-white text-lg"><?php echo e($student->first_name); ?> <?php echo e($student->second_name); ?></h3>
                            <div class="flex items-center gap-2 mt-1">
                                <?php if($student->jersey_number): ?>
                                    <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs font-bold rounded">Jersey #<?php echo e($student->jersey_number); ?></span>
                                <?php endif; ?>
                                <?php if($student->jersey_name): ?>
                                    <span class="inline-block px-2 py-1 bg-purple-100 text-purple-800 text-xs font-semibold rounded"><?php echo e($student->jersey_name); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Status -->
                    <div class="mb-4">
                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase mb-2">Attendance Status</label>
                        <select name="attendance[<?php echo e($student->id); ?>][status]" class="w-full border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500">
                            <option value="present" <?php if(($existing[$student->id] ?? '') === 'present'): echo 'selected'; endif; ?>>✓ Present</option>
                            <option value="absent" <?php if(($existing[$student->id] ?? '') === 'absent'): echo 'selected'; endif; ?>>✗ Absent</option>
                        </select>
                        <input type="hidden" name="attendance[<?php echo e($student->id); ?>][student_id]" value="<?php echo e($student->id); ?>">
                    </div>

                    <!-- Notes -->
                    <div>
                        <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase mb-2">Notes</label>
                        <input type="text" name="attendance[<?php echo e($student->id); ?>][notes]" value="" placeholder="e.g., Injury, Late arrival..." class="w-full border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                    </div>

                    <!-- Action Links -->
                    <div class="mt-4 pt-3 border-t border-slate-100 dark:border-neutral-700 flex gap-2">
                        <a href="<?php echo e(route('coach.students.show', $student)); ?>" class="text-xs text-indigo-600 hover:text-indigo-800 font-semibold underline">View Profile</a>
                        <a href="<?php echo e(route('coach.students.attendance', $student)); ?>" class="text-xs text-indigo-600 hover:text-indigo-800 font-semibold underline">History</a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Form Actions -->
        <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-200 dark:border-neutral-700">
        <a href="<?php echo e(route('coach.attendance.index')); ?>" class="px-4 py-2 border border-slate-300 dark:border-neutral-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-neutral-800 transition font-semibold">← Back</a>
            <button type="submit" class="px-6 py-2 bg-gradient-to-r from-indigo-600 to-blue-600 text-white rounded-lg hover:shadow-lg transition font-semibold">💾 Save Attendance</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\coach\attendance\show.blade.php ENDPATH**/ ?>