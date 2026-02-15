<?php $__env->startSection('content'); ?>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-bold mb-4">New Communication</h1>

        <form action="<?php echo e(route('admin.communications.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo $__env->make('admin.communications._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <div class="mt-4">
                <button class="px-4 py-2 bg-green-600 text-white rounded">Send</button>
                <a href="<?php echo e(route('admin.communications.index')); ?>" class="ml-2 text-sm">Back</a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/admin/communications/create.blade.php ENDPATH**/ ?>