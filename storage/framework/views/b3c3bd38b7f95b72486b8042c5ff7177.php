<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($title ?? config('app.name', 'App')); ?></title>

    <!-- Favicon -->
    <link rel="icon" href="<?php echo e(asset('logo.jpeg')); ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo $__env->yieldPushContent('head'); ?>

    <!-- Alpine cloak -->
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="font-sans antialiased">

<?php $user = Auth::user(); ?>

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

<div x-data
     x-effect="document.body.classList.toggle('overflow-hidden', $store.layout.mobileOpen)"
     class="min-h-screen flex">

    <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="flex-1 flex flex-col min-h-screen">

        <!-- HEADER -->
        <header class="sticky top-0 h-16 flex items-center justify-between px-4 sm:px-6 z-20 bg-white/80 dark:bg-slate-900/80 backdrop-blur">

            <!-- LEFT -->
            <div class="flex items-center gap-3">
                <button
                    @click="window.innerWidth < 1024
                        ? ($store.layout.mobileOpen = !$store.layout.mobileOpen, $store.layout.sidebarOpen = true)
                        : ($store.layout.sidebarOpen = !$store.layout.sidebarOpen)"
                    class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                    <i class="fa-solid fa-bars"></i>
                </button>

                <span class="font-semibold text-slate-700 dark:text-slate-200">
                    <?php echo e($title ?? 'Dashboard'); ?>

                </span>
            </div>

            <!-- RIGHT -->
            <div class="flex items-center gap-3">

                <?php if (isset($component)) { $__componentOriginal8d3bff7d7383a45350f7495fc470d934 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8d3bff7d7383a45350f7495fc470d934 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.language-switcher','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('language-switcher'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8d3bff7d7383a45350f7495fc470d934)): ?>
<?php $attributes = $__attributesOriginal8d3bff7d7383a45350f7495fc470d934; ?>
<?php unset($__attributesOriginal8d3bff7d7383a45350f7495fc470d934); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8d3bff7d7383a45350f7495fc470d934)): ?>
<?php $component = $__componentOriginal8d3bff7d7383a45350f7495fc470d934; ?>
<?php unset($__componentOriginal8d3bff7d7383a45350f7495fc470d934); ?>
<?php endif; ?>

                <!-- Theme toggle -->
                <button id="theme-toggle"
                        class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">
                    <i class="fa-solid fa-moon dark:hidden"></i>
                    <i class="fa-solid fa-sun hidden dark:block"></i>
                </button>

                <?php if(auth()->guard()->check()): ?>
                <div x-data="{ open: false }" class="relative">

                    <!-- BUTTON -->
                    <button @click="open = !open"
                            class="flex items-center gap-2 p-1 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800">

                        <img
                            src="<?php echo e($user->profile_picture_path 
                                ? asset('storage/' . $user->profile_picture_path) 
                                : 'https://ui-avatars.com/api/?name=' . urlencode($user->name)); ?>"
                            class="w-8 h-8 rounded-full object-cover">

                        <span class="hidden sm:block text-sm font-medium">
                            <?php echo e($user->name); ?>

                        </span>
                    </button>

                    <!-- DROPDOWN -->
                    <div x-show="open"
                         @click.outside="open = false"
                         @keydown.escape.window="open = false"
                         x-transition
                         x-cloak
                         class="absolute right-0 mt-2 w-64 bg-white dark:bg-slate-800 rounded-lg shadow-lg border">

                        <!-- USER INFO -->
                        <div class="p-4 border-b">
                            <div class="flex items-center gap-3">
                                <img
                                    src="<?php echo e($user->profile_picture_path 
                                        ? asset('storage/' . $user->profile_picture_path) 
                                        : 'https://ui-avatars.com/api/?name=' . urlencode($user->name)); ?>"
                                    class="w-10 h-10 rounded-full">

                                <div>
                                    <div class="font-semibold"><?php echo e($user->name); ?></div>
                                    <div class="text-xs text-slate-500"><?php echo e($user->email); ?></div>
                                </div>
                            </div>
                        </div>

                        <!-- LINKS -->
                        <div class="py-2">

                            <a href="<?php echo e(route('user.profile.show', $user)); ?>"
                               class="block px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-700">
                                Profile
                            </a>

                            <?php if(Route::has('profile.edit')): ?>
                            <a href="<?php echo e(route('profile.edit')); ?>"
                               class="block px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-700">
                                Settings
                            </a>
                            <?php endif; ?>

                            <a href="<?php echo e(route('user.dashboard')); ?>"
                               class="block px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-700">
                                Dashboard
                            </a>

                            <?php if($user->hasRole(['admin','super-admin'])): ?>
                            <a href="<?php echo e(route('admin.dashboard')); ?>"
                               class="block px-4 py-2 hover:bg-slate-100 dark:hover:bg-slate-700">
                                Admin Panel
                            </a>
                            <?php endif; ?>

                            <div class="border-t my-2"></div>

                            <form method="POST" action="<?php echo e(route('logout')); ?>">
                                <?php echo csrf_field(); ?>
                                <button class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="btn-primary">Login</a>
                <?php endif; ?>

            </div>
        </header>

        <!-- MAIN -->
        <main class="flex-1 overflow-auto p-6 transition-all duration-300" :style="{ paddingLeft: $store.layout.sidebarOpen ? '16rem' : '5rem' }">
            <?php echo $__env->yieldContent('content'); ?>
        </main>

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
    </div>
</div>

<?php echo $__env->yieldPushContent('scripts'); ?>

<!-- Theme Script -->
<script>
    const toggle = document.getElementById('theme-toggle');
    const html = document.documentElement;

    const saved = localStorage.getItem('theme');
    if (saved === 'dark') html.classList.add('dark');

    toggle.addEventListener('click', () => {
        html.classList.toggle('dark');
        localStorage.setItem('theme', html.classList.contains('dark') ? 'dark' : 'light');
    });
</script>

<!-- WhatsApp Button -->
<a href="https://wa.me/250786163963" target="_blank"
   class="fixed bottom-6 right-6 z-50 w-14 h-14 bg-green-500 text-white rounded-full flex items-center justify-center shadow-lg hover:scale-110 transition">
    <i class="fa-brands fa-whatsapp text-2xl"></i>
</a>

</body>
</html><?php /**PATH C:\Users\USER\Documents\GitHub\dtfa_ms\resources\views/layouts/app.blade.php ENDPATH**/ ?>