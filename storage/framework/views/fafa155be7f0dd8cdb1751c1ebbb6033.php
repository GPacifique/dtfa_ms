<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'color' => 'slate', // slate, green, red, yellow, blue, indigo
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
    'color' => 'slate', // slate, green, red, yellow, blue, indigo
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $map = [
        'slate' => 'badge badge-slate',
        'green' => 'badge badge-green',
        'red' => 'badge badge-red',
        'yellow' => 'badge badge-yellow',
        'blue' => 'badge badge-blue',
        'indigo' => 'badge badge-indigo',
    ];
    $classes = $map[$color] ?? $map['slate'];
?>

<span <?php echo e($attributes->merge(['class' => $classes])); ?>><?php echo e($slot); ?></span>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\components\badge.blade.php ENDPATH**/ ?>