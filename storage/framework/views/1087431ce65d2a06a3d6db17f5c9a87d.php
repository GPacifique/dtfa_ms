<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($title ?? config('app.name', 'App')); ?></title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="<?php echo e(asset('logo.jpeg')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('logo.jpeg')); ?>">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo $__env->yieldPushContent('head'); ?>
</head>
<body class="font-sans antialiased">
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

<div x-data="{}" x-effect="document.body.classList.toggle('overflow-hidden', $store.layout.mobileOpen)" @keydown.window.escape="$store.layout.mobileOpen = false" class="min-h-screen flex">
    <!-- Sidebar (shared partial) -->
    <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Main -->
    <div id="main-content" :class="$store.layout.sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'" class="flex-1 flex flex-col min-w-0 min-h-screen transition-all duration-300 ease-in-out relative z-0">
        <!-- Topbar -->
        <header class="sticky top-0 h-16 flex items-center px-4 sm:px-6 justify-between z-30 blur-card">
            <div class="flex items-center gap-2">
                <!-- Mobile menu button only (desktop uses sidebar edge toggle) -->
                <button data-toggle-sidebar-mobile class="lg:hidden inline-flex items-center justify-center p-2 rounded-md text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-700" @click.prevent="$store.layout.mobileOpen = !$store.layout.mobileOpen; $store.layout.sidebarOpen = true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
                <div class="font-semibold text-slate-700 dark:text-slate-200"><?php echo e($title ?? 'Dashboard'); ?></div>
            </div>
            <div class="flex items-center gap-3">
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage users')): ?><span class="badge badge-slate">manage users</span><?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage finances')): ?><span class="badge badge-slate">manage finances</span><?php endif; ?>

                <!-- Language Switcher -->
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

                    <button type="button" id="theme-toggle" data-theme-toggle class="btn-secondary" title="Toggle theme" onclick="toggleTheme()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                        <path d="M12 3a1 1 0 0 1 1 1v1a1 1 0 1 1-2 0V4a1 1 0 0 1 1-1Zm0 14a5 5 0 1 0 0-10 5 5 0 0 0 0 10Zm8-5a1 1 0 0 1-1 1h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1ZM5 12a1 1 0 0 1-1 1H3a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1Zm11.657 6.657a1 1 0 0 1-1.414 0L14.1 17.514a1 1 0 0 1 1.414-1.415l1.142 1.143a1 1 0 0 1 0 1.415Zm0-13.314a1 1 0 0 1 0 1.414L15.515 7.9A1 1 0 1 1 14.1 6.485l1.143-1.142a1 1 0 0 1 1.414 0ZM6.485 14.1a1 1 0 0 1 0 1.414l-1.142 1.143a1 1 0 0 1-1.415-1.414L5.07 14.1A1 1 0 0 1 6.485 14.1Zm0-7.071L5.343 5.886A1 1 0 1 1 6.757 4.47l1.143 1.143A1 1 0 1 1 6.485 7.03Z"/>
                    </svg>
                </button>
                <?php if(auth()->guard()->check()): ?>
                <?php if (\Illuminate\Support\Facades\Blade::check('role', 'super-admin|admin|CEO|Technical Director')): ?>
                    <a href="<?php echo e(route('admin.communications.create')); ?>" class="btn-secondary mr-2"><?php echo e(__('app.compose')); ?></a>
                <?php endif; ?>

                <!-- User Profile Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 p-1 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" title="User menu">
                        <img
                            src="<?php echo e(Auth::user()->profile_picture_url); ?>"
                            alt="<?php echo e(Auth::user()->name); ?>"
                            class="w-8 h-8 rounded-full object-cover ring-2 ring-slate-200 dark:ring-slate-700"
                        >
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-200 hidden sm:inline"><?php echo e(Auth::user()->name); ?></span>
                    </button>

                    <!-- Dropdown Menu -->
                    <div
                        x-show="open"
                        x-transition
                        @click.away="open = false"
                        class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-800 rounded-lg shadow-lg border border-slate-200 dark:border-slate-700 z-50"
                    >
                        <div class="p-3 border-b border-slate-200 dark:border-slate-700">
                            <div class="flex items-center gap-3">
                                <img
                                    src="<?php echo e(Auth::user()->profile_picture_url); ?>"
                                    alt="<?php echo e(Auth::user()->name); ?>"
                                    class="w-10 h-10 rounded-full object-cover ring-2 ring-slate-200 dark:ring-slate-700"
                                >
                                <div>
                                    <p class="font-semibold text-slate-900 dark:text-white"><?php echo e(Auth::user()->name); ?></p>
                                    <p class="text-xs text-slate-600 dark:text-slate-400"><?php echo e(Auth::user()->email); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="py-2">
                            <a
                                href="<?php echo e(route('user.profile.show', Auth::user())); ?>"
                                @click="open = false"
                                class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700"
                            >
                                👤 <?php echo e(__('app.my_profile')); ?>

                            </a>
                            <?php if(auth()->user()->hasRole(['admin', 'super-admin'])): ?>
                                <a
                                    href="<?php echo e(route('admin.dashboard')); ?>"
                                    @click="open = false"
                                    class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700"
                                >
                                    ⚙️ <?php echo e(__('app.admin_panel')); ?>

                                </a>
                            <?php endif; ?>
                            <a
                                href="<?php echo e(route('user.dashboard')); ?>"
                                @click="open = false"
                                class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700"
                            >
                                📊 <?php echo e(__('app.dashboard')); ?>

                            </a>
                            <div class="border-t border-slate-200 dark:border-slate-700 my-1"></div>
                            <form action="<?php echo e(route('logout')); ?>" method="POST" class="block">
                                <?php echo csrf_field(); ?>
                                <button
                                    type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20"
                                >
                                    🚪 <?php echo e(__('app.logout')); ?>

                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php else: ?>
                <a class="btn-primary" href="<?php echo e(route('login')); ?>"><?php echo e(__('app.login')); ?></a>
                <?php endif; ?>
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 overflow-auto" :aria-hidden="$store.layout.mobileOpen ? 'true' : 'false'">
            <?php if(View::hasSection('hero')): ?>
                <?php echo $__env->yieldContent('hero'); ?>
            <?php endif; ?>

            <?php if (! (View::hasSection('hide-back'))): ?>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                    <?php echo $__env->make('components.back-button', ['fallback' => route('dashboard')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            <?php endif; ?>

            <?php if(session('status')): ?>
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
                    <div data-flash="success" class="hidden"><?php echo e(session('status')); ?></div>
                </div>
            <?php endif; ?>

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>

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
    </div>

    <!-- Mobile menu (handled by sidebar partial) -->
</div>

<?php echo $__env->yieldPushContent('scripts'); ?>
<script src="<?php echo e(asset('js/notification-helper.js')); ?>"></script>
<script src="<?php echo e(asset('js/custom-interactions.js')); ?>"></script>
<!-- Chart.js for dashboards -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js" crossorigin="anonymous"></script>

<!-- Floating WhatsApp Button -->
<a href="https://wa.me/250786163963" target="_blank" rel="noopener noreferrer"
   class="whatsapp-float"
   style="position: fixed !important; bottom: 24px !important; right: 24px !important; z-index: 99999 !important; display: flex !important; align-items: center; justify-content: center; width: 56px; height: 56px; background-color: #25D366 !important; color: white !important; border-radius: 50%; box-shadow: 0 4px 12px rgba(0,0,0,0.3); text-decoration: none;"
   title="Contact System Admin on WhatsApp">
    <svg style="width: 28px; height: 28px;" fill="currentColor" viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
    </svg>
</a>

</body>
</html>
<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/layouts/app.blade.php ENDPATH**/ ?>