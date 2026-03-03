<?php $__env->startSection('content'); ?>
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-semibold mb-4">Create Team</h2>

        <form action="<?php echo e(route('admin.teams.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="block">Name</label>
                <input type="text" name="name" class="border p-2 w-full" value="<?php echo e(old('name')); ?>">
            </div>
            <div class="mb-3">
                <label class="block">Description</label>
                <textarea name="description" class="border p-2 w-full"><?php echo e(old('description')); ?></textarea>
            </div>
            <div>
                <button class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\teams\create.blade.php ENDPATH**/ ?>