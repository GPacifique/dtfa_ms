<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta name="description" content="Modern Sport Academy Management System - Manage members, coaches, schedules, attendance, and billing in one platform.">
        <link rel="canonical" href="<?php echo e(url()->current()); ?>">
        <meta property="og:type" content="website">
        <meta property="og:title" content="<?php echo e(config('app.name', 'Sport Academy MS')); ?> - Modern Academy Management Platform">
        <meta property="og:description" content="Modern Sport Academy Management System - Manage members, coaches, schedules, attendance, and billing in one platform.">
        <meta property="og:image" content="<?php echo e(asset('logo.jpeg')); ?>">
        <meta property="og:url" content="<?php echo e(url()->current()); ?>">
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="<?php echo e(config('app.name', 'Sport Academy MS')); ?> - Modern Academy Management Platform">
        <meta name="twitter:description" content="Modern Sport Academy Management System - Manage members, coaches, schedules, attendance, and billing in one platform.">
        <meta name="twitter:image" content="<?php echo e(asset('logo.jpeg')); ?>">
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "<?php echo e(config('app.name', 'Sport Academy MS')); ?>",
            "url": "<?php echo e(url('/')); ?>",
            "logo": "<?php echo e(asset('logo.jpeg')); ?>"
        }
        </script>
    <meta name="theme-color" content="#ffffff">
    <title><?php echo e(config('app.name', 'Sport Academy MS')); ?> - Modern Academy Management Platform</title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="<?php echo e(asset('logo.jpeg')); ?>">
    <link rel="apple-touch-icon" href="<?php echo e(asset('logo.jpeg')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('logo.jpeg')); ?>">

    <!-- Preconnect to font service for faster load -->
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Vite Assets with Enhanced CSS -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/css/advanced.css', 'resources/js/app.js']); ?>

    <!-- Custom Design System Fallback -->
    <?php if(!app()->environment('production')): ?>
        <link rel="stylesheet" href="<?php echo e(asset('css/custom-design.css')); ?>" media="screen">
    <?php endif; ?>
