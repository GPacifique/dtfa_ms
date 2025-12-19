@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto mt-10 bg-white dark:bg-neutral-900 p-8 rounded shadow space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-3xl font-bold text-indigo-700 dark:text-indigo-300 flex items-center gap-2"> User Dashboard</h1>
            <div class="flex items-center gap-2">
                <a href="{{ route('user.profile.show', Auth::user()) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">👤 My Profile</a>
                <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded">⚙️ Edit Profile</a>
            </div>
        </div>

        {{-- Limited Access Notification Banner --}}
        <div class="relative overflow-hidden bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/20 dark:to-orange-900/20 border border-amber-300 dark:border-amber-700 rounded-xl p-6 shadow-sm">
            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-amber-200 dark:bg-amber-800/30 rounded-full opacity-50"></div>
            <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-16 h-16 bg-orange-200 dark:bg-orange-800/30 rounded-full opacity-50"></div>

            <div class="relative flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="w-14 h-14 bg-amber-100 dark:bg-amber-800/50 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-amber-800 dark:text-amber-300 mb-1">
                        ⏳ Limited System Access
                    </h3>
                    <p class="text-amber-700 dark:text-amber-400 text-sm leading-relaxed mb-3">
                        Your account is currently pending approval. You have limited access to the system features.
                        Once a <strong>System Administrator</strong> reviews and approves your account, you will gain full access to all available modules.
                    </p>
                    <div class="flex flex-wrap items-center gap-3">
                        <div class="flex items-center gap-2 text-xs text-amber-600 dark:text-amber-500 bg-amber-100 dark:bg-amber-900/40 px-3 py-1.5 rounded-full">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <span>Awaiting Admin Approval</span>
                        </div>
                        <div class="flex items-center gap-2 text-xs text-amber-600 dark:text-amber-500 bg-amber-100 dark:bg-amber-900/40 px-3 py-1.5 rounded-full">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            <span>Role: Basic User</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="relative mt-4 pt-4 border-t border-amber-200 dark:border-amber-700/50">
                <p class="text-xs text-amber-600 dark:text-amber-500">
                    💡 <strong>Tip:</strong> Please ensure your profile information is complete and accurate. This helps administrators verify your account faster.
                    If you have any questions, please contact the system administrator.
                </p>
            </div>
        </div>

        <div class="text-slate-700 dark:text-slate-200 text-lg">
            Welcome, <span class="font-semibold">{{ Auth::user()->name ?? 'User' }}</span>! This is your personalized dashboard.
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="#" class="block p-6 bg-indigo-50 dark:bg-neutral-800 rounded-lg shadow hover:shadow-lg transition border border-indigo-100 dark:border-neutral-700">
                <div class="text-2xl mb-2"></div>
                <div class="font-bold text-lg mb-1">View Students</div>
                <div class="text-slate-600 dark:text-slate-400 text-sm">Browse, add, or edit student records.</div>
            </a>

            <div class="p-6 bg-white dark:bg-neutral-800 rounded-lg shadow border border-slate-200 dark:border-neutral-700">
                <h3 class="font-semibold mb-2">Quick Stats</h3>
                <div class="grid grid-cols-1 gap-3">
                    <x-stat-row label="My Attendance" :value="($myAttendanceRate ?? 0) . '%'" />
                    <x-stat-row label="Upcoming Sessions" :value="$upcomingSessionsCount ?? 0" />
                    <x-stat-row label="Recent Notices" :value="($recentCommunications->count() ?? 0)" />
                </div>
            </div>

            <a href="{{ route('profile.edit') }}" class="block p-6 bg-blue-50 dark:bg-neutral-800 rounded-lg shadow hover:shadow-lg transition border border-blue-100 dark:border-neutral-700">
                <div class="text-2xl mb-2"></div>
                <div class="font-bold text-lg mb-1">Edit Profile</div>
                <div class="text-slate-600 dark:text-slate-400 text-sm">Update your account information and password.</div>
            </a>
        </div>

        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-md border border-slate-200 dark:border-neutral-700 p-6">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-gray-100 mb-4">Upcoming Training Sessions</h2>
            @if(($upcomingSessions ?? collect())->isEmpty())
                <div class="text-sm text-slate-600 dark:text-slate-300">No upcoming sessions scheduled.</div>
            @else
                <ul class="space-y-2">
                    @foreach($upcomingSessions as $s)
                        <li class="p-3 bg-slate-50 dark:bg-neutral-900 rounded border border-slate-200 dark:border-neutral-700">
                            <div class="font-medium text-slate-900 dark:text-white">{{ $s->date->format('M d, Y') }} • {{ $s->start_time }}–{{ $s->end_time }}</div>
                            <div class="text-xs text-slate-600 dark:text-slate-300 mt-1">{{ optional($s->branch)->name ?? '—' }} • {{ optional($s->group)->name ?? '—' }}</div>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        @if(($recentCommunications ?? collect())->isNotEmpty())
        <div class="bg-white dark:bg-neutral-800 rounded-lg shadow-md border border-slate-200 dark:border-neutral-700 p-6">
            <h2 class="text-lg font-semibold text-slate-900 dark:text-gray-100 mb-4">Recent Communications</h2>
            <ul class="space-y-2">
                @foreach($recentCommunications as $c)
                    <li class="flex items-center justify-between p-3 bg-slate-50 dark:bg-neutral-900 rounded border border-slate-200 dark:border-neutral-700">
                        <span class="font-medium text-slate-800 dark:text-slate-200">{{ $c->title }}</span>
                        <span class="text-xs text-slate-500">{{ $c->created_at?->format('M d, Y') }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
@endsection
