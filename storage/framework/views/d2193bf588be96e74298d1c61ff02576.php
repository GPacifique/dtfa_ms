<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'type' => 'info', // success, error, warning, info
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'type' => 'info', // success, error, warning, info
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $base = 'rounded-md p-3 text-sm';
    $map = [
        'success' => 'bg-green-50 text-green-800 dark:bg-green-900/30 dark:text-green-200',
        'error' => 'bg-red-50 text-red-800 dark:bg-red-900/30 dark:text-red-200',
        'warning' => 'bg-yellow-50 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-200',
        'info' => 'bg-slate-50 text-slate-800 dark:bg-slate-800/60 dark:text-slate-200',
    ];
    $classes = $base.' '.($map[$type] ?? $map['info']);
?>

<div <?php echo e($attributes->merge(['class' => $classes])); ?>>
    <?php echo e($slot); ?>

    
    
    <?php if(isset($close)): ?>
        <div class="float-right"><?php echo e($close); ?></div>
    <?php endif; ?>
  </div>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/components/alert.blade.php ENDPATH**/ ?>