<?php
    $colors = [
        'available'   => 'green',
        'in_use'      => 'blue',
        'maintenance' => 'yellow',
        'retired'     => 'gray',
        'lost'        => 'red',
    ];
    $c = $colors[$status] ?? 'gray';
    $labels = [
        'available'   => 'Available',
        'in_use'      => 'In Use',
        'maintenance' => 'Maintenance',
        'retired'     => 'Retired',
        'lost'        => 'Lost',
    ];
?>
<span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-<?php echo e($c); ?>-100 text-<?php echo e($c); ?>-700"><?php echo e($labels[$status] ?? ucfirst($status ?? 'N/A')); ?></span>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\admin\equipment\_status_badge.blade.php ENDPATH**/ ?>