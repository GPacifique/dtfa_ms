@php($title = 'Student Attendance Records')
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">

    {{-- Hero Section --}}
    <div class="footer-like-hero relative overflow-hidden">
        <div class="hero-blob-layer">
            <div class="hero-blob blob-1"></div>
            <div class="hero-blob blob-2"></div>
            <div class="hero-blob blob-3"></div>
        </div>

        <div class="relative z-10 container mx-auto px-6 py-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">📋 Student Attendance Records</h1>
            <p class="text-blue-100">Comprehensive student attendance tracking and management</p>
        </div>
    </div>

    <div class="container mx-auto px-6 -mt-8 pb-12">

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        {{-- Quick Actions --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <a href="{{ route('admin.student-attendance.create') }}" class="card hover:shadow-xl transition-all duration-300">
                <div class="card-body p-4 text-center">
                    <div class="text-3xl mb-2">➕</div>
                    <div class="text-sm font-semibold text-slate-900 dark:text-white">Add Record</div>
                </div>
            </a>
            <a href="{{ route('admin.student-attendance.bulk.create') }}" class="card hover:shadow-xl transition-all duration-300">
                <div class="card-body p-4 text-center">
                    <div class="text-3xl mb-2">📝</div>
                    <div class="text-sm font-semibold text-slate-900 dark:text-white">Bulk Entry</div>
                </div>
            </a>
            <a href="{{ route('admin.student-attendance.report') }}" class="card hover:shadow-xl transition-all duration-300">
                <div class="card-body p-4 text-center">
                    <div class="text-3xl mb-2">📊</div>
                    <div class="text-sm font-semibold text-slate-900 dark:text-white">Reports</div>
                </div>
            </a>
            <a href="{{ route('admin.dashboard') }}" class="card hover:shadow-xl transition-all duration-300">
                <div class="card-body p-4 text-center">
                    <div class="text-3xl mb-2">🏠</div>
                    <div class="text-sm font-semibold text-slate-900 dark:text-white">Dashboard</div>
                </div>
            </a>
        </div>

        {{-- Filters --}}
        <div class="card mb-6">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.student-attendance.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Student</label>
                            <select name="student_id" class="w-full border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white">
                                <option value="">All Students</option>
                                @foreach($students as $student)
                                    <option value="{{ $student->id }}" @selected(request('student_id') == $student->id)>
                                        {{ $student->first_name }} {{ $student->second_name }} {{ $student->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Status</label>
                            <select name="status" class="w-full border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white">
                                <option value="">All Statuses</option>
                                <option value="present" @selected(request('status') == 'present')>Present</option>
                                <option value="absent" @selected(request('status') == 'absent')>Absent</option>
                                <option value="late" @selected(request('status') == 'late')>Late</option>
                                <option value="excused" @selected(request('status') == 'excused')>Excused</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Branch</label>
                            <select name="branch" class="w-full border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white">
                                <option value="">All Branches</option>
                                @foreach($branches as $branch)
                                    <option value="{{ $branch }}" @selected(request('branch') == $branch)>{{ $branch }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Discipline</label>
                            <select name="discipline" class="w-full border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white">
                                <option value="">All Disciplines</option>
                                @foreach($disciplines as $discipline)
                                    <option value="{{ $discipline }}" @selected(request('discipline') == $discipline)>{{ $discipline }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Date From</label>
                            <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Date To</label>
                            <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white">
                        </div>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">
                            🔍 Filter
                        </button>
                        <a href="{{ route('admin.student-attendance.index') }}" class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition font-semibold">
                            Clear
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Attendance Records Table --}}
        <div class="card">
            <div class="card-body">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-slate-700 dark:text-slate-300 uppercase bg-slate-50 dark:bg-neutral-800">
                            <tr>
                                <th class="px-4 py-3">ID</th>
                                <th class="px-4 py-3">Student</th>
                                <th class="px-4 py-3">Session Date</th>
                                <th class="px-4 py-3">Session Time</th>
                                <th class="px-4 py-3">Branch/Group</th>
                                <th class="px-4 py-3">Status</th>
                                <th class="px-4 py-3">Notes</th>
                                <th class="px-4 py-3">Recorded By</th>
                                <th class="px-4 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($attendances as $attendance)
                                <tr class="border-b dark:border-neutral-700 hover:bg-slate-50 dark:hover:bg-neutral-800">
                                    <td class="px-4 py-3">{{ $attendance->id }}</td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('students-modern.show', $attendance->student) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">
                                            {{ $attendance->student->first_name }} {{ $attendance->student->second_name }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-3">{{ optional($attendance->session)->date?->format('M d, Y') ?? 'N/A' }}</td>
                                    <td class="px-4 py-3">
                                        {{ optional($attendance->session)->start_time }} - {{ optional($attendance->session)->end_time }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-xs">
                                            <div>🏢 {{ optional($attendance->session->branch)->name ?? 'N/A' }}</div>
                                            <div>👥 {{ optional($attendance->session->group)->name ?? 'N/A' }}</div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3">
                                        @if($attendance->status == 'present')
                                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs font-bold rounded">✓ Present</span>
                                        @elseif($attendance->status == 'absent')
                                            <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-bold rounded">✗ Absent</span>
                                        @elseif($attendance->status == 'late')
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs font-bold rounded">⏰ Late</span>
                                        @elseif($attendance->status == 'excused')
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-bold rounded">📝 Excused</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3">{{ Str::limit($attendance->notes ?? '', 30) }}</td>
                                    <td class="px-4 py-3 text-xs">{{ optional($attendance->recordedBy)->name ?? 'N/A' }}</td>
                                    <td class="px-4 py-3">
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.student-attendance.show', $attendance) }}" class="text-blue-600 hover:text-blue-800" title="View">
                                                👁️
                                            </a>
                                            <a href="{{ route('admin.student-attendance.edit', $attendance) }}" class="text-indigo-600 hover:text-indigo-800" title="Edit">
                                                ✏️
                                            </a>
                                            <form method="POST" action="{{ route('admin.student-attendance.destroy', $attendance) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this record?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-800" title="Delete">
                                                    🗑️
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="px-4 py-8 text-center text-slate-500">
                                        No attendance records found. <a href="{{ route('admin.student-attendance.create') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">Add one now</a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($attendances->hasPages())
                    <div class="mt-6">
                        {{ $attendances->links() }}
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
@endsection
