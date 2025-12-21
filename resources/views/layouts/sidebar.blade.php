<aside x-cloak :class="$store.layout.sidebarOpen ? 'w-64' : 'w-20'" class="bg-slate-900 text-white transition-all duration-300 ease-in-out flex flex-col h-full border-r border-slate-800 shadow-xl flex-shrink-0" aria-label="Sidebar">
    <!-- Logo / Header -->
    <div class="h-16 flex items-center justify-between px-4 bg-slate-950 border-b border-slate-800">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 group">
            <div class="relative w-8 h-8 flex items-center justify-center bg-emerald-500 rounded-lg shadow-lg group-hover:scale-110 transition-transform duration-200">
                <span class="text-white font-bold text-lg">D</span>
            </div>
            <span x-show="$store.layout.sidebarOpen" x-transition class="font-bold text-lg tracking-tight text-slate-100">DTFA MS</span>
        </a>
        <!-- Mobile Close Button (Visible only on mobile when sidebar is open) -->
        <button @click="$store.layout.sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-4 space-y-1 custom-scrollbar" aria-label="Main Navigation">
        @include('layouts.sidebar-navigation')
    </nav>

    @auth
        <!-- User Profile / Footer -->
        <div class="border-t border-slate-800 bg-slate-950 p-4">
            <div class="flex items-center gap-3">
                <div class="relative">
                    <img class="h-9 w-9 rounded-full object-cover border-2 border-slate-700" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                    <div class="absolute bottom-0 right-0 h-2.5 w-2.5 rounded-full bg-emerald-500 border-2 border-slate-900"></div>
                </div>
                <div x-show="$store.layout.sidebarOpen" x-transition class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-white truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-slate-400 truncate">{{ Auth::user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}" x-show="$store.layout.sidebarOpen">
                    @csrf
                    <button type="submit" class="text-slate-400 hover:text-white transition-colors" title="Log Out">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    @endauth
</aside>




