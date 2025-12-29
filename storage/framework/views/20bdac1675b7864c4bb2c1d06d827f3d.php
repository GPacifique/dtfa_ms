<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Favicon -->
        <link rel="icon" type="image/jpeg" href="<?php echo e(asset('logo.jpeg')); ?>">
        <link rel="apple-touch-icon" href="<?php echo e(asset('logo.jpeg')); ?>">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="font-sans text-gray-900 antialiased flex flex-col min-h-screen">
        <!-- Notification Alert -->
        <?php if (isset($component)) { $__componentOriginal54e03b1d633687f74ed2e6e3646783b5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal54e03b1d633687f74ed2e6e3646783b5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.notification-alert','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('notification-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal54e03b1d633687f74ed2e6e3646783b5)): ?>
<?php $attributes = $__attributesOriginal54e03b1d633687f74ed2e6e3646783b5; ?>
<?php unset($__attributesOriginal54e03b1d633687f74ed2e6e3646783b5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal54e03b1d633687f74ed2e6e3646783b5)): ?>
<?php $component = $__componentOriginal54e03b1d633687f74ed2e6e3646783b5; ?>
<?php unset($__componentOriginal54e03b1d633687f74ed2e6e3646783b5); ?>
<?php endif; ?>
        <div class="flex-1 flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-slate-50 via-blue-50 to-purple-50">
            <div>
                <a href="/">
                    <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => ['class' => 'w-24 h-24 drop-shadow-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-24 h-24 drop-shadow-lg']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $attributes = $__attributesOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $component = $__componentOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__componentOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white/80 backdrop-blur-sm shadow-xl overflow-hidden sm:rounded-2xl border border-slate-200">
                <?php echo e($slot); ?>

            </div>
        </div>

        <!-- Footer -->
        <?php if (isset($component)) { $__componentOriginal868091fdcca1b7cd44d9608210d3c88a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal868091fdcca1b7cd44d9608210d3c88a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal868091fdcca1b7cd44d9608210d3c88a)): ?>
<?php $attributes = $__attributesOriginal868091fdcca1b7cd44d9608210d3c88a; ?>
<?php unset($__attributesOriginal868091fdcca1b7cd44d9608210d3c88a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal868091fdcca1b7cd44d9608210d3c88a)): ?>
<?php $component = $__componentOriginal868091fdcca1b7cd44d9608210d3c88a; ?>
<?php unset($__componentOriginal868091fdcca1b7cd44d9608210d3c88a); ?>
<?php endif; ?>

        <script src="<?php echo e(asset('js/notification-helper.js')); ?>"></script>
    </body>
</html>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/layouts/guest.blade.php ENDPATH**/ ?>