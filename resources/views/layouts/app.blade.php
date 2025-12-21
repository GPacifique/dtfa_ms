<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-slate-50 dark:bg-slate-900">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @php
        $pageTitle = View::hasSection('meta_title')
            ? trim($__env->yieldContent('meta_title'))
            : (config('app.name', 'App') . ' — ' . ($title ?? ($heroTitle ?? 'Dashboard')));

        $pageDescription = View::hasSection('meta_description')
            ? trim($__env->yieldContent('meta_description'))
            : 'Manage academy operations: schedules, attendance, payments, and reports.';

        $appName = config('app.name', 'App');
        $logoUrl = asset('logo.jpeg');
    @endphp

    <title>{{ $pageTitle }}</title>

    <link rel="canonical" href="{{ url()->current() }}">
    <meta name="description" content="{{ $pageDescription }}">

    @if (request()->is('admin*') || request()->is('user*'))
        <meta name="robots" content="noindex, nofollow">
    @else
        <meta name="robots" content="index, follow">
    @endif

    <link rel="icon" type="image/jpeg" href="{{ $logoUrl }}">
    <link rel="apple-touch-icon" href="{{ $logoUrl }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:image" content="{{ $logoUrl }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:image" content="{{ $logoUrl }}">
    <meta name="twitter:site" content="{{ $appName }}">

    <script type="application/ld+json">
    {
        "@@context": "https://schema.org",
        "@@type": "Organization",
        "name": "{{ $appName }}",
        "url": "{{ url('/') }}",
        "logo": "{{ $logoUrl }}"
    }
    </script>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <style>
        [x-cloak] { display: none !important; }
        /* Custom Scrollbar for Sidebar and Content */
        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: rgba(156, 163, 175, 0.5);
            border-radius: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: rgba(107, 114, 128, 0.8);
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
    @stack('meta')
