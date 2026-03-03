<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Role: <?php echo e($role->name); ?></h1>

    <form method="POST" action="<?php echo e(route('admin.roles.update', $role)); ?>" class="space-y-4">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="permissions[]" value="<?php echo e($perm->name); ?>" <?php if(in_array($perm->name, $rolePermissions)): echo 'checked'; endif; ?> />
                    <span class="text-sm"><?php echo e($perm->name); ?></span>
                </label>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="flex justify-end">
            <a href="<?php echo e(route('admin.roles.index')); ?>" class="px-4 py-2 border rounded mr-2">Back</a>
            <button class="px-6 py-2 bg-indigo-600 text-white rounded">✅Save</button>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\roles\edit.blade.php ENDPATH**/ ?>