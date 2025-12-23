@php($title = 'Coach Dashboard')
@extends('layouts.app')

@section('content')

@php
    $statusMap = [
        'present' => ['✅', 'emerald'],
        'absent' => ['❌', 'red'],
        'late' => ['⏰', 'yellow'],
        'excused' => ['ℹ️', 'blue'],
    ];
@endphp

<div class="max-w-7xl mx-auto px-4 py-6 space-y-8">

    <!-- ===== HEADER ===== -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white">
                🏆 Coach Dashboard
            </h1>
            <p class="text-slate-600 dark:text-slate-400 mt-1">
                Welcome back, <span class="font-semibold">{{ Auth::user()->name }}</span>
            </p>
        </div>

        <div class="flex gap-2">
            <a href="{{ route('coach.sessions.create') }}"
               class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700 transition">
                ➕ New Session
            </a>
            <a href="/"
               class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-sm font-semibold hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                ← Back
            </a>
        </div>
    </div>

    <!-- ===== FLASH MESSAGES ===== -->
    @foreach (['success' => 'emerald', 'error' => 'red'] as $key => $color)
        @if(session($key))
            <div class="p-4 rounded-lg bg-{{ $color }}-100 text-{{ $color }}-700 border border-{{ $color }}-300">
                {{ session($key) }}
            </div>
        @endif
    @endforeach

    <!-- ===== STATS ===== -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <x-stat-card title="Students" :value="$activeStudents->count()" icon="🎓" color="emerald"/>
        <x-stat-card title="Attendance" :value="$attendanceRate.'%'" icon="✅" color="fuchsia"/>
        <x-stat-card title="Sessions" :value="$allSessions->count()" icon="🎯" color="blue"/>
        <x-stat-card title="Messages" :value="$recentCommunications->count()" icon="📨" color="indigo"/>
    </div>

    <!-- ===== MAIN GRID ===== -->
    <div class="grid lg:grid-cols-3 gap-6">

        <!-- ===== STUDENTS ===== -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-2xl shadow border border-slate-200 dark:border-slate-700 overflow-hidden">
            <div class="p-5 border-b border-slate-200 dark:border-slate-700 flex justify-between items-center">
                <h2 class="font-bold text-lg text-slate-900 dark:text-white">🎓 My Students</h2>
                <a href="{{ route('students-modern.index') }}" class="text-sm text-indigo-600 hover:underline">
                    View all
                </a>
            </div>

            @if($students->isEmpty())
                <div class="p-10 text-center text-slate-500">
                    <div class="text-5xl mb-3">📭</div>
                    No students assigned yet
                </div>
            @else
                <ul class="divide-y divide-slate-100 dark:divide-slate-700">
                    @foreach($students->take(10) as $student)
                        <li class="p-4 flex items-center justify-between hover:bg-slate-50 dark:hover:bg-slate-700/40 transition">
                            <div class="flex items-center gap-4">
                                <img src="{{ $student->photo_url }}"
                                     class="w-12 h-12 rounded-full object-cover border"
                                     alt="">
                                <div>
                                    <div class="font-semibold text-slate-900 dark:text-white">
                                        {{ $student->first_name }} {{ $student->second_name }}
                                    </div>
                                    <div class="text-xs text-slate-500">
                                        {{ $student->group->name ?? 'No group' }}
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('students-modern.show', $student) }}"
                               class="text-xs px-3 py-1 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                                View
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- ===== TODAY ===== -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow border border-slate-200 dark:border-slate-700">
            <div class="p-5 border-b border-slate-200 dark:border-slate-700">
                <h2 class="font-bold text-lg text-slate-900 dark:text-white">📋 Today</h2>
            </div>

            <div class="p-4 space-y-4">
                @forelse($sessionsToday as $s)
                    <div class="p-4 rounded-xl bg-gradient-to-br from-indigo-50 to-blue-50 dark:from-slate-700 dark:to-slate-700 border">
                        <div class="flex justify-between text-sm font-semibold">
                            <span>{{ $s->start_time }} – {{ $s->end_time }}</span>
                            <span class="text-indigo-600">{{ $s->location }}</span>
                        </div>

                        <div class="text-xs text-slate-600 dark:text-slate-300 mt-2">
                            Group: {{ $s->group->name ?? 'All Groups' }}
                        </div>

                        <div class="flex gap-2 mt-4">
                            <a href="{{ route('coach.sessions.show', $s) }}"
                               class="flex-1 text-center text-xs py-2 border rounded hover:bg-slate-100 dark:hover:bg-slate-600">
                                Details
                            </a>
                            <a href="{{ route('coach.attendance.show', $s) }}"
                               class="flex-1 text-center text-xs py-2 bg-emerald-600 text-white rounded hover:bg-emerald-700">
                                Attendance
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-10 text-slate-500">
                        <div class="text-4xl mb-2">📭</div>
                        No sessions today
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- ===== RECENT ATTENDANCE ===== -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow border border-slate-200 dark:border-slate-700">
        <div class="p-5 border-b flex justify-between">
            <h2 class="font-bold text-lg">📊 Recent Attendance</h2>
            <a href="{{ route('coach.attendance.index') }}" class="text-sm text-indigo-600 hover:underline">
                View all
            </a>
        </div>

        @if($recentAttendance->isEmpty())
            <div class="p-10 text-center text-slate-500">
                No attendance records yet
            </div>
        @else
            <ul class="divide-y">
                @foreach($recentAttendance->take(8) as $r)
                    @php([$icon, $color] = $statusMap[$r->status] ?? ['•','slate'])
                    <li class="p-4 flex justify-between items-center">
                        <div>
                            <div class="font-medium">
                                {{ $r->student->first_name ?? 'Unknown' }}
                            </div>
                            <div class="text-xs text-slate-500">
                                {{ $r->attendance_date ?? $r->created_at->format('M d') }}
                            </div>
                        </div>

                        <span class="px-3 py-1 text-xs rounded-full bg-{{ $color }}-100 text-{{ $color }}-700">
                            {{ $icon }} {{ ucfirst($r->status) }}
                        </span>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

</div>
@endsection
