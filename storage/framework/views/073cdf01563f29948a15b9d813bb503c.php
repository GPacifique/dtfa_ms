<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reports PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <div style="display:flex;justify-content:space-between;align-items:center">
        <h2>Reports</h2>
        <div style="text-align:right;font-size:12px;color:#555">
            Generated: <?php echo e(now()->format('F j, Y')); ?><br>
            Year: <?php echo e(now()->year); ?>

            <?php if(!empty($user)): ?><br>Generated for: <?php echo e($user->name); ?><?php endif; ?>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Workstream</th>
                <th>Activity</th>
                <th>Status</th>
                <th>Comments</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($report->no); ?></td>
                <td><?php echo e($report->workstream); ?></td>
                <td><?php echo e($report->activity); ?></td>
                <td><?php echo e($report->status); ?></td>
                <td><?php echo e($report->comments); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</body>
</html>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\reports\pdf.blade.php ENDPATH**/ ?>