@php($title = 'Coach Dashboard')
@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Coach Dashboard</h1>
            <p class="text-slate-600 mt-1">Manage teams and track training progress</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-stat-card title="My Sessions" :value="$allSessions->count()" icon="🎯" color="blue" />
            <x-stat-card title="Active Students" :value="$activeStudents->count()" icon="🎓" color="emerald" />
            <x-stat-card title="Attendance Rate" :value="$attendanceRate . '%'" icon="✅" color="fuchsia" />
        </div>
        <div class="bg-white rounded-lg shadow-md border border-slate-200 p-6 mt-8">
            <h2 class="text-lg font-semibold text-slate-900 mb-4">My Students</h2>
            @if($students->isEmpty())
                <div class="text-sm text-slate-600">No students assigned to your group yet.</div>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-4 py-2 text-left text-xs font-bold text-slate-700 uppercase">Name</th>
                                <th class="px-4 py-2 text-left text-xs font-bold text-slate-700 uppercase">Group</th>
                                <th class="px-4 py-2 text-left text-xs font-bold text-slate-700 uppercase">Status</th>
                                <th class="px-4 py-2 text-left text-xs font-bold text-slate-700 uppercase">Phone</th>
                                <th class="px-4 py-2 text-left text-xs font-bold text-slate-700 uppercase">Parent</th>
                                <th class="px-4 py-2 text-left text-xs font-bold text-slate-700 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($students as $student)
                                <tr>
                                    <td class="px-4 py-2 font-medium text-slate-900">{{ $student->first_name }} {{ $student->second_name }}</td>
                                    <td class="px-4 py-2">{{ $student->group->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-2">
                                        @if($student->status === 'active')
                                            <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-full">✓ Active</span>
                                        @else
                                            <span class="inline-block px-3 py-1 bg-slate-100 text-slate-800 text-xs font-bold rounded-full">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-2">{{ $student->phone }}</td>
                                    <td class="px-4 py-2">{{ $student->parent->name ?? '' }}</td>
                                    <td class="px-4 py-2">
                                        <a href="{{ route('coach.students.show', $student) }}" class="text-indigo-600 hover:underline text-sm">Profile</a>
                                        <a href="{{ route('coach.students.attendance', $student) }}" class="ml-2 text-blue-600 hover:underline text-sm">Attendance</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-lg shadow-md border border-slate-200 p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Today’s Sessions</h2>
                @if(isset($sessionsToday) && $sessionsToday->count())
                    <ul class="divide-y divide-slate-200">
                        @foreach ($sessionsToday as $s)
                            <li class="py-2 flex items-center justify-between">
                                <div>
                                    <div class="font-medium text-slate-900">{{ $s->start_time }}–{{ $s->end_time }} • {{ $s->location }}</div>
                                    <div class="text-sm text-slate-600">Group: {{ optional($s->group)->name ?? $s->group_name }}</div>
                                </div>
                                <a class="text-indigo-600 text-sm hover:underline" href="{{ route('coach.attendance.show', $s) }}">Mark</a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <div class="text-sm text-slate-600">No sessions scheduled for today.</div>
                @endif
            </div>

            <div class="bg-white rounded-lg shadow-md border border-slate-200 p-6">
                <h2 class="text-lg font-semibold text-slate-900 mb-4">Quick Actions</h2>
                <div class="space-y-2">
                    <a href="{{ route('coach.students.index') }}" class="flex items-center gap-2 px-4 py-2 rounded-md bg-slate-100 hover:bg-slate-200 text-slate-900 transition">
                        <span>🎓</span><span>My Students</span>
                    </a>
                    <a href="{{ route('coach.attendance.index') }}" class="flex items-center gap-2 px-4 py-2 rounded-md bg-slate-100 hover:bg-slate-200 text-slate-900 transition">
                        <span>📝</span><span>Mark Attendance</span>
                    </a>
                    <a href="{{ route('coach.sessions.create') }}" class="flex items-center gap-2 px-4 py-2 rounded-md bg-slate-100 hover:bg-slate-200 text-slate-900 transition">
                        <span>📅</span><span>Schedule Session</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection