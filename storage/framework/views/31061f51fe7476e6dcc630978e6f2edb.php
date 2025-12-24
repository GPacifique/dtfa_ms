<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => null,
    'subtitle' => null,
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
    'title' => null,
    'subtitle' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="footer-like-hero relative overflow-hidden">
    <div class="hero-blob-layer">
        <div class="hero-blob blob-1"></div>
        <div class="hero-blob blob-2"></div>
        <div class="hero-blob blob-3"></div>
    </div>
    <div class="relative z-10 container mx-auto px-6 py-8">
        <?php if($title): ?>
            <h1 class="flex items-center gap-3 text-3xl md:text-4xl font-bold text-white mb-2">
                <img src="<?php echo e(asset('logo.jpeg')); ?>" alt="Logo" width="40" height="40" class="w-9 h-9 md:w-10 md:h-10 rounded-md object-cover shadow-sm ring-2 ring-white/20">
                <span><?php echo e($title); ?></span>
            </h1>
        <?php endif; ?>
        <?php if($subtitle): ?>
            <p class="text-emerald-100"><?php echo e($subtitle); ?></p>
        <?php endif; ?>
        <?php echo e($slot); ?>

    </div>
    
</div>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/components/hero.blade.php ENDPATH**/ ?>