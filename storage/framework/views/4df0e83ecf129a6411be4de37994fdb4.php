<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Attendance for <?php echo e($session->date->format('M d, Y')); ?> — <?php echo e($session->group->name ?? $session->group_name); ?></h1>
        <div>
            <a href="<?php echo e(route('admin.training_session_records.index')); ?>" class="px-3 py-2 bg-gray-200 rounded">Back</a>
        </div>
    </div>

    <form method="POST" action="<?php echo e(route('admin.sessions.attendance.store', $session)); ?>">
        <?php echo csrf_field(); ?>

        <div class="bg-white shadow rounded p-4 mb-4">
            <table class="w-full table-auto">
                <thead>
                    <tr>
                        <th class="text-left">Student</th>
                        <th class="text-left">Status</th>
                        <th class="text-left">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $rec = $existing->get($student->id);
                            $status = $rec?->status ?? 'absent';
                            $notes = $rec?->notes ?? '';
                        ?>
                        <tr class="border-t">
                            <td class="py-2"><?php echo e($student->name ?? ($student->first_name . ' ' . ($student->last_name ?? ''))); ?></td>
                            <td class="py-2">
                                <select name="attendances[<?php echo e($student->id); ?>][status]" class="border p-1">
                                    <option value="present" <?php echo e($status === 'present' ? 'selected' : ''); ?>>Present</option>
                                    <option value="absent" <?php echo e($status === 'absent' ? 'selected' : ''); ?>>Absent</option>
                                    <option value="late" <?php echo e($status === 'late' ? 'selected' : ''); ?>>Late</option>
                                    <option value="excused" <?php echo e($status === 'excused' ? 'selected' : ''); ?>>Excused</option>
                                </select>
                            </td>
                            <td class="py-2">
                                <input type="text" name="attendances[<?php echo e($student->id); ?>][notes]" class="border p-1 w-full" value="<?php echo e(old('attendances.'.$student->id.'.notes', $notes)); ?>">
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td colspan="3" class="py-4 text-sm text-slate-500">No students found for this session's group/branch.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="flex gap-3">
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Save Attendance</button>
            <a href="<?php echo e(route('admin.sessions.recordAllAttendance', $session)); ?>" class="px-4 py-2 bg-emerald-500 text-white rounded" onclick="return confirm('Mark all students present?');">Mark All Present</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\capacity_buildings\attendance.blade.php ENDPATH**/ ?>