</head>
<body class="h-full font-sans antialiased text-slate-900 dark:text-slate-100 overflow-hidden">
    <x-notification-alert />

    <div x-data="{}" class="h-full flex flex-col">
        <!-- Top System Bar (Header) -->
        <header class="h-14 bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between px-4 z-40 shrink-0">
            <div class="flex items-center gap-4">
                <!-- Mobile Menu Toggle -->
                <button @click="$store.layout.mobileOpen = !$store.layout.mobileOpen" class="lg:hidden p-2 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>

                <!-- Logo -->
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 font-bold text-lg tracking-tight text-slate-800 dark:text-white">
                    <img src="{{ $logoUrl }}" alt="Logo" class="w-8 h-8 rounded object-cover">
                    <span class="hidden sm:inline">{{ $appName }}</span>
                </a>

                <!-- Breadcrumbs / Page Title -->
                <div class="hidden md:flex items-center text-sm text-slate-500 dark:text-slate-400 border-l border-slate-200 dark:border-slate-700 pl-4 ml-2">
                    <span class="font-medium text-slate-900 dark:text-slate-200">{{ $title ?? 'Dashboard' }}</span>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <!-- System Status Indicators (Mock) -->
                <div class="hidden lg:flex items-center gap-2 text-xs text-slate-500 mr-4">
                    <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-green-500"></span> System Online</span>
                    <span class="flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-blue-500"></span> v1.2.0</span>
                </div>

                <!-- Theme Toggle -->
                <button onclick="toggleTheme()" class="p-2 text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-full transition-colors" title="Toggle Theme">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                </button>

                @auth
                    <!-- User Menu -->
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-full p-1 pr-3 transition-colors">
                            <img src="{{ Auth::user()->profile_picture_url }}" alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-full object-cover ring-2 ring-slate-200 dark:ring-slate-700">
                            <span class="text-sm font-medium hidden sm:block">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </button>

                        <div x-show="open" x-transition class="absolute right-0 mt-2 w-56 bg-white dark:bg-slate-800 rounded-lg shadow-xl border border-slate-200 dark:border-slate-700 py-1 z-50" style="display: none;">
                            <div class="px-4 py-3 border-b border-slate-100 dark:border-slate-700">
                                <p class="text-sm font-medium text-slate-900 dark:text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-500 truncate">{{ Auth::user()->email }}</p>
                            </div>
                            <a href="{{ route('user.profile.show', Auth::user()) }}" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">Profile</a>
                            @if(auth()->user()->hasRole(['admin', 'super-admin']))
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-700">Admin Panel</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20">Sign out</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-blue-600 hover:text-blue-500">Sign in</a>
                @endauth
            </div>
        </header>

        <!-- Main Layout Body -->
        <div class="flex-1 flex overflow-hidden">
            <!-- Sidebar -->
            <aside
                x-cloak
                :class="$store.layout.sidebarOpen ? 'w-64' : 'w-20'"
                class="hidden lg:flex flex-col bg-slate-900 text-slate-300 transition-all duration-300 ease-in-out border-r border-slate-800 shrink-0"
            >
                <div class="flex-1 overflow-y-auto py-4 custom-scrollbar">
                    @include('layouts.sidebar')
                </div>
                <!-- Sidebar Footer (Collapse Toggle) -->
                <div class="p-4 border-t border-slate-800">
                    <button @click="$store.layout.sidebarOpen = !$store.layout.sidebarOpen" class="w-full flex items-center justify-center p-2 rounded-md hover:bg-slate-800 transition-colors text-slate-400 hover:text-white">
                        <svg :class="$store.layout.sidebarOpen ? 'rotate-180' : ''" class="w-5 h-5 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7"></path></svg>
                    </button>
                </div>
            </aside>

            <!-- Mobile Sidebar Overlay -->
            <div x-show="$store.layout.mobileOpen" class="fixed inset-0 z-50 lg:hidden" style="display: none;">
                <div @click="$store.layout.mobileOpen = false" x-show="$store.layout.mobileOpen" x-transition.opacity class="absolute inset-0 bg-slate-900/50 backdrop-blur-sm"></div>
                <div x-show="$store.layout.mobileOpen" x-transition:enter="transform transition ease-in-out duration-300" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transform transition ease-in-out duration-300" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="relative w-80 max-w-[85%] h-full bg-slate-900 shadow-2xl flex flex-col">
                    <div class="flex items-center justify-between p-4 border-b border-slate-800">
                        <span class="text-lg font-bold text-white">Menu</span>
                        <button @click="$store.layout.mobileOpen = false" class="text-slate-400 hover:text-white"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg></button>
                    </div>
                    <div class="flex-1 overflow-y-auto py-4">
                        @include('layouts.sidebar')
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="flex-1 flex flex-col min-w-0 bg-slate-50 dark:bg-slate-900 overflow-hidden relative">
                <!-- Scrollable Content Area -->
                <div class="flex-1 overflow-y-auto custom-scrollbar p-4 sm:p-6 lg:p-8 scroll-smooth">
                    @if (session('status'))
                        <div class="mb-6 rounded-md bg-green-50 p-4 border border-green-200">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">{{ session('status') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @yield('content')
                </div>

                <!-- System Footer -->
                <footer class="bg-white dark:bg-slate-800 border-t border-slate-200 dark:border-slate-700 py-2 px-6 text-xs text-slate-500 flex justify-between items-center shrink-0 z-10">
                    <div>
                        &copy; {{ date('Y') }} {{ $appName }}. All rights reserved.
                    </div>
                    <div class="flex gap-4">
                        <span>Server Time: {{ now()->format('H:i:s') }}</span>
                        <span>Memory: {{ round(memory_get_usage() / 1024 / 1024, 2) }}MB</span>
                    </div>
                </footer>
            </main>
        </div>
    </div>

    @stack('scripts')
    <script src="{{ asset('js/notification-helper.js') }}" defer></script>
    <script src="{{ asset('js/custom-interactions.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js" crossorigin="anonymous" defer></script>
</body>
</html>
