<?php $__env->startSection('content'); ?>
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-semibold mb-4">Edit Team</h2>

        <form action="<?php echo e(route('admin.teams.update', $team)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="mb-3">
                <label class="block">Name</label>
                <input type="text" name="name" class="border p-2 w-full" value="<?php echo e(old('name', $team->name)); ?>">
            </div>
            <div class="mb-3">
                <label class="block">Description</label>
                <textarea name="description" class="border p-2 w-full"><?php echo e(old('description', $team->description)); ?></textarea>
            </div>
            <div>
                <button class="btn btn-primary">Save</button>
                <a href="<?php echo e(route('admin.teams.index')); ?>" class="ml-2">Cancel</a>
                <form action="<?php echo e(route('admin.teams.destroy', $team)); ?>" method="POST" class="inline ml-3" onsubmit="return confirm('Delete this team? This action cannot be undone.');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="text-red-600">Delete</button>
                </form>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\teams\edit.blade.php ENDPATH**/ ?>