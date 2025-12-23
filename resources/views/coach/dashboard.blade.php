@php($title = 'Coach Dashboard')
@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">🏆 Coach Dashboard</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-1">Welcome back, {{ Auth::user()->name }}! Manage your teams and track progress.</p>
        </div>
        <a href="/" class="px-4 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 font-semibold transition">← Back</a>
    </div>

    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">Error:</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if (session('success'))
        <div class="bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative mb-6" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
        <a href="{{ route('coach.sessions.index') }}" class="block">
            <x-stat-card title="My Sessions" :value="$allSessions->count()" icon="🎯" color="blue" />
        </a>
        <a href="{{ route('students-modern.index') }}" class="block">
            <x-stat-card title="Active Students" :value="$activeStudents->count()" icon="🎓" color="emerald" />
        </a>
        <a href="{{ route('coach.attendance.index') }}" class="block">
            <x-stat-card title="Attendance Rate" :value="$attendanceRate . '%'" icon="✅" color="fuchsia" />
        </a>
        <a href="{{ route('admin.teams.index') }}" class="block">
            <x-stat-card title="Teams" :value="$teamsCount" icon="⚽" color="amber" />
        </a>
        <a href="{{ route('admin.games.index') }}" class="block">
            <x-stat-card title="Games" :value="$gamesCount" icon="🏟️" color="indigo" />
        </a>
        <a href="{{ route('admin.sports-equipment.index') }}" class="block">
            <x-stat-card title="Equipment" :value="$equipmentCount" icon="🎾" color="cyan" />
        </a>
    </div>

    <!-- Secondary Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('admin.upcoming-events.index') }}" class="block">
            <x-stat-card title="Upcoming Events" :value="$upcomingEventsCount" icon="📅" color="rose" />
        </a>
        <a href="{{ route('admin.activity-plans.index') }}" class="block">
            <x-stat-card title="Activity Plans" :value="$activityPlansCount" icon="📋" color="violet" />
        </a>
        <div class="block">
            <x-stat-card title="Ongoing Plans" :value="$ongoingPlans" icon="🔄" color="orange" />
        </div>
        <div class="block">
            <x-stat-card title="Equipment (Good)" :value="$equipmentGood" icon="✨" color="teal" />
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- Students Table (2 columns wide) -->
        <div class="xl:col-span-2 bg-white dark:bg-slate-800 rounded-xl shadow-md border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span>🎓</span> My Students
                </h2>
                <a href="{{ route('students-modern.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm font-medium">
                    View All →
                </a>
            </div>
            @if($students->isEmpty())
                <div class="p-6 text-center text-slate-500 dark:text-slate-400">
                    <div class="text-4xl mb-2">📭</div>
                    <p>No students assigned to your group yet.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                        <thead class="bg-slate-50 dark:bg-slate-700/50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Student</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Group</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Phone</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Branch</th>
                                <th class="px-4 py-3 text-center text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                            @foreach($students->take(10) as $student)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $student->photo_url }}" alt="{{ $student->first_name }}" class="w-8 h-8 rounded-full object-cover border border-slate-200 dark:border-slate-600">
                                            <div>
                                                <div class="font-semibold text-slate-900 dark:text-white">{{ $student->first_name }} {{ $student->second_name }}</div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">{{ $student->jersey_number ? '#'.$student->jersey_number : '' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 rounded text-xs font-medium">
                                            {{ $student->group->name ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($student->status === 'active')
                                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 text-xs font-bold rounded-full">
                                                ✅ Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2 py-1 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-400 text-xs font-bold rounded-full">
                                                ⏸️ Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3 text-slate-600 dark:text-slate-300 text-sm">{{ $student->player_phone ?? $student->phone ?? '-' }}</td>
                                    <td class="px-4 py-3 text-slate-600 dark:text-slate-300 text-sm">{{ $student->branch->name ?? '-' }}</td>
                                    <td class="px-4 py-3 text-center">
                                        <a href="{{ route('students-modern.show', $student) }}" class="inline-flex items-center px-2 py-1 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded transition">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($students->count() > 10)
                    <div class="px-6 py-3 bg-slate-50 dark:bg-slate-700/50 border-t border-slate-200 dark:border-slate-600 text-center">
                        <span class="text-sm text-slate-500 dark:text-slate-400">Showing 10 of {{ $students->count() }} students</span>
                    </div>
                @endif
            @endif
        </div>

        <!-- Quick Actions & Today's Sessions -->
        <div class="space-y-6">
            <!-- Quick Actions -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md border border-slate-200 dark:border-slate-700 p-6">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <span>⚡</span> Quick Actions
                </h2>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('coach.attendance.index') }}" class="flex flex-col items-center gap-2 p-3 rounded-lg bg-emerald-50 dark:bg-emerald-900/20 hover:bg-emerald-100 dark:hover:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 transition">
                        <span class="text-2xl">📝</span>
                        <span class="text-xs font-semibold text-center">Mark Attendance</span>
                    </a>
                    <a href="{{ route('coach.sessions.create') }}" class="flex flex-col items-center gap-2 p-3 rounded-lg bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30 text-blue-700 dark:text-blue-400 transition">
                        <span class="text-2xl">📅</span>
                        <span class="text-xs font-semibold text-center">New Session</span>
                    </a>
                    <a href="{{ route('students-modern.create') }}" class="flex flex-col items-center gap-2 p-3 rounded-lg bg-fuchsia-50 dark:bg-fuchsia-900/20 hover:bg-fuchsia-100 dark:hover:bg-fuchsia-900/30 text-fuchsia-700 dark:text-fuchsia-400 transition">
                        <span class="text-2xl">➕</span>
                        <span class="text-xs font-semibold text-center">Add Student</span>
                    </a>
                    <a href="{{ route('admin.games.index') }}" class="flex flex-col items-center gap-2 p-3 rounded-lg bg-amber-50 dark:bg-amber-900/20 hover:bg-amber-100 dark:hover:bg-amber-900/30 text-amber-700 dark:text-amber-400 transition">
                        <span class="text-2xl">🏟️</span>
                        <span class="text-xs font-semibold text-center">View Games</span>
                    </a>
                </div>
            </div>

            <!-- Today's Sessions -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md border border-slate-200 dark:border-slate-700">
                <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <span>🎯</span> Today's Sessions
                    </h2>
                </div>
                <div class="p-4">
                    @if(isset($sessionsToday) && $sessionsToday->count())
                        <ul class="space-y-3">
                            @foreach ($sessionsToday as $s)
                                <li class="p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-semibold text-slate-900 dark:text-white">{{ $s->start_time }} - {{ $s->end_time }}</span>
                                        <span class="px-2 py-0.5 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 text-xs rounded">{{ $s->location }}</span>
                                    </div>
                                    <div class="text-sm text-slate-600 dark:text-slate-400 mb-2">
                                        Group: {{ optional($s->group)->name ?? $s->group_name ?? 'All' }}
                                    </div>
                                    <div class="flex gap-2">
                                        <a href="{{ route('coach.sessions.show', $s) }}" class="text-xs px-2 py-1 bg-slate-200 dark:bg-slate-600 text-slate-700 dark:text-slate-300 rounded hover:bg-slate-300 dark:hover:bg-slate-500 transition">View</a>
                                        <a href="{{ route('coach.attendance.show', $s) }}" class="text-xs px-2 py-1 bg-emerald-600 text-white rounded hover:bg-emerald-700 transition">Mark Attendance</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <div class="text-center py-6 text-slate-500 dark:text-slate-400">
                            <div class="text-3xl mb-2">📭</div>
                            <p class="text-sm">No sessions scheduled for today.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Second Row: Attendance & Communications -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Recent Attendance Table -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span>📊</span> Recent Attendance
                </h2>
                <a href="{{ route('coach.attendance.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm font-medium">
                    View All →
                </a>
            </div>
            @if($recentAttendance->isEmpty())
                <div class="p-6 text-center text-slate-500 dark:text-slate-400">
                    <div class="text-4xl mb-2">📋</div>
                    <p>No attendance records yet.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                        <thead class="bg-slate-50 dark:bg-slate-700/50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase">Student</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase">Date</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase">Remarks</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                            @foreach($recentAttendance as $record)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition">
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-slate-900 dark:text-white">
                                            {{ $record->student->first_name ?? 'Unknown' }} {{ $record->student->second_name ?? '' }}
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">
                                        {{ $record->attendance_date ? \Carbon\Carbon::parse($record->attendance_date)->format('M d, Y') : $record->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @php
                                            $statusColors = [
                                                'present' => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400',
                                                'absent' => 'bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400',
                                                'late' => 'bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-400',
                                                'excused' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400',
                                            ];
                                            $statusIcons = [
                                                'present' => '✅',
                                                'absent' => '❌',
                                                'late' => '⏰',
                                                'excused' => 'ℹ️',
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded text-xs font-medium {{ $statusColors[$record->status] ?? 'bg-slate-100 text-slate-700' }}">
                                            {{ $statusIcons[$record->status] ?? '' }} {{ ucfirst($record->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-slate-500 dark:text-slate-400">
                                        {{ Str::limit($record->remarks, 20) ?? '-' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Recent Communications -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span>📨</span> Recent Communications
                </h2>
                <span class="text-xs text-slate-500 dark:text-slate-400">Latest messages</span>
            </div>
            @if($recentCommunications->isEmpty())
                <div class="p-6 text-center text-slate-500 dark:text-slate-400">
                    <div class="text-4xl mb-2">📭</div>
                    <p>No communications yet.</p>
                </div>
            @else
                <div class="divide-y divide-slate-100 dark:divide-slate-700">
                    @foreach($recentCommunications as $comm)
                        <div class="p-4 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition">
                            <div class="flex items-start justify-between mb-2">
                                <h3 class="font-semibold text-slate-900 dark:text-white text-sm">{{ $comm->title }}</h3>
                                <span class="text-xs text-slate-500 dark:text-slate-400">
                                    {{ $comm->sent_at ? \Carbon\Carbon::parse($comm->sent_at)->diffForHumans() : $comm->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-2">{{ Str::limit($comm->body, 80) }}</p>
                            <div class="flex items-center gap-3 text-xs">
                                @if($comm->sender)
                                    <span class="text-slate-500 dark:text-slate-400">
                                        From: <span class="font-medium text-slate-700 dark:text-slate-300">{{ $comm->sender->name }}</span>
                                    </span>
                                @endif
                                @if($comm->audience)
                                    <span class="px-2 py-0.5 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 rounded">
                                        {{ ucfirst($comm->audience) }}
                                    </span>
                                @endif
                                @if($comm->activity_type)
                                    <span class="px-2 py-0.5 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 rounded">
                                        {{ ucfirst($comm->activity_type) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- Third Row: Upcoming Events & Games -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Upcoming Events -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md border border-slate-200 dark:border-slate-700">
            <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span>📅</span> Upcoming Events
                </h2>
                <a href="{{ route('admin.upcoming-events.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm font-medium">
                    View All →
                </a>
            </div>
            <div class="p-4">
                @if($upcomingEvents->isEmpty())
                    <div class="text-center py-6 text-slate-500 dark:text-slate-400">
                        <div class="text-3xl mb-2">📅</div>
                        <p class="text-sm">No upcoming events.</p>
                    </div>
                @else
                    <ul class="space-y-3">
                        @foreach($upcomingEvents as $event)
                            <li class="p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg flex items-center justify-between">
                                <div>
                                    <div class="font-semibold text-slate-900 dark:text-white">{{ $event->event_name }}</div>
                                    <div class="text-sm text-slate-600 dark:text-slate-400">
                                        {{ $event->date ? \Carbon\Carbon::parse($event->date)->format('M d, Y') : 'TBD' }}
                                        @if($event->venue)
                                            • {{ $event->venue }}
                                        @endif
                                    </div>
                                </div>
                                <span class="px-2 py-1 bg-rose-100 dark:bg-rose-900/30 text-rose-700 dark:text-rose-400 text-xs font-medium rounded">
                                    {{ ucfirst($event->status ?? 'upcoming') }}
                                </span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>

        <!-- Upcoming Games -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md border border-slate-200 dark:border-slate-700">
            <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span>🏟️</span> Upcoming Games
                </h2>
                <a href="{{ route('admin.games.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm font-medium">
                    View All →
                </a>
            </div>
            <div class="p-4">
                @if($upcomingGames->isEmpty())
                    <div class="text-center py-6 text-slate-500 dark:text-slate-400">
                        <div class="text-3xl mb-2">⚽</div>
                        <p class="text-sm">No upcoming games scheduled.</p>
                    </div>
                @else
                    <ul class="space-y-3">
                        @foreach($upcomingGames as $game)
                            <li class="p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-semibold text-slate-900 dark:text-white">
                                        {{ $game->home_team ?? 'Home' }} vs {{ $game->away_team ?? 'Away' }}
                                    </span>
                                    <span class="px-2 py-0.5 bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-400 text-xs rounded">
                                        {{ ucfirst($game->status ?? 'scheduled') }}
                                    </span>
                                </div>
                                <div class="text-sm text-slate-600 dark:text-slate-400">
                                    {{ $game->date ? \Carbon\Carbon::parse($game->date)->format('M d, Y') : 'TBD' }}
                                    @if($game->time)
                                        {{ \Carbon\Carbon::parse($game->time)->format('h:i A') }}
                                    @endif
                                    @if($game->venue)
                                        • {{ $game->venue }}
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>

</div>
@endsection
