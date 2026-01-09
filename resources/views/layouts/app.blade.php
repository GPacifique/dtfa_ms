<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'App') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('logo.jpeg') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.jpeg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Vite: Tailwind CSS + Custom Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="font-sans antialiased">
<!-- Notification Alert -->
<x-notification-alert />

<div x-data="{}" x-effect="document.body.classList.toggle('overflow-hidden', $store.layout.mobileOpen)" @keydown.window.escape="$store.layout.mobileOpen = false" class="min-h-screen flex">
    <!-- Sidebar (shared partial) -->
    @include('layouts.sidebar')

    <!-- Main -->
    <div id="main-content" :class="$store.layout.sidebarOpen ? 'lg:ml-64' : 'lg:ml-20'" class="flex-1 flex flex-col min-w-0 min-h-screen transition-all duration-300 ease-in-out relative z-0">
        <!-- Topbar -->
        <header class="sticky top-0 h-16 flex items-center px-4 sm:px-6 justify-between z-30 blur-card">
            <div class="flex items-center gap-2">
                <!-- Mobile menu button only (desktop uses sidebar edge toggle) -->
                <button data-toggle-sidebar-mobile class="lg:hidden inline-flex items-center justify-center p-2 rounded-md text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-700" @click.prevent="$store.layout.mobileOpen = !$store.layout.mobileOpen; $store.layout.sidebarOpen = true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
                <div class="font-semibold text-slate-700 dark:text-slate-200">{{ $title ?? 'Dashboard' }}</div>
            </div>
            <div class="flex items-center gap-3">
                @can('manage users')<span class="badge badge-slate">manage users</span>@endcan
                @can('manage finances')<span class="badge badge-slate">manage finances</span>@endcan

                <!-- Language Switcher -->
                <x-language-switcher />

                    <button type="button" id="theme-toggle" data-theme-toggle class="btn-secondary" title="Toggle theme" onclick="toggleTheme()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                        <path d="M12 3a1 1 0 0 1 1 1v1a1 1 0 1 1-2 0V4a1 1 0 0 1 1-1Zm0 14a5 5 0 1 0 0-10 5 5 0 0 0 0 10Zm8-5a1 1 0 0 1-1 1h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1ZM5 12a1 1 0 0 1-1 1H3a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1Zm11.657 6.657a1 1 0 0 1-1.414 0L14.1 17.514a1 1 0 0 1 1.414-1.415l1.142 1.143a1 1 0 0 1 0 1.415Zm0-13.314a1 1 0 0 1 0 1.414L15.515 7.9A1 1 0 1 1 14.1 6.485l1.143-1.142a1 1 0 0 1 1.414 0ZM6.485 14.1a1 1 0 0 1 0 1.414l-1.142 1.143a1 1 0 0 1-1.415-1.414L5.07 14.1A1 1 0 0 1 6.485 14.1Zm0-7.071L5.343 5.886A1 1 0 1 1 6.757 4.47l1.143 1.143A1 1 0 1 1 6.485 7.03Z"/>
                    </svg>
                </button>
                @auth
                @role('super-admin|admin|CEO|Technical Director')
                    <a href="{{ route('admin.communications.create') }}" class="btn-secondary mr-2">Compose</a>
                @endrole

                <!-- User Profile Dropdown -->
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" @click.away="open = false" class="flex items-center gap-2 p-1 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors" title="User menu">
                        <img
                            src="{{ Auth::user()->profile_picture_url }}"
                            alt="{{ Auth::user()->name }}"
                            class="w-8 h-8 rounded-full object-cover ring-2 ring-slate-200 dark:ring-slate-700"
                        >
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-200 hidden sm:inline">{{ Auth::user()->name }}</span>
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
                                    src="{{ Auth::user()->profile_picture_url }}"
                                    alt="{{ Auth::user()->name }}"
                                    class="w-10 h-10 rounded-full object-cover ring-2 ring-slate-200 dark:ring-slate-700"
                                >
                                <div>
                                    <p class="font-semibold text-slate-900 dark:text-white">{{ Auth::user()->name }}</p>
                                    <p class="text-xs text-slate-600 dark:text-slate-400">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="py-2">
                            <a
                                href="{{ route('user.profile.show', Auth::user()) }}"
                                @click="open = false"
                                class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700"
                            >
                                👤 My Profile
                            </a>
                            @if(auth()->user()->hasRole(['admin', 'super-admin']))
                                <a
                                    href="{{ route('admin.dashboard') }}"
                                    @click="open = false"
                                    class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700"
                                >
                                    ⚙️ Admin Panel
                                </a>
                            @endif
                            <a
                                href="{{ route('user.dashboard') }}"
                                @click="open = false"
                                class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-slate-700"
                            >
                                📊 Dashboard
                            </a>
                            <div class="border-t border-slate-200 dark:border-slate-700 my-1"></div>
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button
                                    type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/20"
                                >
                                    🚪 Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <a class="btn-primary" href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1 overflow-auto" :aria-hidden="$store.layout.mobileOpen ? 'true' : 'false'">
            @if (View::hasSection('hero'))
                @yield('hero')
            @endif

            @unless(View::hasSection('hide-back'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6">
                    @include('components.back-button', ['fallback' => route('dashboard')])
                </div>
            @endunless

            @if (session('status'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2">
                    <div data-flash="success" class="hidden">{{ session('status') }}</div>
                </div>
            @endif

            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                @yield('content')
            </div>
        </main>

        <!-- Footer -->
        <x-app-footer />
    </div>

    <!-- Mobile menu (handled by sidebar partial) -->
</div>

@stack('scripts')
<script src="{{ asset('js/notification-helper.js') }}"></script>
<script src="{{ asset('js/custom-interactions.js') }}"></script>
<!-- Chart.js for dashboards -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js" crossorigin="anonymous"></script>
</body>
</html>
