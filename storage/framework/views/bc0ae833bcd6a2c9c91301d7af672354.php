<?php
    $colors = [
        'excellent' => 'green',
        'good'      => 'blue',
        'fair'      => 'yellow',
        'poor'      => 'orange',
        'damaged'   => 'red',
    ];
    $c = $colors[$condition] ?? 'gray';
?>
<span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-<?php echo e($c); ?>-100 text-<?php echo e($c); ?>-700 capitalize"><?php echo e($condition ?? 'N/A'); ?></span>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\equipment\_condition_badge.blade.php ENDPATH**/ ?>