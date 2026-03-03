<?php $__env->startSection('content'); ?>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-bold"><?php echo e($communication->title); ?></h1>
        <p class="text-sm text-slate-600"><?php echo e($communication->created_at->toDayDateTimeString()); ?> by <?php echo e(optional($communication->sender)->name ?? 'DTFA'); ?></p>

        <div class="mt-4 bg-white dark:bg-neutral-800 p-4 rounded border">
            <?php echo nl2br(e($communication->body)); ?>

        </div>

        <?php if($communication->minutes): ?>
            <div class="mt-4 bg-white dark:bg-neutral-800 p-4 rounded border">
                <h3 class="font-semibold">Minutes</h3>
                <?php echo nl2br(e($communication->minutes)); ?>

            </div>
        <?php endif; ?>

        <div class="mt-4">
            <a href="<?php echo e(route('admin.communications.index')); ?>" class="text-sm">Back</a>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\communications\show.blade.php ENDPATH**/ ?>