</head>
<body class="antialiased min-h-screen bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 transition-colors duration-300" data-theme="auto">
    <!-- Skip Navigation Link for Accessibility -->
    <a href="#main-content" class="skip-navigation sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 focus:z-50 focus:bg-blue-600 focus:text-white focus:px-4 focus:py-2 focus:rounded">
        Skip to main content
    </a>

    <!-- Modern Theme Toggle Switch -->
    <div id="theme-toggle" class="theme-toggle-container" title="Toggle theme" data-theme-toggle>
        <input type="checkbox" id="theme-switch" class="theme-switch-input" />
        <label for="theme-switch" class="theme-switch-label">
            <span class="theme-switch-inner">
                <span class="theme-icon sun">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path d="M12 2.25a.75.75 0 01.75.75v2.25a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM7.5 12a4.5 4.5 0 119 0 4.5 4.5 0 01-9 0zM18.894 6.166a.75.75 0 00-1.06-1.06l-1.591 1.59a.75.75 0 101.06 1.061l1.591-1.59zM21.75 12a.75.75 0 01-.75.75h-2.25a.75.75 0 010-1.5H21a.75.75 0 01.75.75zM17.834 18.894a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 10-1.061 1.06l1.59 1.591zM12 18a.75.75 0 01.75.75V21a.75.75 0 01-1.5 0v-2.25A.75.75 0 0112 18zM7.758 17.303a.75.75 0 00-1.061-1.06l-1.591 1.59a.75.75 0 001.06 1.061l1.591-1.59zM6 12a.75.75 0 01-.75.75H3a.75.75 0 010-1.5h2.25A.75.75 0 016 12zM6.697 7.757a.75.75 0 001.06-1.06l-1.59-1.591a.75.75 0 00-1.061 1.06l1.59 1.591z" />
                    </svg>
                </span>
                <span class="theme-icon moon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                        <path fill-rule="evenodd" d="M9.528 1.718a.75.75 0 01.162.819A8.97 8.97 0 009 6a9 9 0 009 9 8.97 8.97 0 003.463-.69.75.75 0 01.981.98 10.503 10.503 0 01-9.694 6.46c-5.799 0-10.5-4.701-10.5-10.5 0-4.368 2.667-8.112 6.46-9.694a.75.75 0 01.818.162z" clip-rule="evenodd" />
                    </svg>
                </span>
            </span>
            <span class="theme-switch-slider"></span>
        </label>
    </div>

    <!-- Navigation Header (Enhanced) -->
    <nav class="navbar sticky top-0 z-30 backdrop-blur-md bg-white/80 dark:bg-gray-900/80 border-b border-gray-200 dark:border-gray-700"
         role="navigation"
         aria-label="Main navigation"
         data-enhanced="true">
        <div class="navbar-container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Logo / Branding (Enhanced) -->
            <div class="logo flex items-center space-x-3 group">
                <div class="relative">
                    <svg viewBox="0 0 100 100"
                         xmlns="http://www.w3.org/2000/svg"
                         class="w-10 h-10 transition-transform duration-300 group-hover:scale-110"
                         aria-hidden="true"
                         focusable="false">
                        <defs>
                            <linearGradient id="trophy-grad" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#2563eb;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#7c3aed;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                        <path d="M30 25 L30 35 Q30 50 40 55 L40 70 L35 70 L35 80 L65 80 L65 70 L60 70 L60 55 Q70 50 70 35 L70 25 Z M25 25 L25 35 Q25 40 30 40 L30 30 L25 30 Z M70 30 L70 40 Q75 40 75 35 L75 25 Z" fill="url(#trophy-grad)"/>
                        <polygon points="45,15 47,22 54,23 49,27 51,34 45,30 39,34 41,27 36,23 43,22" fill="#f59e0b"/>
                    </svg>
                </div>
                <a href="/" class="logo-text text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent" title="Sport Academy MS - Home">
                    Sport Academy MS
                </a>
            </div>

            <!-- Navigation Menu (Enhanced) -->
            <ul class="nav-links flex items-center space-x-6" role="menubar">
                <?php if(Route::has('login')): ?>
                    <?php if(auth()->guard()->check()): ?>
                        <li role="none">
                            <a href="<?php echo e(url('/dashboard')); ?>"
                               class="btn btn-nav px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all duration-200 transform hover:scale-105"
                               role="menuitem">
                                Dashboard
                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if(auth()->guard()->guest()): ?>
                        <li role="none">
                            <a href="<?php echo e(route('login')); ?>"
                               class="text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors duration-200"
                               role="menuitem">
                                Login
                            </a>
                        </li>
                        <?php if(Route::has('register')): ?>
                            <li role="none">
                                <a href="<?php echo e(route('register')); ?>"
                                   class="btn btn-nav px-4 py-2 rounded-lg bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105"
                                   role="menuitem">
                                    Register
                                </a>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <!-- Hero Section (Enhanced) -->
    <main id="main-content">
        <section class="hero relative overflow-hidden bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 py-20 lg:py-32 min-h-[90vh] flex items-center"
                 role="region"
                 aria-label="Hero section with main platform introduction"
                 data-enhanced="true">
            <!-- Animated Background Elements -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="floating-element floating-element-1"></div>
                <div class="floating-element floating-element-2"></div>
                <div class="floating-element floating-element-3"></div>
                <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-blue-500 rounded-full animate-ping"></div>
                <div class="absolute top-3/4 right-1/4 w-3 h-3 bg-purple-500 rounded-full animate-ping" style="animation-delay: 1s;"></div>
                <div class="absolute bottom-1/4 left-1/3 w-2 h-2 bg-emerald-500 rounded-full animate-ping" style="animation-delay: 2s;"></div>
            </div>

            <div class="container relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="hero-content text-center max-w-4xl mx-auto">
                    <h1 class="hero-title text-5xl md:text-6xl lg:text-7xl font-bold mb-6 leading-tight"
                        role="heading"
                        aria-level="1">
                        <span class="inline-flex items-center justify-center gap-4 flex-wrap">
                            <img src="<?php echo e(asset('logo.jpeg')); ?>" alt="Logo" width="56" height="56" class="w-14 h-14 md:w-16 md:h-16 rounded-xl object-cover shadow-lg ring-4 ring-blue-200 dark:ring-blue-800 animate-pulse-glow">
                            <span>
                                <span class="block text-gray-800 dark:text-white">Dream Big.</span>
                                <span class="text-gradient block">
                                    Train Hard. Achieve Greatness.
                                </span>
                            </span>
                        </span>
                    </h1>
                    <p class="hero-subtitle text-xl md:text-2xl text-gray-600 dark:text-gray-300 mb-4 max-w-3xl mx-auto leading-relaxed">
                        🏆 Every champion was once a beginner. Your journey to excellence starts here.
                    </p>
                    <p class="text-lg text-gray-500 dark:text-gray-400 mb-8 max-w-2xl mx-auto italic animate-text-glow">
                        "Success is not final, failure is not fatal: it is the courage to continue that counts."
                    </p>
                    <div class="hero-buttons flex flex-col sm:flex-row gap-4 justify-center items-center">
                        <a href="<?php echo e(route('register')); ?>"
                           class="btn btn-primary btn-lg px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold hover:from-blue-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-2xl group">
                            <span class="flex items-center">
                                🚀 Start Your Journey
                                <svg class="w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                                </svg>
                            </span>
                        </a>
                        <a href="#modules"
                           class="btn btn-secondary btn-lg px-8 py-4 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl font-semibold hover:border-blue-500 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-all duration-300 group">
                            <span class="flex items-center">
                                Discover What's Possible
                                <svg class="w-5 h-5 ml-2 group-hover:translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                                </svg>
                            </span>
                        </a>
                    </div>

                    <!-- Motivational Stats -->
                    <div class="hero-stats mt-16 grid grid-cols-1 sm:grid-cols-3 gap-8 max-w-3xl mx-auto">
                        <div class="stat-card text-center p-6 rounded-2xl bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 transform hover:scale-105 transition-all duration-300">
                            <div class="stat-number text-4xl md:text-5xl mb-2">💪</div>
                            <div class="text-lg font-semibold text-gray-800 dark:text-white">Build Champions</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Train the next generation</div>
                        </div>
                        <div class="stat-card text-center p-6 rounded-2xl bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 transform hover:scale-105 transition-all duration-300">
                            <div class="stat-number text-4xl md:text-5xl mb-2">⭐</div>
                            <div class="text-lg font-semibold text-gray-800 dark:text-white">Excellence Awaits</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Strive for greatness</div>
                        </div>
                        <div class="stat-card text-center p-6 rounded-2xl bg-white/50 dark:bg-gray-800/50 backdrop-blur-sm border border-gray-200/50 dark:border-gray-700/50 transform hover:scale-105 transition-all duration-300">
                            <div class="stat-number text-4xl md:text-5xl mb-2">🎯</div>
                            <div class="text-lg font-semibold text-gray-800 dark:text-white">Achieve Goals</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 mt-1">Reach your potential</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="scroll-indicator text-gray-400 dark:text-gray-500">
                <svg class="w-8 h-8 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
                </svg>
            </div>
        </section>

        <!-- Section Divider -->
        <div class="section-divider my-0"></div>

        <!-- Core Modules Section (Enhanced) -->
        <section id="modules"
                 class="section-light py-20 bg-white dark:bg-gray-900"
                 role="region"
                 aria-label="Core platform modules"
                 data-enhanced="true">
            <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <header class="section-title text-center mb-16" data-fade-in="true">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900 dark:text-white" role="heading" aria-level="2">
                        🛠️ Tools for Champions
                    </h2>
                    <p class="section-subtitle text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        Everything you need to nurture talent, build discipline, and create future stars
                    </p>
                </header>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8" role="list" data-stagger-cards="true">
                    <!-- Students Management -->
                    <article class="module-card group relative overflow-hidden rounded-xl p-6 text-white shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2"
                             role="listitem"
                             style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);"
                             aria-label="Student Management module"
                             data-tilt="true">
                        <div class="absolute inset-0 bg-gradient-to-br from-transparent to-black/20"></div>
                        <div class="relative z-10">
                            <div class="module-icon text-4xl mb-4 transform group-hover:scale-110 transition-transform duration-300" aria-hidden="true">👤</div>
                            <h3 class="module-title text-xl font-bold mb-2" role="heading" aria-level="3">Students Management</h3>
                            <p class="module-desc text-blue-100 mb-4 text-sm">Profiles, roles, memberships, and communication in one place</p>
                            <ul class="module-features space-y-2" aria-label="Features of Student Management">
                                <li class="flex items-center text-sm"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" class="mr-2 text-blue-200" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg> Members & Coaches</li>
                                <li class="flex items-center text-sm"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" class="mr-2 text-blue-200" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg> Branches & Groups</li>
                                <li class="flex items-center text-sm"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" class="mr-2 text-blue-200" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg> Role-based Access</li>
                            </ul>
                        </div>
                    </article>

                    <!-- Scheduling -->
                    <article class="module-card group relative overflow-hidden rounded-xl p-6 text-white shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2"
                             role="listitem"
                             style="background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);"
                             aria-label="Scheduling module"
                             data-tilt="true">
                        <div class="absolute inset-0 bg-gradient-to-br from-transparent to-black/20"></div>
                        <div class="relative z-10">
                            <div class="module-icon text-4xl mb-4 transform group-hover:scale-110 transition-transform duration-300" aria-hidden="true">🗓️</div>
                            <h3 class="module-title text-xl font-bold mb-2" role="heading" aria-level="3">Scheduling</h3>
                            <p class="module-desc text-orange-100 mb-4 text-sm">Plan training sessions, assign coaches, and manage venues</p>
                            <ul class="module-features space-y-2" aria-label="Features of Scheduling">
                                <li class="flex items-center text-sm"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" class="mr-2 text-orange-200" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg> Calendar & Filters</li>
                                <li class="flex items-center text-sm"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" class="mr-2 text-orange-200" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg> Coach Assignment</li>
                                <li class="flex items-center text-sm"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" class="mr-2 text-orange-200" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg> Venue Management</li>
                            </ul>
                        </div>
                    </article>

                    <!-- Attendance -->
                    <article class="module-card group relative overflow-hidden rounded-xl p-6 text-white shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2"
                             role="listitem"
                             style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);"
                             aria-label="Attendance module"
                             data-tilt="true">
                        <div class="absolute inset-0 bg-gradient-to-br from-transparent to-black/20"></div>
                        <div class="relative z-10">
                            <div class="module-icon text-4xl mb-4 transform group-hover:scale-110 transition-transform duration-300" aria-hidden="true">✅</div>
                            <h3 class="module-title text-xl font-bold mb-2" role="heading" aria-level="3">Attendance</h3>
                            <p class="module-desc text-emerald-100 mb-4 text-sm">Track attendance for students and coaches with quick actions</p>
                            <ul class="module-features space-y-2" aria-label="Features of Attendance">
                                <li class="flex items-center text-sm"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" class="mr-2 text-emerald-200" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg> Student Logs</li>
                                <li class="flex items-center text-sm"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" class="mr-2 text-emerald-200" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg> Exportable Reports</li>
                                <li class="flex items-center text-sm"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" class="mr-2 text-emerald-200" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg> Insights</li>
                            </ul>
                        </div>
                    </article>

                    <!-- Payments -->
                    <article class="module-card group relative overflow-hidden rounded-xl p-6 text-white shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2"
                             role="listitem"
                             style="background: linear-gradient(135deg, #7c3aed 0%, #6d28d9 100%);"
                             aria-label="Payments and Billing module"
                             data-tilt="true">
                        <div class="absolute inset-0 bg-gradient-to-br from-transparent to-black/20"></div>
                        <div class="relative z-10">
                            <div class="module-icon text-4xl mb-4 transform group-hover:scale-110 transition-transform duration-300" aria-hidden="true">💳</div>
                            <h3 class="module-title text-xl font-bold mb-2" role="heading" aria-level="3">Payments & Billing</h3>
                            <p class="module-desc text-purple-100 mb-4 text-sm">Subscriptions, invoices, and payment tracking with summaries</p>
                            <ul class="module-features space-y-2" aria-label="Features of Payments and Billing">
                                <li class="flex items-center text-sm"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" class="mr-2 text-purple-200" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg> Subscriptions</li>
                                <li class="flex items-center text-sm"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" class="mr-2 text-purple-200" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg> Invoices</li>
                                <li class="flex items-center text-sm"><svg width="16" height="16" fill="currentColor" viewBox="0 0 20 20" class="mr-2 text-purple-200" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg> Revenue</li>
                            </ul>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- Features Section (Enhanced) -->
        <section id="features"
                 class="section-alt py-20 bg-gray-50 dark:bg-gray-800"
                 role="region"
                 aria-label="Key features and benefits"
                 data-enhanced="true">
            <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <header class="section-title text-center mb-16" data-fade-in="true">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900 dark:text-white" role="heading" aria-level="2">
                        Why Academies Choose Us
                    </h2>
                    <p class="section-subtitle text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        Powerful features designed for real academy operations
                    </p>
                </header>

                <div class="features-grid grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" role="list" data-stagger-cards="true">
                    <article class="feature-item card bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                             role="listitem"
                             aria-label="Role-based access control feature">
                        <div class="feature-icon text-4xl mb-4" aria-hidden="true">🔐</div>
                        <h3 class="feature-title text-xl font-bold mb-2 text-gray-900 dark:text-white" role="heading" aria-level="3">Role-based Access</h3>
                        <p class="feature-desc text-gray-600 dark:text-gray-300">Admin, coach, and member roles with fine-grained permissions</p>
                    </article>

                    <article class="feature-item card bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                             role="listitem"
                             aria-label="Multi-branch support feature">
                        <div class="feature-icon text-4xl mb-4" aria-hidden="true">🏢</div>
                        <h3 class="feature-title text-xl font-bold mb-2 text-gray-900 dark:text-white" role="heading" aria-level="3">Multi-Branch Support</h3>
                        <p class="feature-desc text-gray-600 dark:text-gray-300">Organize your organization by branches and groups/teams</p>
                    </article>

                    <article class="feature-item card bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                             role="listitem"
                             aria-label="Analytics and reports feature">
                        <div class="feature-icon text-4xl mb-4" aria-hidden="true">📊</div>
                        <h3 class="feature-title text-xl font-bold mb-2 text-gray-900 dark:text-white" role="heading" aria-level="3">Analytics & Reports</h3>
                        <p class="feature-desc text-gray-600 dark:text-gray-300">Attendance, revenue, and participation insights at a glance</p>
                    </article>

                    <article class="feature-item card bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                             role="listitem"
                             aria-label="Notifications feature">
                        <div class="feature-icon text-4xl mb-4" aria-hidden="true">🔔</div>
                        <h3 class="feature-title text-xl font-bold mb-2 text-gray-900 dark:text-white" role="heading" aria-level="3">Notifications</h3>
                        <p class="feature-desc text-gray-600 dark:text-gray-300">Keep members informed via email/SMS (provider dependent)</p>
                    </article>

                    <article class="feature-item card bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                             role="listitem"
                             aria-label="Integrations feature">
                        <div class="feature-icon text-4xl mb-4" aria-hidden="true">🔗</div>
                        <h3 class="feature-title text-xl font-bold mb-2 text-gray-900 dark:text-white" role="heading" aria-level="3">Integrations</h3>
                        <p class="feature-desc text-gray-600 dark:text-gray-300">Export data or integrate with gateways and accounting tools</p>
                    </article>

                    <article class="feature-item card bg-white dark:bg-gray-700 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1"
                             role="listitem"
                             aria-label="Billing and invoicing feature">
                        <div class="feature-icon text-4xl mb-4" aria-hidden="true">🧾</div>
                        <h3 class="feature-title text-xl font-bold mb-2 text-gray-900 dark:text-white" role="heading" aria-level="3">Billing & Invoicing</h3>
                        <p class="feature-desc text-gray-600 dark:text-gray-300">Subscriptions, invoices, receipts, and revenue tracking</p>
                    </article>
                </div>
            </div>
        </section>

        <!-- Stats Section (Enhanced) -->
        <section class="section-gradient py-20 bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 relative overflow-hidden"
                 role="region"
                 aria-label="Platform statistics"
                 data-enhanced="true">
            <!-- Animated background -->
            <div class="absolute inset-0 bg-gradient-to-r from-blue-600 via-purple-600 to-blue-600 animate-gradient-x"></div>
            <div class="absolute inset-0 bg-black/10"></div>

            <div class="container relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="stats-grid grid grid-cols-2 md:grid-cols-4 gap-8" role="list" data-count-up-section="true">
                    <article class="stat-item text-center group" role="listitem" aria-label="Active members count">
                        <div class="stat-number text-4xl md:text-5xl font-bold text-white mb-2 transform group-hover:scale-110 transition-transform duration-300"
                             role="doc-subtitle"
                             aria-live="polite"
                             data-count-to="500">0+</div>
                        <div class="stat-label text-blue-100 font-medium">Active Members</div>
                    </article>
                    <article class="stat-item text-center group" role="listitem" aria-label="Coaches count">
                        <div class="stat-number text-4xl md:text-5xl font-bold text-white mb-2 transform group-hover:scale-110 transition-transform duration-300"
                             role="doc-subtitle"
                             aria-live="polite"
                             data-count-to="50">0+</div>
                        <div class="stat-label text-blue-100 font-medium">Coaches</div>
                    </article>
                    <article class="stat-item text-center group" role="listitem" aria-label="Branches count">
                        <div class="stat-number text-4xl md:text-5xl font-bold text-white mb-2 transform group-hover:scale-110 transition-transform duration-300"
                             role="doc-subtitle"
                             aria-live="polite"
                             data-count-to="10">0+</div>
                        <div class="stat-label text-blue-100 font-medium">Branches</div>
                    </article>
                    <article class="stat-item text-center group" role="listitem" aria-label="Years in service">
                        <div class="stat-number text-4xl md:text-5xl font-bold text-white mb-2 transform group-hover:scale-110 transition-transform duration-300"
                             role="doc-subtitle"
                             aria-live="polite"
                             data-count-to="10">0+</div>
                        <div class="stat-label text-blue-100 font-medium">Years Serving</div>
                    </article>
                </div>
            </div>
        </section>

        <!-- CTA Section (Enhanced) -->
        <section class="section-light py-20 bg-white dark:bg-gray-900"
                 role="region"
                 aria-label="Call to action section"
                 data-enhanced="true">
            <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <article class="cta-section text-center max-w-4xl mx-auto">
                    <h2 class="cta-title text-4xl md:text-5xl font-bold mb-6 text-gray-900 dark:text-white"
                        role="heading"
                        aria-level="2">
                        Ready to streamline your academy?
                    </h2>
                    <p class="cta-text text-xl text-gray-600 dark:text-gray-300 mb-8 max-w-2xl mx-auto"
                       role="doc-subtitle">
                        Join organizations already saving time with modern scheduling, attendance, and billing tools
                    </p>
                    <div class="cta-buttons flex flex-col sm:flex-row gap-4 justify-center items-center"
                         role="group"
                         aria-label="Get started options">
                        <a href="<?php echo e(route('register')); ?>"
                           class="btn btn-primary btn-lg px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl font-semibold hover:from-blue-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl"
                           role="button"
                           data-ripple="true">
                            Get Started
                        </a>
                        <a href="<?php echo e(route('login')); ?>"
                           class="btn btn-secondary btn-lg px-8 py-4 border-2 border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 rounded-xl font-semibold hover:border-blue-500 hover:text-blue-600 transition-all duration-300"
                           role="button">
                            Login
                        </a>
                    </div>
                </article>
            </div>
        </section>

        <!-- Footer (Enhanced) -->
        <footer class="bg-gray-900 text-white py-16"
                role="contentinfo"
                aria-label="Site footer"
                data-enhanced="true">
            <div class="container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="footer-content grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                    <section class="footer-section" aria-labelledby="footer-brand">
                        <div class="logo flex items-center space-x-3 mb-4">
                            <svg viewBox="0 0 100 100"
                                 xmlns="http://www.w3.org/2000/svg"
                                 class="w-10 h-10"
                                 aria-hidden="true"
                                 focusable="false">
                                <defs>
                                    <linearGradient id="trophy-grad-footer" x1="0%" y1="0%" x2="100%" y2="100%">
                                        <stop offset="0%" style="stop-color:#2563eb;stop-opacity:1" />
                                        <stop offset="100%" style="stop-color:#7c3aed;stop-opacity:1" />
                                    </linearGradient>
                                </defs>
                                <path d="M30 25 L30 35 Q30 50 40 55 L40 70 L35 70 L35 80 L65 80 L65 70 L60 70 L60 55 Q70 50 70 35 L70 25 Z M25 25 L25 35 Q25 40 30 40 L30 30 L25 30 Z M70 30 L70 40 Q75 40 75 35 L75 25 Z" fill="url(#trophy-grad-footer)"/>
                                <polygon points="45,15 47,22 54,23 49,27 51,34 45,30 39,34 41,27 36,23 43,22" fill="#f59e0b"/>
                            </svg>
                            <span class="logo-text text-xl font-bold" id="footer-brand">Sport Academy MS</span>
                        </div>
                        <p class="text-gray-400 mb-3">Building champions, one training session at a time.</p>
                        <p class="text-sm text-gray-500 italic">"The only way to prove you're a good sport is to lose." — Ernie Banks</p>
                    </section>

                    <nav class="footer-section" aria-label="Quick navigation links">
                        <h3 class="text-lg font-semibold mb-4" role="heading" aria-level="3">Quick Links</h3>
                        <ul class="footer-links space-y-2" role="list">
                            <li role="listitem"><a href="#features" class="text-gray-400 hover:text-white transition-colors duration-200">Features</a></li>
                            <li role="listitem"><a href="<?php echo e(route('register')); ?>" class="text-gray-400 hover:text-white transition-colors duration-200">Register</a></li>
                            <li role="listitem"><a href="<?php echo e(route('login')); ?>" class="text-gray-400 hover:text-white transition-colors duration-200">Login</a></li>
                        </ul>
                    </nav>

                    <section class="footer-section" aria-labelledby="footer-contact">
                        <h3 class="text-lg font-semibold mb-4" role="heading" aria-level="3" id="footer-contact">Contact</h3>
                        <address class="not-italic">
                            <ul class="footer-links space-y-2" role="list">
                                <li role="listitem">
                                    <a href="mailto:info@@sportacademyms.com" class="text-gray-400 hover:text-white transition-colors duration-200 flex items-center">
                                        <span class="mr-2">📧</span> info@@sportacademyms.app.com
                                    </a>
                                </li>
                                <li role="listitem">
                                    <a href="tel:+250786163963" class="text-gray-400 hover:text-white transition-colors duration-200 flex items-center">
                                        <span class="mr-2">📞</span> +250 786 163 963
                                    </a>
                                </li>
                                <li role="listitem" class="text-gray-400 flex items-center">
                                    <span class="mr-2">📍</span> Kigali, Rwanda
                                </li>
                            </ul>
                        </address>
                    </section>
                </div>

                <div class="footer-divider border-t border-gray-800 pt-8 text-center">
                    <p class="text-lg text-gray-300 mb-2">🌟 Your potential is limitless. Start training today!</p>
                    <p class="text-gray-400">&copy; <?php echo e(date('Y')); ?> Sport Academy MS. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </main>

    <!-- Enhanced Custom JavaScript for Welcome Page -->
    <script>
        // Initialize enhanced welcome page functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Check if SportAcademy core is available
            if (window.SportAcademy) {
                console.log('🎉 Sport Academy Enhanced System Loaded');

                // Initialize modules specific to welcome page
                initWelcomeEnhancements();
            } else {
                // Fallback functionality
                console.log('📝 Using fallback welcome page functionality');
                initBasicEnhancements();
            }
        });

        function initWelcomeEnhancements() {
            const core = window.SportAcademy;

            // Enhanced count-up animations for stats
            const statsSection = document.querySelector('[data-count-up-section]');
            if (statsSection) {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            animateCounters();
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.5 });

                observer.observe(statsSection);
            }

            // Smooth scroll for anchor links
            document.querySelectorAll('[data-scroll-to]').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const targetId = link.getAttribute('data-scroll-to');
                    const target = document.getElementById(targetId);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Enhanced hover effects for module cards
            document.querySelectorAll('[data-tilt]').forEach(card => {
                card.addEventListener('mouseenter', () => {
                    card.style.transform = 'translateY(-8px) rotateX(5deg)';
                });

                card.addEventListener('mouseleave', () => {
                    card.style.transform = 'translateY(0) rotateX(0)';
                });
            });

            // Staggered animations for elements
            const staggerElements = document.querySelectorAll('[data-stagger-animation]');
            staggerElements.forEach(container => {
                const children = container.children;
                Array.from(children).forEach((child, index) => {
                    child.style.opacity = '0';
                    child.style.transform = 'translateY(20px)';

                    setTimeout(() => {
                        child.style.transition = 'all 0.6s ease';
                        child.style.opacity = '1';
                        child.style.transform = 'translateY(0)';
                    }, index * 200);
                });
            });

            // Enhanced ripple effects
            document.querySelectorAll('[data-ripple]').forEach(button => {
                button.addEventListener('click', createRipple);
            });
        }

        function initBasicEnhancements() {
            // Basic counter animation
            const counters = document.querySelectorAll('[data-count-to]');
            const observerOptions = {
                threshold: 0.5,
                rootMargin: '0px 0px -50px 0px'
            };

            const counterObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(entry.target);
                        counterObserver.unobserve(entry.target);
                    }
                });
            }, observerOptions);

            counters.forEach(counter => {
                counterObserver.observe(counter);
            });

            // Basic smooth scrolling
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth' });
                    }
                });
            });

            // Basic theme toggle
            const themeToggle = document.getElementById('theme-toggle');
            if (themeToggle) {
                themeToggle.addEventListener('click', toggleTheme);
            }
        }

        function animateCounters() {
            document.querySelectorAll('[data-count-to]').forEach(counter => {
                animateCounter(counter);
            });
        }

        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-count-to'));
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;

            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current) + '+';
            }, 16);
        }

        function createRipple(event) {
            const button = event.currentTarget;
            const circle = document.createElement('span');
            const diameter = Math.max(button.clientWidth, button.clientHeight);
            const radius = diameter / 2;

            const rect = button.getBoundingClientRect();
            circle.style.width = circle.style.height = `${diameter}px`;
            circle.style.left = `${event.clientX - rect.left - radius}px`;
            circle.style.top = `${event.clientY - rect.top - radius}px`;
            circle.classList.add('ripple');

            const rippleStyle = `
                position: absolute;
                border-radius: 50%;
                transform: scale(0);
                animation: ripple-animation 600ms linear;
                background-color: rgba(255, 255, 255, 0.6);
            `;
            circle.style.cssText = rippleStyle;

            const ripple = button.querySelector('.ripple');
            if (ripple) {
                ripple.remove();
            }

            button.appendChild(circle);

            setTimeout(() => {
                circle.remove();
            }, 600);
        }

        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.classList.contains('dark') ? 'dark' : 'light';
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            html.classList.remove('dark', 'light');
            html.classList.add(newTheme);

            // Update modern toggle switch
            const themeSwitch = document.getElementById('theme-switch');
            if (themeSwitch) {
                themeSwitch.checked = newTheme === 'dark';
            }

            // Store preference
            localStorage.setItem('sport-academy-theme', newTheme);

            // Notify system if available
            if (window.SportAcademy) {
                window.SportAcademy.emit('themeChanged', { theme: newTheme });
            }
        }

        // Initialize theme on load
        (function initTheme() {
            const savedTheme = localStorage.getItem('sport-academy-theme');
            const prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
            const theme = savedTheme || (prefersDark ? 'dark' : 'light');

            document.documentElement.classList.add(theme);

            // Update modern toggle switch
            const themeSwitch = document.getElementById('theme-switch');
            if (themeSwitch) {
                themeSwitch.checked = theme === 'dark';
            }
        })();

        // Modern toggle switch handler
        document.addEventListener('DOMContentLoaded', function() {
            const themeSwitch = document.getElementById('theme-switch');
            if (themeSwitch) {
                themeSwitch.addEventListener('change', function() {
                    const html = document.documentElement;
                    const newTheme = this.checked ? 'dark' : 'light';

                    html.classList.remove('dark', 'light');
                    html.classList.add(newTheme);

                    localStorage.setItem('sport-academy-theme', newTheme);

                    if (window.SportAcademy) {
                        window.SportAcademy.emit('themeChanged', { theme: newTheme });
                    }
                });
            }
        });
    </script>

    <!-- Enhanced CSS Animations -->
    <style>
        /* Modern Theme Toggle Switch Styles */
        .theme-toggle-container {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 50;
        }

        .theme-switch-input {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        .theme-switch-label {
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            width: 70px;
            height: 36px;
            background: linear-gradient(135deg, #87CEEB 0%, #E0F7FA 100%);
            border-radius: 100px;
            position: relative;
            padding: 4px;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1), inset 0 2px 4px rgba(255, 255, 255, 0.4);
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .theme-switch-label:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15), inset 0 2px 4px rgba(255, 255, 255, 0.4);
        }

        .theme-switch-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            width: 100%;
            padding: 0 6px;
            z-index: 1;
        }

        .theme-icon {
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .theme-icon.sun {
            color: #FFA500;
            filter: drop-shadow(0 0 3px rgba(255, 165, 0, 0.5));
        }

        .theme-icon.moon {
            color: #6366f1;
            filter: drop-shadow(0 0 3px rgba(99, 102, 241, 0.5));
        }

        .theme-switch-slider {
            position: absolute;
            top: 3px;
            left: 3px;
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
            border-radius: 50%;
            transition: all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2), inset 0 1px 2px rgba(255, 255, 255, 0.8);
        }

        .theme-switch-slider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 18px;
            height: 18px;
            background: radial-gradient(circle, #FFD700 30%, #FFA500 100%);
            border-radius: 50%;
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.6);
            transition: all 0.4s ease;
        }

        /* Dark mode styles */
        .theme-switch-input:checked + .theme-switch-label {
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #1e3a5f 100%);
            border-color: rgba(99, 102, 241, 0.3);
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3), inset 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .theme-switch-input:checked + .theme-switch-label .theme-switch-slider {
            transform: translateX(34px);
            background: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
        }

        .theme-switch-input:checked + .theme-switch-label .theme-switch-slider::before {
            background: radial-gradient(circle, #c7d2fe 30%, #a5b4fc 100%);
            box-shadow: 0 0 15px rgba(199, 210, 254, 0.8), 0 0 30px rgba(165, 180, 252, 0.4);
            width: 16px;
            height: 16px;
        }

        .theme-switch-input:checked + .theme-switch-label .theme-icon.sun {
            opacity: 0.4;
            transform: scale(0.8);
        }

        .theme-switch-input:checked + .theme-switch-label .theme-icon.moon {
            color: #c7d2fe;
            filter: drop-shadow(0 0 5px rgba(199, 210, 254, 0.8));
        }

        .theme-switch-input:not(:checked) + .theme-switch-label .theme-icon.moon {
            opacity: 0.4;
            transform: scale(0.8);
        }

        /* Stars animation for dark mode */
        .theme-switch-input:checked + .theme-switch-label::before,
        .theme-switch-input:checked + .theme-switch-label::after {
            content: '';
            position: absolute;
            width: 3px;
            height: 3px;
            background: white;
            border-radius: 50%;
            animation: twinkle 1.5s infinite;
        }

        .theme-switch-input:checked + .theme-switch-label::before {
            top: 8px;
            left: 12px;
            animation-delay: 0.3s;
        }

        .theme-switch-input:checked + .theme-switch-label::after {
            top: 20px;
            left: 22px;
            animation-delay: 0.7s;
        }

        @keyframes twinkle {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.2); }
        }

        /* Keyframe Animations */
        @keyframes ripple-animation {
            to { transform: scale(4); opacity: 0; }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(2deg); }
        }

        @keyframes float-delayed {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(-2deg); }
        }

        @keyframes gradient-x {
            0%, 100% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
        }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(59, 130, 246, 0.3); }
            50% { box-shadow: 0 0 40px rgba(59, 130, 246, 0.6); }
        }

        @keyframes slide-up {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes slide-in-left {
            from { opacity: 0; transform: translateX(-50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes slide-in-right {
            from { opacity: 0; transform: translateX(50px); }
            to { opacity: 1; transform: translateX(0); }
        }

        @keyframes bounce-in {
            0% { opacity: 0; transform: scale(0.3); }
            50% { transform: scale(1.05); }
            70% { transform: scale(0.9); }
            100% { opacity: 1; transform: scale(1); }
        }

        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        @keyframes rotate-slow {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        @keyframes text-glow {
            0%, 100% { text-shadow: 0 0 10px rgba(59, 130, 246, 0.5); }
            50% { text-shadow: 0 0 20px rgba(124, 58, 237, 0.8), 0 0 30px rgba(59, 130, 246, 0.6); }
        }

        /* Animation Classes */
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-float-delayed { animation: float-delayed 8s ease-in-out infinite; }
        .animate-gradient-x { background-size: 200% 200%; animation: gradient-x 3s ease infinite; }
        .animate-pulse-glow { animation: pulse-glow 2s ease-in-out infinite; }
        .animate-slide-up { animation: slide-up 0.8s ease-out forwards; }
        .animate-bounce-in { animation: bounce-in 0.8s ease-out forwards; }
        .animate-shimmer { background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent); background-size: 200% 100%; animation: shimmer 2s infinite; }
        .animate-text-glow { animation: text-glow 3s ease-in-out infinite; }

        /* Staggered Animations */
        .stagger-1 { animation-delay: 0.1s; }
        .stagger-2 { animation-delay: 0.2s; }
        .stagger-3 { animation-delay: 0.3s; }
        .stagger-4 { animation-delay: 0.4s; }
        .stagger-5 { animation-delay: 0.5s; }

        /* Hero Enhancements */
        .hero-title {
            animation: slide-up 1s ease-out forwards;
        }

        .hero-subtitle {
            opacity: 0;
            animation: slide-up 1s ease-out 0.3s forwards;
        }

        .hero-buttons {
            opacity: 0;
            animation: slide-up 1s ease-out 0.6s forwards;
        }

        .hero-stats {
            opacity: 0;
            animation: slide-up 1s ease-out 0.9s forwards;
        }

        /* Card Hover Effects */
        .module-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .module-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }

        .module-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .module-card:hover::before {
            opacity: 1;
        }

        /* Button Effects */
        .btn-primary {
            position: relative;
            overflow: hidden;
            z-index: 1;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s ease;
            z-index: -1;
        }

        .btn-primary:hover::before {
            left: 100%;
        }

        /* Glassmorphism Effects */
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .dark .glass-card {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        /* Navbar Enhancement */
        .navbar {
            transition: all 0.3s ease;
        }

        .navbar.scrolled {
            background: rgba(255, 255, 255, 0.95) !important;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .dark .navbar.scrolled {
            background: rgba(17, 24, 39, 0.95) !important;
        }

        /* Logo Animation */
        .logo svg {
            transition: transform 0.3s ease;
        }

        .logo:hover svg {
            transform: rotate(-10deg) scale(1.1);
        }

        /* Stats Counter Animation */
        .stat-number {
            display: inline-block;
            transition: transform 0.3s ease;
        }

        .stat-number:hover {
            transform: scale(1.2);
        }

        /* Floating Elements */
        .floating-element {
            position: absolute;
            border-radius: 50%;
            opacity: 0.1;
            pointer-events: none;
        }

        .floating-element-1 {
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            top: -100px;
            right: -100px;
            animation: float 8s ease-in-out infinite;
        }

        .floating-element-2 {
            width: 200px;
            height: 200px;
            background: linear-gradient(135deg, #10b981, #3b82f6);
            bottom: -50px;
            left: -50px;
            animation: float-delayed 10s ease-in-out infinite;
        }

        .floating-element-3 {
            width: 150px;
            height: 150px;
            background: linear-gradient(135deg, #f59e0b, #ef4444);
            top: 50%;
            right: 10%;
            animation: float 12s ease-in-out infinite reverse;
        }

        /* Scroll Indicator */
        .scroll-indicator {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            animation: bounce 2s infinite;
        }

        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
            40% { transform: translateX(-50%) translateY(-15px); }
            60% { transform: translateX(-50%) translateY(-7px); }
        }

        /* Section Divider */
        .section-divider {
            height: 4px;
            background: linear-gradient(90deg, transparent, #3b82f6, #8b5cf6, transparent);
            margin: 0 auto;
            max-width: 200px;
            border-radius: 2px;
        }

        /* Text Gradient */
        .text-gradient {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 50%, #3b82f6 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            animation: gradient-x 3s ease infinite;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: linear-gradient(180deg, #3b82f6, #8b5cf6); border-radius: 5px; }
        ::-webkit-scrollbar-thumb:hover { background: linear-gradient(180deg, #2563eb, #7c3aed); }
        .dark ::-webkit-scrollbar-track { background: #1f2937; }

        /* Parallax Effect */
        .parallax-bg {
            transform: translateZ(0);
            will-change: transform;
        }

        /* Focus States */
        a:focus, button:focus {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }

        /* Loading State */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 1.5s infinite;
        }

        /* Intersection Observer Animation Triggers */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s ease;
        }

        .reveal.active {
            opacity: 1;
            transform: translateY(0);
        }

        /* Skip Navigation */
        .skip-navigation {
            position: absolute;
            left: -10000px;
            top: auto;
            width: 1px;
            height: 1px;
            overflow: hidden;
        }

        .skip-navigation:focus {
            position: static;
            width: auto;
            height: auto;
        }
    </style>

    <!-- Enhanced JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Navbar scroll effect
            const navbar = document.querySelector('.navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
            });

            // Intersection Observer for reveal animations
            const revealElements = document.querySelectorAll('.reveal, .module-card, [data-fade-in]');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add('active');
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                    }
                });
            }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });

            revealElements.forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'all 0.6s ease';
                observer.observe(el);
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });
            });

            // Parallax effect on mouse move
            const hero = document.querySelector('.hero');
            if (hero) {
                hero.addEventListener('mousemove', (e) => {
                    const floatingElements = hero.querySelectorAll('.floating-element, .animate-float, .animate-float-delayed');
                    const x = (e.clientX / window.innerWidth - 0.5) * 20;
                    const y = (e.clientY / window.innerHeight - 0.5) * 20;
                    floatingElements.forEach((el, i) => {
                        const speed = (i + 1) * 0.5;
                        el.style.transform = `translate(${x * speed}px, ${y * speed}px)`;
                    });
                });
            }

            // Button ripple effect
            document.querySelectorAll('.btn-primary, .btn-secondary').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    ripple.style.cssText = `
                        position: absolute;
                        background: rgba(255,255,255,0.3);
                        border-radius: 50%;
                        width: 100px;
                        height: 100px;
                        left: ${e.clientX - rect.left - 50}px;
                        top: ${e.clientY - rect.top - 50}px;
                        transform: scale(0);
                        animation: ripple-animation 0.6s ease-out;
                        pointer-events: none;
                    `;
                    this.style.position = 'relative';
                    this.style.overflow = 'hidden';
                    this.appendChild(ripple);
                    setTimeout(() => ripple.remove(), 600);
                });
            });

            // Counter animation for stats
            const animateCounter = (el, target) => {
                let current = 0;
                const increment = target / 50;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        el.textContent = target.toLocaleString();
                        clearInterval(timer);
                    } else {
                        el.textContent = Math.floor(current).toLocaleString();
                    }
                }, 30);
            };

            // Typing effect for hero subtitle
            const typeText = (element, text, speed = 50) => {
                let i = 0;
                element.textContent = '';
                const type = () => {
                    if (i < text.length) {
                        element.textContent += text.charAt(i);
                        i++;
                        setTimeout(type, speed);
                    }
                };
                type();
            };

            console.log('🎉 Sport Academy - Welcome Page Enhanced!');
        });
    </script>

    <!-- Custom Interactions JS (Legacy Fallback) -->
    <?php if(!app()->environment('production')): ?>
        <script src="<?php echo e(asset('js/custom-interactions.js')); ?>"></script>
    <?php endif; ?>
</body>
</html>

<?php /**PATH C:\Users\USER\Desktop\projects\htdocs\GitHub\dtfa_ms\resources\views/welcome.blade.php ENDPATH**/ ?>