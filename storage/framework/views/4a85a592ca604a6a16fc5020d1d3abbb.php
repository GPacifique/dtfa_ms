<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Edit Report</h1>
    <form action="<?php echo e(route('reports.update', $report->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <label>No</label>
            <input type="number" name="no" class="form-control" value="<?php echo e(old('no', $report->no)); ?>" required>
        </div>
        <div class="mb-3">
            <label>Workstream</label>
            <select name="workstream" class="form-control" required>
                <option value="SPORTING" <?php echo e($report->workstream == 'SPORTING' ? 'selected' : ''); ?>>Sporting</option>
                <option value="BUSINESS" <?php echo e($report->workstream == 'BUSINESS' ? 'selected' : ''); ?>>Business</option>
                <option value="ADMINISTRATION" <?php echo e($report->workstream == 'ADMINISTRATION' ? 'selected' : ''); ?>>Administration</option>
                <option value="TECHNOLOGY" <?php echo e($report->workstream == 'TECHNOLOGY' ? 'selected' : ''); ?>>Technology</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Activity</label>
            <input type="text" name="activity" class="form-control" value="<?php echo e(old('activity', $report->activity)); ?>" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="RED" <?php echo e($report->status == 'RED' ? 'selected' : ''); ?>>Red</option>
                <option value="YELLOW" <?php echo e($report->status == 'YELLOW' ? 'selected' : ''); ?>>Yellow</option>
                <option value="GREEN" <?php echo e($report->status == 'GREEN' ? 'selected' : ''); ?>>Green</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Comments</label>
            <textarea name="comments" class="form-control"><?php echo e(old('comments', $report->comments)); ?></textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="<?php echo e(route('reports.index')); ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\reports\edit.blade.php ENDPATH**/ ?>