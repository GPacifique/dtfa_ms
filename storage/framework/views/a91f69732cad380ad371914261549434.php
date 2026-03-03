<?php echo csrf_field(); ?>
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-slate-700">Date</label>
        <input type="date" name="date" value="<?php echo e(old('date', optional(optional($session)->date)->toDateString() ?? '')); ?>" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Start Time</label>
        <input type="time" name="start_time" value="<?php echo e(old('start_time', $session->start_time ?? '')); ?>" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">End Time</label>
        <input type="time" name="end_time" value="<?php echo e(old('end_time', $session->end_time ?? '')); ?>" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Location</label>
        <input type="text" name="location" value="<?php echo e(old('location', $session->location ?? '')); ?>" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Branch</label>
            <select name="branch_id" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required>
            <option value="">-- Select branch --</option>
            <?php $__currentLoopData = $branches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($b->id); ?>" <?php echo e((old('branch_id', optional($session)->branch_id ?? '') == $b->id) ? 'selected' : ''); ?>><?php echo e($b->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Group</label>
            <select name="group_id" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required>
            <option value="">-- Select group --</option>
            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($g->id); ?>" <?php echo e((old('group_id', optional($session)->group_id ?? '') == $g->id) ? 'selected' : ''); ?>><?php echo e($g->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Coach</label>
            <select name="coach_user_id" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required>
            <option value="">-- Select coach --</option>
            <?php $__currentLoopData = $coaches; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($c->id); ?>" <?php echo e((old('coach_user_id', optional($session)->coach_user_id ?? '') == $c->id) ? 'selected' : ''); ?>><?php echo e($c->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

<?php if($errors->any()): ?>
    <div class="mt-4 text-sm text-rose-600">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($err); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\inhousetrainings\_form.blade.php ENDPATH**/ ?>