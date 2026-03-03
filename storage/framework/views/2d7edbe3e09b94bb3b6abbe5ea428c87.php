<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Assign Roles To User</h1>

    <?php if(session('status')): ?>
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800"><?php echo e(session('status')); ?></div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('admin.roles.assign')); ?>" class="space-y-4">
        <?php echo csrf_field(); ?>
        <div>
            <label class="block text-sm font-semibold">Select User</label>
            <select name="user_id" required class="w-full border rounded px-3 py-2">
                <option value="">— Select user —</option>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($u->id); ?>"><?php echo e($u->name); ?> (<?php echo e($u->email); ?>)</option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">Roles</label>
            <div class="grid grid-cols-2 gap-2">
                <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="roles[]" value="<?php echo e($r->name); ?>" />
                        <span class="text-sm"><?php echo e($r->name); ?></span>
                    </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <div class="flex justify-end">
            <button class="px-6 py-2 bg-indigo-600 text-white rounded">Save</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\roles\assign.blade.php ENDPATH**/ ?>