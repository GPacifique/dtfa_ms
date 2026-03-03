<?php $__env->startSection('meta_title', 'Report #'.($report->no ?? $report->id).' — '.config('app.name', 'App')); ?>
<?php $__env->startSection('meta_description', 'Details for report '.($report->no ?? $report->id).': workstream '.($report->workstream ?? 'N/A').', activity '.($report->activity ?? 'N/A').', status '.($report->status ?? 'N/A').'.'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Report Details</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>No:</strong> <?php echo e($report->no); ?></p>
            <p><strong>Workstream:</strong> <?php echo e($report->workstream); ?></p>
            <p><strong>Activity:</strong> <?php echo e($report->activity); ?></p>
            <p><strong>Status:</strong> <?php echo e($report->status); ?></p>
            <p><strong>Comments:</strong> <?php echo e($report->comments); ?></p>
        </div>
    </div>
    <a href="<?php echo e(route('reports.index')); ?>" class="btn btn-secondary mt-3">Back to List</a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\reports\show.blade.php ENDPATH**/ ?>