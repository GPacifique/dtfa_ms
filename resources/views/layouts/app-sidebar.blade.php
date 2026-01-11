<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: false }" :class="{ 'dark': darkMode }">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? config('app.name', 'Sport Academy Management') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/jpeg" href="{{ asset('logo.jpeg') }}">
    <link rel="shortcut icon" href="{{ asset('logo.jpeg') }}">
    <link rel="apple-touch-icon" href="{{ asset('logo.jpeg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Tailwind + App JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('head')
</head>
<body class="font-sans antialiased bg-slate-50 dark:bg-slate-900">
<!-- Notification Alert -->
<x-notification-alert />

<div x-data="{}" class="flex h-screen overflow-hidden" @keydown.window.escape="$store.layout.mobileOpen = false">

    {{-- Sidebar --}}
    @include('layouts.sidebar')

    {{-- Main Content Area --}}
    <div class="flex-1 flex flex-col overflow-hidden" x-data="{}">

        {{-- Top Navigation --}}
        <header class="bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 shadow-sm z-10">
            <div class="flex items-center justify-between px-6 py-4">

                {{-- Page Title & Breadcrumbs --}}
                <div class="flex items-center space-x-4">
                    {{-- Mobile Menu Button --}}
                    <button @click="$store.layout.mobileOpen = !$store.layout.mobileOpen"
                            class="lg:hidden text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    {{-- Title & Breadcrumbs --}}
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">
                            {{ $pageTitle ?? 'Dashboard' }}
                        </h1>

                        @if(isset($breadcrumbs))
                        <nav class="flex text-sm text-slate-600 dark:text-slate-400 mt-1" aria-label="Breadcrumb">
                            <ol class="inline-flex items-center space-x-1">
                                @foreach($breadcrumbs as $index => $breadcrumb)
                                    @if($index > 0)
                                        <li>
                                            <svg class="w-4 h-4 mx-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                      d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                      clip-rule="evenodd" />
                                            </svg>
                                        </li>
                                    @endif
                                    <li class="inline-flex items-center">
                                        @if(isset($breadcrumb['url']))
                                            <a href="{{ $breadcrumb['url'] }}"
                                               class="hover:text-slate-900 dark:hover:text-white">
                                                {{ $breadcrumb['label'] }}
                                            </a>
                                        @else
                                            <span class="text-slate-900 dark:text-white font-medium">
                                                {{ $breadcrumb['label'] }}
                                            </span>
                                        @endif
                                    </li>
                                @endforeach
                            </ol>
                        </nav>
                        @endif
                    </div>
                </div>

                {{-- Right Side Actions --}}
                <div class="flex items-center space-x-4">

                    {{-- Search Box --}}
                    <div class="hidden md:block relative">
                        <input type="text" placeholder="Search..."
                               class="w-64 px-4 py-2 pl-10 text-sm border border-slate-300 dark:border-slate-600 rounded-lg
                                      focus:ring-2 focus:ring-blue-500 dark:bg-slate-700 dark:text-white" />
                        <svg class="absolute left-3 top-2.5 w-5 h-5 text-slate-400" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>

                    {{-- Notifications --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                                class="relative p-2 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11
                                         a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341
                                         C7.67 6.165 6 8.388 6 11v3.159
                                         c0 .538-.214 1.055-.595 1.436L4 17h5
                                         m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                        </button>

                        {{-- Notifications Dropdown --}}
                        <div x-show="open" @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute right-0 mt-2 w-80 bg-white dark:bg-slate-800 rounded-lg shadow-xl border border-slate-200 dark:border-slate-700 z-50">
                            <div class="p-4 border-b border-slate-200 dark:border-slate-700">
                                <h3 class="text-sm font-semibold text-slate-900 dark:text-white">Notifications</h3>
                            </div>
                            <div class="max-h-96 overflow-y-auto p-4 text-center text-sm text-slate-500 dark:text-slate-400">
                                No new notifications
                            </div>
                        </div>
                    </div>

                    {{-- Theme Toggle --}}
                    <button @click="darkMode = !darkMode; toggleTheme()" class="p-2 text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition">
                        <template x-if="!darkMode">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                            </svg>
                        </template>
                        <template x-if="darkMode">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 3v1m0 16v1m9-9h-1M4 12H3
                                         m15.364 6.364l-.707-.707
                                         M6.343 6.343l-.707-.707
                                         m12.728 0l-.707.707
                                         M6.343 17.657l-.707.707
                                         M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </template>
                    </button>

                    {{-- User Menu --}}
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 p-2 hover:bg-slate-100 dark:hover:bg-slate-700 rounded-lg transition">
                            <img src="{{ Auth::user()->profile_picture_url }}" alt="{{ Auth::user()->name }}" class="w-8 h-8 rounded-full object-cover">
                            <svg class="w-4 h-4 text-slate-600 dark:text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        {{-- User Dropdown --}}
                        <div x-show="open" @click.away="open = false"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute right-0 mt-2 w-56 bg-white dark:bg-slate-800 rounded-lg shadow-xl border border-slate-200 dark:border-slate-700 z-50">
                            <div class="p-4 border-b border-slate-200 dark:border-slate-700">
                                <p class="text-sm font-medium text-slate-900 dark:text-white">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-slate-500 dark:text-slate-400">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="py-2">
                                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700">
                                    Profile Settings
                                </a>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 dark:text-red-400 hover:bg-slate-100 dark:hover:bg-slate-700">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        {{-- Main Content --}}
        <main class="flex-1 overflow-y-auto bg-slate-50 dark:bg-slate-900">
            <div class="container mx-auto px-6 py-8">

                {{-- Flash Messages --}}
                @if (session('status'))
                    <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg">
                        <p class="text-sm text-green-800 dark:text-green-200">{{ session('status') }}</p>
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                        <p class="text-sm text-red-800 dark:text-red-200">{{ session('error') }}</p>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                        <ul class="list-disc list-inside text-sm text-red-800 dark:text-red-200">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Page Content --}}
                @yield('content')
            </div>
        </main>
    </div>
</div>

@include('partials.inline-scripts')
@stack('scripts')
<script src="{{ asset('js/notification-helper.js') }}"></script>

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
