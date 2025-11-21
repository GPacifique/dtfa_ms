<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'App') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    {{-- Vite: Tailwind CSS + Custom Styles --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="font-sans antialiased">
<div x-data="{}" class="min-h-screen flex">
    <!-- Sidebar (shared partial) -->
    @include('layouts.sidebar')

    <!-- Main -->
    <div id="main-content" :class="$store.layout.sidebarOpen ? 'lg:ml-64 ml-0' : 'lg:ml-20 ml-0'" class="flex-1 flex flex-col min-w-0 transition-all duration-200 relative z-0">
        <!-- Topbar -->
        <header class="sticky top-0 h-16 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 flex items-center px-4 sm:px-6 justify-between z-20">
            <div class="flex items-center gap-2">
                <button data-toggle-sidebar-mobile class="md:hidden inline-flex items-center justify-center p-2 rounded-md text-slate-500 hover:bg-slate-100" @click.prevent="$store.layout.mobileOpen = !$store.layout.mobileOpen; $store.layout.sidebarOpen = true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" /></svg>
                </button>
                <!-- Desktop toggle: visible on md+ -->
                <button data-toggle-sidebar class="hidden md:inline-flex items-center justify-center p-2 rounded-md text-slate-500 hover:bg-slate-100" @click.prevent="$store.layout.sidebarOpen = !$store.layout.sidebarOpen" title="Toggle sidebar">
                    <svg x-show="$store.layout.sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 4a1 1 0 00-1 1v10a1 1 0 001 1h8a1 1 0 001-1V5a1 1 0 00-1-1H6zm2 3a1 1 0 012 0v6a1 1 0 11-2 0V7zm4 0a1 1 0 012 0v6a1 1 0 11-2 0V7z" clip-rule="evenodd" />
                    </svg>
                    <svg x-show="!$store.layout.sidebarOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M4 5h12v2H4V5zm0 4h12v2H4V9zm0 4h12v2H4v-2z" />
                    </svg>
                </button>
                <div class="font-semibold text-slate-700 dark:text-slate-200">{{ $title ?? 'Dashboard' }}</div>
            </div>
            <div class="flex items-center gap-3">
                @can('manage users')<span class="badge badge-slate">manage users</span>@endcan
                @can('manage finances')<span class="badge badge-slate">manage finances</span>@endcan
                <button type="button" class="btn-secondary" title="Toggle theme" onclick="toggleTheme()">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-5 w-5">
                        <path d="M12 3a1 1 0 0 1 1 1v1a1 1 0 1 1-2 0V4a1 1 0 0 1 1-1Zm0 14a5 5 0 1 0 0-10 5 5 0 0 0 0 10Zm8-5a1 1 0 0 1-1 1h-1a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1ZM5 12a1 1 0 0 1-1 1H3a1 1 0 1 1 0-2h1a1 1 0 0 1 1 1Zm11.657 6.657a1 1 0 0 1-1.414 0L14.1 17.514a1 1 0 0 1 1.414-1.415l1.142 1.143a1 1 0 0 1 0 1.415Zm0-13.314a1 1 0 0 1 0 1.414L15.515 7.9A1 1 0 1 1 14.1 6.485l1.143-1.142a1 1 0 0 1 1.414 0ZM6.485 14.1a1 1 0 0 1 0 1.414l-1.142 1.143a1 1 0 0 1-1.415-1.414L5.07 14.1A1 1 0 0 1 6.485 14.1Zm0-7.071L5.343 5.886A1 1 0 1 1 6.757 4.47l1.143 1.143A1 1 0 1 1 6.485 7.03Z"/>
                    </svg>
                </button>
                @auth
                <div class="mr-4 text-sm text-slate-700 dark:text-slate-200">
                    Hello, <span class="font-semibold">{{ Auth::user()->name }}</span>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="btn-primary">Logout</button>
                </form>
                @else
                <a class="btn-primary" href="{{ route('login') }}">Login</a>
                @endauth
            </div>
        </header>

        <!-- Content -->
        <main class="flex-1">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <!-- Ensure content sits below sticky header and has consistent gutters -->
                <div class="pt-2">
                    @if (session('status'))
                        <div data-flash="success" class="hidden">{{ session('status') }}</div>
                    @endif

                    @yield('content')
                </div>
            </div>
        </main>

        <!-- Footer -->
        <x-app-footer />
    </div>

    <!-- Mobile menu (handled by sidebar partial) -->
</div>

@stack('scripts')
<script src="{{ asset('js/custom-interactions.js') }}"></script>
</body>
</html>
