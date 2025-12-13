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
