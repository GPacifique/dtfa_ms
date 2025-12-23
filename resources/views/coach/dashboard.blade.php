@php($title = 'Coach Dashboard')
@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900 dark:text-white">🏆 Coach Dashboard</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-1">Welcome back, {{ Auth::user()->name }}! Manage your students and track their progress.</p>
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

    <!-- Key Stats - Focused on Students, Attendance, Sessions, Communications -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <a href="{{ route('students-modern.index') }}" class="block">
            <x-stat-card title="Active Students" :value="$activeStudents->count()" icon="🎓" color="emerald" />
        </a>
        <a href="{{ route('coach.attendance.index') }}" class="block">
            <x-stat-card title="Attendance Rate" :value="$attendanceRate . '%'" icon="✅" color="fuchsia" />
        </a>
        <a href="{{ route('coach.sessions.index') }}" class="block">
            <x-stat-card title="My Sessions" :value="$allSessions->count()" icon="🎯" color="blue" />
        </a>
        <div class="block">
            <x-stat-card title="Communications" :value="$recentCommunications->count()" icon="📨" color="indigo" />
        </div>
    </div>

    <!-- Main Content - Students Focus -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- Students List (2 columns wide) -->
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
                                <th class="px-4 py-3 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Contact</th>
                                <th class="px-4 py-3 text-center text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                            @foreach($students->take(15) as $student)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $student->photo_url }}" alt="{{ $student->first_name }}" class="w-10 h-10 rounded-full object-cover border border-slate-200 dark:border-slate-600">
                                            <div>
                                                <div class="font-semibold text-slate-900 dark:text-white">{{ $student->first_name }} {{ $student->second_name }}</div>
                                                <div class="text-xs text-slate-500 dark:text-slate-400">{{ $student->jersey_number ? '#'.$student->jersey_number : 'No Jersey' }}</div>
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
                                    <td class="px-4 py-3 text-slate-600 dark:text-slate-300 text-sm">
                                        {{ $student->player_phone ?? $student->phone ?? '-' }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <a href="{{ route('students-modern.show', $student) }}" class="inline-flex items-center px-3 py-1 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-medium rounded transition">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if($students->count() > 15)
                    <div class="px-6 py-3 bg-slate-50 dark:bg-slate-700/50 border-t border-slate-200 dark:border-slate-600 text-center">
                        <span class="text-sm text-slate-500 dark:text-slate-400">Showing 15 of {{ $students->count() }} students</span>
                    </div>
                @endif
            @endif
        </div>

        <!-- Today's Tasks (Sessions) -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md border border-slate-200 dark:border-slate-700">
            <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span>📋</span> Today's Tasks
                </h2>
            </div>
            <div class="p-4">
                @if(isset($sessionsToday) && $sessionsToday->count())
                    <ul class="space-y-3">
                        @foreach ($sessionsToday as $s)
                            <li class="p-4 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-slate-700 dark:to-slate-700/50 rounded-lg border border-blue-100 dark:border-slate-600">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-bold text-slate-900 dark:text-white text-sm">{{ $s->start_time }} - {{ $s->end_time }}</span>
                                    <span class="px-2 py-1 bg-blue-600 text-white text-xs rounded font-medium">{{ $s->location }}</span>
                                </div>
                                <div class="text-sm text-slate-700 dark:text-slate-300 mb-3">
                                    <strong>Group:</strong> {{ optional($s->group)->name ?? $s->group_name ?? 'All Groups' }}
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('coach.sessions.show', $s) }}" class="flex-1 text-center text-xs px-3 py-2 bg-white dark:bg-slate-600 text-slate-700 dark:text-slate-200 border border-slate-300 dark:border-slate-500 rounded hover:bg-slate-50 dark:hover:bg-slate-500 transition font-medium">
                                        📄 Details
                                    </a>
                                    <a href="{{ route('coach.attendance.show', $s) }}" class="flex-1 text-center text-xs px-3 py-2 bg-emerald-600 text-white rounded hover:bg-emerald-700 transition font-medium">
                                        ✅ Attendance
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-center py-8 text-slate-500 dark:text-slate-400">
                        <div class="text-4xl mb-3">📭</div>
                        <p class="text-sm font-medium">No sessions scheduled for today.</p>
                        <a href="{{ route('coach.sessions.create') }}" class="inline-block mt-3 text-xs px-3 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            + Schedule Session
                        </a>
                    </div>
                @endif

                @if($upcomingSessions->count() > 0)
                    <div class="mt-4 pt-4 border-t border-slate-200 dark:border-slate-700">
                        <h3 class="text-xs font-bold text-slate-600 dark:text-slate-400 uppercase mb-2">Upcoming Sessions</h3>
                        <ul class="space-y-2">
                            @foreach($upcomingSessions->take(3) as $upcoming)
                                <li class="p-2 bg-slate-50 dark:bg-slate-700/30 rounded text-xs">
                                    <div class="font-semibold text-slate-900 dark:text-white">
                                        {{ \Carbon\Carbon::parse($upcoming->date)->format('M d') }} - {{ $upcoming->start_time }}
                                    </div>
                                    <div class="text-slate-600 dark:text-slate-400">{{ optional($upcoming->group)->name ?? 'All' }}</div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Attendance & Communications Row -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- Recent Attendance -->
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
                <div class="p-8 text-center text-slate-500 dark:text-slate-400">
                    <div class="text-5xl mb-3">📋</div>
                    <p class="font-medium">No attendance records yet.</p>
                    <a href="{{ route('coach.attendance.index') }}" class="inline-block mt-3 text-xs px-4 py-2 bg-emerald-600 text-white rounded hover:bg-emerald-700 transition">
                        + Mark Attendance
                    </a>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                        <thead class="bg-slate-50 dark:bg-slate-700/50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase">Student</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase">Date</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700">
                            @foreach($recentAttendance->take(10) as $record)
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
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/30 transition">
                                    <td class="px-4 py-3">
                                        <div class="flex items-center gap-2">
                                            <div class="font-medium text-slate-900 dark:text-white text-sm">
                                                {{ $record->student->first_name ?? 'Unknown' }} {{ $record->student->second_name ?? '' }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-300">
                                        {{ $record->attendance_date ? \Carbon\Carbon::parse($record->attendance_date)->format('M d') : $record->created_at->format('M d') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        @php
                                            $statusColor = $statusColors[$record->status] ?? 'bg-slate-100 text-slate-700';
                                            $statusIcon = $statusIcons[$record->status] ?? '';
                                        @endphp
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded text-xs font-medium {{ $statusColor }}">
                                            {{ $statusIcon }} {{ ucfirst($record->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <!-- Communications -->
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                    <span>📨</span> Recent Communications
                </h2>
                <span class="text-xs px-2 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 rounded font-medium">
                    {{ $recentCommunications->count() }} New
                </span>
            </div>
            @if($recentCommunications->isEmpty())
                <div class="p-8 text-center text-slate-500 dark:text-slate-400">
                    <div class="text-5xl mb-3">📭</div>
                    <p class="font-medium">No communications yet.</p>
                </div>
            @else
                <div class="divide-y divide-slate-100 dark:divide-slate-700 max-h-96 overflow-y-auto">
                    @foreach($recentCommunications->take(8) as $comm)
                        <div class="p-4 hover:bg-slate-50 dark:hover:bg-slate-700/30 transition">
                            <div class="flex items-start justify-between mb-2">
                                <h3 class="font-semibold text-slate-900 dark:text-white text-sm">{{ $comm->title }}</h3>
                                <span class="text-xs text-slate-500 dark:text-slate-400 whitespace-nowrap ml-2">
                                    {{ $comm->sent_at ? \Carbon\Carbon::parse($comm->sent_at)->diffForHumans() : $comm->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <p class="text-sm text-slate-600 dark:text-slate-400 mb-2 line-clamp-2">{{ Str::limit($comm->body, 100) }}</p>
                            <div class="flex items-center gap-2 text-xs">
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
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

</div>
@endsection
