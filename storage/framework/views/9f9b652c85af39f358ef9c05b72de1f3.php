<?php $__env->startSection('content'); ?>
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">💬 Communications</h1>
            <a href="<?php echo e(route('admin.communications.create')); ?>" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">➕ New Message</a>
        </div>

        <div class="space-y-4">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="p-4 border rounded bg-white dark:bg-neutral-800">
                    <h3 class="font-semibold"><?php echo e($item->title); ?></h3>
                    <p class="text-sm text-slate-600"><?php echo e($item->created_at->toDayDateTimeString()); ?> by <?php echo e(optional($item->sender)->name ?? 'DTFA'); ?></p>
                    <div class="mt-2">
                        <a href="<?php echo e(route('admin.communications.show', $item)); ?>" class="text-blue-600">View</a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-4">
            <?php echo e($items->links()); ?>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\communications\index.blade.php ENDPATH**/ ?>