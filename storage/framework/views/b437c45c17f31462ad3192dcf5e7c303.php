<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student Attendance Report</title>
    <style>
        body { font-family: DejaVu Sans, Arial, sans-serif; color: #111; }
        h1 { font-size: 20px; margin: 0 0 8px; }
        h2 { font-size: 16px; margin: 16px 0 8px; }
        .muted { color: #555; }
        .grid { display: flex; gap: 12px; }
        .card { border: 1px solid #ddd; border-radius: 6px; padding: 10px; flex: 1; }
        .stats { margin: 10px 0 16px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; font-size: 12px; }
        th { background: #f3f4f6; text-align: left; }
        .header { display: flex; justify-content: space-between; align-items: baseline; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Student Attendance Report</h1>
        <div class="muted">Range: <?php echo e($dateFrom); ?> to <?php echo e($dateTo); ?></div>
    </div>

    <div class="stats grid">
        <div class="card">
            <div>Total</div>
            <div style="font-weight: bold; font-size: 18px;"><?php echo e($stats['total'] ?? 0); ?></div>
        </div>
        <div class="card">
            <div>Present</div>
            <div style="font-weight: bold; font-size: 18px;"><?php echo e($stats['present'] ?? 0); ?></div>
        </div>
        <div class="card">
            <div>Absent</div>
            <div style="font-weight: bold; font-size: 18px;"><?php echo e($stats['absent'] ?? 0); ?></div>
        </div>
        <div class="card">
            <div>Late</div>
            <div style="font-weight: bold; font-size: 18px;"><?php echo e($stats['late'] ?? 0); ?></div>
        </div>
        <div class="card">
            <div>Excused</div>
            <div style="font-weight: bold; font-size: 18px;"><?php echo e($stats['excused'] ?? 0); ?></div>
        </div>
    </div>

    <h2>Top Students (Present Count)</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Present Sessions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $topStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($i + 1); ?></td>
                    <td><?php echo e($s->first_name); ?> <?php echo e($s->second_name); ?></td>
                    <td><?php echo e($s->present_count); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="3" class="muted">No data for selected period.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="muted" style="margin-top: 16px;">Generated on <?php echo e(now()->format('Y-m-d H:i')); ?></div>
</body>
</html>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\student-attendance\report-pdf.blade.php ENDPATH**/ ?>