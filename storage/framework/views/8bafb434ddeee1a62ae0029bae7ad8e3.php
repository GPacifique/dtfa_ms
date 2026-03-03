<?php
    $isEdit = isset($attendance) && $attendance->exists;
    $get = fn($k, $default='') => old($k, $isEdit ? ($attendance->$k ?? $default) : $default);
    $activityOptions = \App\Models\StaffAttendance::activityOptions();
    $statusOptions = \App\Models\StaffAttendance::statusOptions();
?>

<div class="grid grid-cols-1 gap-6">
    <div>
        <label class="block text-sm font-medium text-gray-700">Staff</label>
        <select name="staff_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            <option value="">-- Select Staff --</option>
            <?php $__currentLoopData = $staff; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($s->id); ?>" <?php echo e((string)$s->id === (string)$get('staff_id') ? 'selected' : ''); ?>><?php echo e($s->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Activity</label>
        <select name="activity_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            <?php $__currentLoopData = $activityOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($key); ?>" <?php echo e($get('activity_type') === $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Date</label>
        <input type="date" name="date" value="<?php echo e($get('date')); ?>" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            <?php $__currentLoopData = $statusOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($key); ?>" <?php echo e($get('status') === $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Notes</label>
        <textarea name="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"><?php echo e($get('notes')); ?></textarea>
    </div>
</div>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\staff_attendances\_form.blade.php ENDPATH**/ ?>