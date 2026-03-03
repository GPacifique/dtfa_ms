<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['title', 'value', 'icon' => null, 'trend' => null, 'color' => 'slate']));

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

foreach (array_filter((['title', 'value', 'icon' => null, 'trend' => null, 'color' => 'slate']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
$colors = [
    'slate' => 'from-slate-500 to-slate-600',
    'blue' => 'from-blue-500 to-blue-600',
    'emerald' => 'from-emerald-500 to-emerald-600',
    'amber' => 'from-amber-500 to-amber-600',
    'fuchsia' => 'from-fuchsia-500 to-fuchsia-600',
];
$bgClass = $colors[$color] ?? $colors['slate'];
?>

<div class="bg-white rounded-lg shadow-md border border-slate-200 p-6 hover:shadow-lg transition-shadow">
    <div class="flex justify-between items-start">
        <div class="flex-1">
            <div class="text-sm font-semibold text-slate-600 mb-1"><?php echo e($title); ?></div>
            <div class="text-3xl font-bold text-slate-900"><?php echo e($value); ?></div>
            <?php if($trend): ?>
                <div class="mt-2 text-xs font-medium text-slate-600"><?php echo e($trend); ?></div>
            <?php endif; ?>
        </div>
        <?php if($icon): ?>
        <div class="ml-4">
            <div class="w-12 h-12 rounded-lg bg-gradient-to-br <?php echo e($bgClass); ?> flex items-center justify-center text-white text-xl shadow-md">
                <?php echo e($icon); ?>

            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views\components\stat-card.blade.php ENDPATH**/ ?>