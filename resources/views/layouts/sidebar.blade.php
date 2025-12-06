<!-- Sidebar Component -->
<div class="relative">


    <!-- Mobile Overlay -->
    <div x-show="$store.layout.mobileOpen"
         @click="$store.layout.mobileOpen = false"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-gray-900 bg-opacity-75 z-40 lg:hidden">
    </div>


    <!-- Sidebar (fixed on the left) -->
    <aside id="app-sidebar" role="navigation" aria-label="Main navigation"
           x-bind:class="[
               // width when expanded / collapsed
               $store.layout.sidebarOpen ? 'w-64' : 'w-20',
               // mobile overlay translate behaviour; keep visible on lg
               $store.layout.mobileOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'
           ].join(' ')
           "
           class="fixed inset-y-0 left-0 h-screen bg-gradient-to-b from-slate-900 via-slate-800 to-slate-900 text-white transition-transform duration-300 ease-in-out z-40 shadow-2xl border-r border-slate-700 overflow-y-auto"
           tabindex="0">


        <!-- Logo Header -->
        <div class="flex items-center justify-between px-4 py-6 border-b border-slate-700">
            <div class="flex items-center space-x-3">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                    <div class="bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg p-2 shadow-lg">
                        <img src="{{ asset('logo.jpeg') }}" alt="logo" class="w-8 h-8">
                    </div>
                    <div x-show="$store.layout.sidebarOpen" class="ml-2">
                        <span class="text-lg font-semibold">DTFA</span>
                    </div>
                </a>
            </div>


            <div class="flex items-center space-x-2">
                <button data-toggle-sidebar @click="$store.layout.sidebarOpen = !$store.layout.sidebarOpen" :aria-expanded="String($store.layout.sidebarOpen)" class="p-2 rounded-md hover:bg-slate-800">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>


        <!-- Navigation -->
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-1 custom-scrollbar" style="max-height: calc(100vh - 160px);">


            @php
                $activeSubscriptions = $activeSubscriptions ?? 0;
                $pendingInvoices = $pendingInvoices ?? 0;
                $pendingExpenses = $pendingExpenses ?? 0;
                $pendingTasksCount = $pendingTasksCount ?? 0;
                $unreadCommsCount = $unreadCommsCount ?? 0;
            @endphp


            {{-- Dashboard --}}
            @if(Route::has('dashboard'))
                <a href="{{ route('dashboard') }}" aria-label="Dashboard" title="Dashboard" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                        <!-- Heroicon: Home -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9.75L12 3l9 6.75V20a1 1 0 01-1 1h-5v-6H9v6H4a1 1 0 01-1-1V9.75z"/></svg>
                    </span>
                    <span class="sr-only">Dashboard</span>
                    <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Dashboard</span>
                </a>
            @endif


            {{-- People --}}
            <div class="pt-4">
                <p x-show="$store.layout.sidebarOpen" class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">People</p>


                {{-- Legacy Students link removed; using Students (Modern) --}}

                @role('super-admin|admin|coach|accountant|CEO')
                    @if(Route::has('students-modern.index'))
                        <a href="{{ route('students-modern.index') }}" aria-label="Students (Modern)" title="Students (Modern)" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('students-modern.*') ? 'active' : '' }}">
                            <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                                <!-- Heroicon: Users -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-4M9 20H4v-2a4 4 0 015-4m0 0a4 4 0 10-4-4 4 4 0 004 4z"/></svg>
                            </span>
                            <span class="sr-only">Students</span>
                            <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Students</span>
                        </a>
                    @endif
                @endrole

                {{-- Legacy Admin Students Management link removed --}}


                @role('super-admin|admin|accountant')
                    @if(Route::has('staff.index'))
                    <a href="{{ route('staff.index') }}" aria-label="Staff Profiles" title="Staff Profiles" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('staff.*') ? 'active' : '' }}">
                            <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                                <!-- Heroicon: User Group -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-4M9 20H4v-2a4 4 0 015-4m3 0a4 4 0 10-4-4 4 4 0 004 4z"/></svg>
                            </span>
                            <span class="sr-only">Staff Profiles</span>
                            <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Staff Profiles</span>
                        </a>
                    @endif


                    @if(Route::has('admin.players.index'))
                        <a href="{{ route('admin.players.index') }}" aria-label="Players" title="Players" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.players.*') ? 'active' : '' }}">
                            <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                                <!-- Heroicon: Users / Players -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-5-4M9 20H4v-2a4 4 0 015-4m3 0a4 4 0 10-4-4 4 4 0 004 4z"/></svg>
                            </span>
                            <span class="sr-only">Players</span>
                            <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Match Players</span>
                        </a>
                    @endif


                    @if(Route::has('admin.users.index'))
                        <a href="{{ route('admin.users.index') }}" aria-label="Users" title="Users" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                                <svg class="w-5 h-5" aria-hidden="true" focusable="false" role="img" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c2.21 0 4-1.79 4-4S14.21 3 12 3 8 4.79 8 7s1.79 4 4 4zM6 21v-2a4 4 0 014-4h4a4 4 0 014 4v2"/></svg>
                            </span>
                            <span class="sr-only">Users</span>
                            <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Users</span>
                        </a>
                    @endif
                    @role('super-admin')
                        @if(Route::has('admin.roles.index'))
                            <a href="{{ route('admin.roles.index') }}" aria-label="Roles & Permissions" title="Roles & Permissions" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.roles.*') ? 'active' : '' }}">
                                <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                                    <!-- Heroicon: Shield Check -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2l7 4v5c0 5-3.58 9.74-7 11-3.42-1.26-7-6-7-11V6l7-4z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
                                </span>
                                <span class="sr-only">Roles & Permissions</span>
                                <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Roles & Permissions</span>
                            </a>
                        @endif
                    @endrole
                @endrole
            </div>


            {{-- Training --}}
            <div class="pt-4">
                <p x-show="$store.layout.sidebarOpen" class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Training</p>


                @if(Route::has('coach.sessions.index'))
                    <a href="{{ route('coach.sessions.index') }}" aria-label="Training Sessions" title="Training Sessions" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('coach.sessions.*') ? 'active' : '' }}">
                        <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                            <!-- Heroicon: Calendar -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </span>
                        <span class="sr-only">Training Sessions</span>
                        <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Training Sessions</span>
                    </a>
                @elseif(Route::has('admin.sessions.index'))
                    <a href="{{ route('admin.sessions.index') }}" aria-label="Training Sessions" title="Training Sessions" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.sessions.*') ? 'active' : '' }}">
                        <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                            <!-- Heroicon: Calendar -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </span>
                        <span class="sr-only">Training Sessions</span>
                        <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Training Sessions</span>
                    </a>
                @endif


                @role('super-admin|accountant|admin|coach')
                    @if(Route::has('admin.trainining_session_records.index'))
                        <a href="{{ route('admin.sessions.index') }}" aria-label="Training Scheduling" title="Training Scheduling" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.sessions.*') ? 'active' : '' }}">
                            <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                                <!-- Heroicon: Pencil/Calendar -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </span>
                            <span class="sr-only">Training Scheduling</span>
                            <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Training Scheduling</span>
                        </a>
                    @elseif(Route::has('coach.sessions.index'))
                        <a href="{{ route('admin.training_session_records.index') }}" aria-label="Training Scheduling" title="Training Scheduling" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('coach.sessions.*') ? 'active' : '' }}">
                            <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                                <!-- Heroicon: Pencil/Calendar -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </span>
                            <span class="sr-only">Training Scheduling</span>
                            <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Training Scheduling</span>
                        </a>
                    @endif


                    @if(Route::has('admin.games.index'))
                        <a href="{{ route('admin.games.index') }}" aria-label="Matches" title="Matches" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.games.*') ? 'active' : '' }}">
                            <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                                <!-- Heroicon: Soccer Ball (simple circle) -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><circle cx="12" cy="12" r="9" stroke-width="2"/><path d="M12 3v6l3 3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </span>
                            <span class="sr-only">Matches</span>
                            <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Matches</span>
                        </a>
                    @endif

                    @if(Route::has('admin.minutes.index'))
                        <a href="{{ route('admin.minutes.index') }}" aria-label="Minutes" title="Minutes" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.minutes.*') ? 'active' : '' }}">
                            <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                                <!-- Heroicon: Document -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </span>
                            <span class="sr-only">Minutes</span>
                            <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Minutes</span>
                        </a>
                    @endif

                    @if(Route::has('admin.upcoming-events.index'))
                        <a href="{{ route('admin.upcoming-events.index') }}" aria-label="Upcoming Events" title="Upcoming Events" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.upcoming-events.*') ? 'active' : '' }}">
                            <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                                <!-- Heroicon: Calendar -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </span>
                            <span class="sr-only">Upcoming Events</span>
                            <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Upcoming Events</span>
                        </a>
                    @endif

                    @if(Route::has('admin.activity-plans.index'))
                        <a href="{{ route('admin.activity-plans.index') }}" aria-label="Activity Plans" title="Activity Plans" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.activity-plans.*') ? 'active' : '' }}">
                            <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                                <!-- Heroicon: Clipboard -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            </span>
                            <span class="sr-only">Activity Plans</span>
                            <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Activity Plans</span>
                        </a>
                    @endif

                    @if(Route::has('admin.sports-equipment.index'))
                        <a href="{{ route('admin.sports-equipment.index') }}" aria-label="Sports Equipment" title="Sports Equipment" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.sports-equipment.*') ? 'active' : '' }}">
                            <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                                <!-- Heroicon: Sports (Dumbbell) -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7a4 4 0 00-4 4v6a4 4 0 004 4h12a4 4 0 004-4v-6a4 4 0 00-4-4M3 11h6M15 11h6M3 17h6M15 17h6"/></svg>
                            </span>
                            <span class="sr-only">Sports Equipment</span>
                            <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Sports Equipment</span>
                        </a>
                    @endif

                    @if(Route::has('admin.office-equipment.index'))
                        <a href="{{ route('admin.office-equipment.index') }}" aria-label="Office Equipment" title="Office Equipment" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.office-equipment.*') ? 'active' : '' }}">
                            <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                                <!-- Heroicon: Briefcase -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m0 0L4 7m8 4v10l8-4v-10m-8 14l-8-4v-10"/></svg>
                            </span>
                            <span class="sr-only">Office Equipment</span>
                            <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Office Equipment</span>
                        </a>
                    @endif

                    {{-- Kit Manager Dashboard --}}
                    @role('kit-manager|admin|super-admin')
                        @if(Route::has('kit-manager.dashboard'))
                            <a href="{{ route('kit-manager.dashboard') }}" aria-label="Kit Manager" title="Kit Manager" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('kit-manager.*') ? 'active' : '' }}">
                                <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                                    <!-- Heroicon: Cube -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8.97-5.7a1 1 0 00-1.06 0L4 7m16 0l-8 4.97m0 0L4 7m16 0v10a1 1 0 01-.94.997L12 22.97m0 0l8-4.97V7M12 22.97L4 18M12 22.97v-4.97"/></svg>
                                </span>
                                <span class="sr-only">Kit Manager</span>
                                <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Kit Manager Dashboard</span>
                            </a>
                        @endif
                    @endrole
                @endrole


                @if(Route::has('coach.attendance.index'))
                    <a href="{{ route('coach.attendance.index') }}" aria-label="Attendance" title="Attendance" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('coach.attendance.*') ? 'active' : '' }}">
                        <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                            <!-- Heroicon: Check Circle -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 22a10 10 0 100-20 10 10 0 000 20z"/></svg>
                        </span>
                        <span class="sr-only">Student Attendances</span>
                        <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Attendance</span>
                    </a>
                @endif


                @role('super-admin|accountant|admin|coach')
                    @if(Route::has('admin.training_session_records.index'))
                        <a href="{{ route('admin.training_session_records.index') }}" aria-label="Training Records" title="Training Records" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.training_session_records.*') ? 'active' : '' }}">
                            <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                                <!-- Heroicon: Document Text -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h10M7 16h6"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/></svg>
                            </span>
                            <span class="sr-only">Training Records</span>
                            <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Training Records</span>
                        </a>
                    @endif
                @endrole


                @role('super-admin|accountant|admin|coach')
                    @if(Route::has('admin.student-attendance.index'))
                        <a href="{{ route('admin.student-attendance.index') }}" aria-label="Student Attendance" title="Student Attendance" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.student-attendance.*') ? 'active' : '' }}">
                            <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                                <!-- Heroicon: User Check -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                            </span>
                            <span class="sr-only">Student Attendance</span>
                            <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Student Attendance</span>
                        </a>
                    @endif
                @endrole

                @role('super-admin|accountant|admin')
                    @if(Route::has('admin.staff_attendances.index'))
                        <a href="{{ route('admin.staff_attendances.index') }}" aria-label="Staff Attendance" title="Staff Attendance" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.staff_attendances.*') ? 'active' : '' }}">
                            <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                                <!-- Heroicon: Clipboard Check -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 2h6a2 2 0 012 2v1H7V4a2 2 0 012-2zM7 8h10v12a2 2 0 01-2 2H9a2 2 0 01-2-2V8z"/></svg>
                            </span>
                            <span class="sr-only">Staff Attendance</span>
                            <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Staff Attendance</span>
                        </a>
                    @endif
                @endrole
                  @role('super-admin|accountant|admin')
                    @if(Route::has('admin.inhousetrainings.index'))
                        <a href="{{ route('admin.inhousetrainings.index') }}" aria-label="Inhouse Training" title="Staff Attendance" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.trainings.*') ? 'active' : '' }}">
                            <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                                <!-- Heroicon: Clipboard Check -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3M3 11h18M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </span>
                            <span class="sr-only">Inhouse Training</span>
                            <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Capacity Building</span>
                        </a>
                    @endif
                @endrole
            </div>


            {{-- Finance --}}
            @role('super-admin|admin|accountant')
            <div class="pt-4">
                <p x-show="$store.layout.sidebarOpen" class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Finance</p>


                @if(Route::has('accountant.subscriptions.index'))
                    <a href="{{ route('accountant.subscriptions.index') }}" aria-label="Subscriptions" title="Subscriptions" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('accountant.subscriptions.*') ? 'active' : '' }}">
                        <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                            <svg class="w-5 h-5" aria-hidden="true" focusable="false" role="img" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
                        </span>
                        <span class="sr-only">Subscriptions</span>
                        <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Subscriptions</span>
                        @if($activeSubscriptions > 0)
                            <span class="ml-auto bg-emerald-500 text-white text-xs rounded-full px-2 py-0.5">{{ $activeSubscriptions }}</span>
                        @endif
                    </a>
                @endif


                @if(Route::has('admin.plans.index'))
                    <a href="{{ route('admin.plans.index') }}" aria-label="Plans" title="Subscription Plans" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.plans.*') ? 'active' : '' }}">
                        <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                            <!-- Heroicon: Template / Clipboard List -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6M9 16h6M7 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </span>
                        <span class="sr-only">Plans</span>
                        <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Plans</span>
                    </a>
                @endif


                    @if(Route::has('accountant.invoices.index'))
                    <a href="{{ route('accountant.invoices.index') }}" aria-label="Invoices" title="Invoices" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('accountant.invoices.*') ? 'active' : '' }}">
                        <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                            <svg class="w-5 h-5" aria-hidden="true" focusable="false" role="img" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6"/></svg>
                        </span>
                        <span class="sr-only">Invoices</span>
                        <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Invoices</span>
                        @if($pendingInvoices > 0)
                            <span class="ml-auto bg-amber-500 text-white text-xs rounded-full px-2 py-0.5">{{ $pendingInvoices }}</span>
                        @endif
                    </a>
                @endif


                    @if(Route::has('accountant.payments.index'))
                    <a href="{{ route('accountant.payments.index') }}" aria-label="Payments" title="Payments" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('accountant.payments.*') ? 'active' : '' }}">
                        <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                            <svg class="w-5 h-5" aria-hidden="true" focusable="false" role="img" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18"/></svg>
                        </span>
                        <span class="sr-only">Payments</span>
                        <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Payments</span>
                    </a>
                @endif


                @if(Route::has('admin.incomes.index'))
                    @php
                        // compute today's incomes total (stored in cents)
                        $todayIncomeCents = 0;
                        try {
                            $todayIncomeCents = \App\Models\Income::whereDate('received_at', \Carbon\Carbon::today())->sum('amount_cents');
                        } catch (\Throwable $e) {
                            $todayIncomeCents = 0;
                        }
                    @endphp


                    <a href="{{ route('admin.incomes.index') }}" aria-label="Incomes" title="Incomes" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.incomes.*') ? 'active' : '' }}">
                        <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                            <!-- Heroicon: Cash -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v2m0 16v2m8-10h-2M6 12H4m15.364 6.364l-1.414-1.414M6.05 6.05L4.636 4.636"/></svg>
                        </span>
                        <span class="sr-only">Incomes</span>
                        <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Incomes</span>
                        @if($todayIncomeCents > 0)
                            <span class="ml-auto bg-emerald-500 text-white text-xs rounded-full px-2 py-0.5">{{ number_format($todayIncomeCents/100, 2) }} RWF</span>
                        @endif
                    </a>
                @endif


                    @if(Route::has('admin.expenses.index'))
                    <a href="{{ route('admin.expenses.index') }}" aria-label="Expenses" title="Expenses" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.expenses.*') ? 'active' : '' }}">
                        <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                            <svg class="w-5 h-5" aria-hidden="true" focusable="false" role="img" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2"/></svg>
                        </span>
                        <span class="sr-only">Expenses</span>
                        <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Expenses</span>
                        @if($pendingExpenses > 0)
                            <span class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-0.5">{{ $pendingExpenses }}</span>
                        @endif
                    </a>
                @endif
            </div>
            @endrole


            {{-- Resources --}}
            <div class="pt-4">
                <p x-show="$store.layout.sidebarOpen" class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Resources</p>


                @if(Route::has('admin.equipment.index'))
                    <a href="{{ route('admin.equipment.index') }}" aria-label="Equipment" title="Equipment" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.equipment.*') ? 'active' : '' }}">
                        <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                            <svg class="w-5 h-5" aria-hidden="true" focusable="false" role="img" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5"/></svg>
                        </span>
                        <span class="sr-only">Equipment</span>
                        <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Equipment</span>
                    </a>
                @endif


                @if(Route::has('admin.branches.index'))
                    <a href="{{ route('admin.branches.index') }}" aria-label="Branches" title="Branches" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.branches.*') ? 'active' : '' }}">
                        <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                            <svg class="w-5 h-5" aria-hidden="true" focusable="false" role="img" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18"/></svg>
                        </span>
                        <span class="sr-only">Branches</span>
                        <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Branches</span>
                    </a>
                @endif

                @if(Route::has('group.index'))
                    <a href="{{ route('admin.groups.index') }}" aria-label="Groups" title="Groups" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('groups.*') ? 'active' : '' }}">
                        <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                            <svg class="w-5 h-5" aria-hidden="true" focusable="false" role="img" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11l3 3L22 4"/></svg>
                        </span>
                        <span class="sr-only">Groups</span>
                        <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Groups</span>
                        @if($totalgroup > 0)
                            <span class="ml-auto bg-amber-500 text-white text-xs rounded-full px-2 py-0.5">{{ $totalgroup }}</span>
                        @endif
                    </a>
                @endif

                @if(Route::has('teams.index'))
                    <a href="{{ route('admin.teams.index') }}" aria-label="Tasks" title="Tasks" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('teams.*') ? 'active' : '' }}">
                        <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                            <svg class="w-5 h-5" aria-hidden="true" focusable="false" role="img" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11l3 3L22 4"/></svg>
                        </span>
                        <span class="sr-only">Teams</span>
                        <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Teams</span>
                        @if($totalteams ??0> 0)
                            <span class="ml-auto bg-amber-500 text-white text-xs rounded-full px-2 py-0.5">{{ $totalteams }}</span>
                        @endif
                    </a>
                @endif

                @if(Route::has('tasks.index'))
                    <a href="{{ route('admin.tasks.index') }}" aria-label="Tasks" title="Tasks" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('tasks.*') ? 'active' : '' }}">
                        <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                            <svg class="w-5 h-5" aria-hidden="true" focusable="false" role="img" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 11l3 3L22 4"/></svg>
                        </span>
                        <span class="sr-only">Tasks</span>
                        <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Tasks</span>
                        @if($pendingTasksCount > 0)
                            <span class="ml-auto bg-amber-500 text-white text-xs rounded-full px-2 py-0.5">{{ $pendingTasksCount }}</span>
                        @endif
                    </a>
                @endif


                @role('super-admin|admin|CEO|Technical Director')
                    @if(Route::has('admin.communications.index'))
                        <a href="{{ route('admin.communications.index') }}" aria-label="Communications" title="Communications" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.communications.*') ? 'active' : '' }}">
                            <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                                <!-- Heroicon: Mail -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </span>
                            <span class="sr-only">Communications</span>
                            <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Communications</span>
                            @if($unreadCommsCount > 0)
                                <span class="ml-auto bg-blue-500 text-white text-xs rounded-full px-2 py-0.5">{{ $unreadCommsCount }}</span>
                            @endif
                        </a>
                    @endif
                @endrole
            </div>


            {{-- Reports --}}
            <div class="pt-4">
                <p x-show="$store.layout.sidebarOpen" class="px-3 text-xs font-semibold text-slate-400 uppercase tracking-wider mb-2">Reports</p>
                @if(Route::has('reports.index'))
                    <a href="{{ route('reports.index') }}" aria-label="Reports" title="Reports" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                            <svg class="w-5 h-5" aria-hidden="true" focusable="false" role="img" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-6a2 2 0 012-2h2"/></svg>
                        </span>
                        <span class="sr-only">Reports</span>
                        <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Reports</span>
                    </a>
                @endif
                @if(Route::has('reports.export.pdf'))
                    <a href="{{ route('reports.export.pdf') }}" aria-label="Export PDF" title="Export PDF" class="submenu-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition">
                        <span class="sr-only">Export PDF</span>
                        <span>Export PDF</span>
                    </a>
                @endif
                @if(Route::has('admin.imports.index'))
                    <a href="{{ route('admin.imports.index') }}" aria-label="Import SQL" title="Import SQL" class="nav-item flex items-center gap-3 px-3 py-2 rounded-md hover:bg-slate-800 transition {{ request()->routeIs('admin.imports.*') ? 'active' : '' }}">
                        <span class="icon flex-shrink-0 w-6 h-6 flex items-center justify-center text-slate-200">
                            <!-- Heroicon: Upload -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v12m0 0l-4-4m4 4l4-4"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21H3"/></svg>
                        </span>
                        <span class="sr-only">Import SQL</span>
                        <span x-show="$store.layout.sidebarOpen" x-transition class="truncate">Import SQL</span>
                    </a>
                @endif
            </div>


        </nav>


        @auth
            <div class="px-3 py-4 border-t border-slate-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <span class="text-sm text-slate-300">Communication</span>
                    </div>
                    @if($unreadCommsCount > 0)
                        <span class="ml-auto bg-blue-500 text-white text-xs rounded-full px-2 py-0.5">{{ $unreadCommsCount }}</span>
                    @endif
                </div>
            </div>
        @endauth


    </aside>
</div>




