@extends('layouts.app')
@section('title', 'Attendance Record Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 py-12">
    <div class="container mx-auto px-6 max-w-4xl">

        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold text-slate-900 dark:text-white">👁️ Attendance Record Details</h1>
                    <a href="{{ route('admin.student-attendance.index') }}" class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition font-semibold">
                        ← Back to List
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Student Info --}}
                    <div class="bg-slate-50 dark:bg-neutral-800 rounded-lg p-6">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4">🎓 Student Information</h2>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-slate-600 dark:text-slate-400 uppercase font-semibold">Name</p>
                                <p class="text-slate-900 dark:text-white font-semibold">
                                    <a href="{{ route('students-modern.show', $studentAttendance->student) }}" class="text-indigo-600 hover:text-indigo-800">
                                        {{ $studentAttendance->student->first_name }} {{ $studentAttendance->student->second_name }}
                                    </a>
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-600 dark:text-slate-400 uppercase font-semibold">Branch</p>
                                <p class="text-slate-900 dark:text-white">{{ optional($studentAttendance->student->branch)->name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-600 dark:text-slate-400 uppercase font-semibold">Group</p>
                                <p class="text-slate-900 dark:text-white">{{ optional($studentAttendance->student->group)->name ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Session Info --}}
                    <div class="bg-slate-50 dark:bg-neutral-800 rounded-lg p-6">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4">📅 Session Information</h2>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-slate-600 dark:text-slate-400 uppercase font-semibold">Date</p>
                                <p class="text-slate-900 dark:text-white font-semibold">
                                    {{ optional($studentAttendance->session)->date?->format('l, F d, Y') ?? 'N/A' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-600 dark:text-slate-400 uppercase font-semibold">Time</p>
                                <p class="text-slate-900 dark:text-white">
                                    {{ optional($studentAttendance->session)->start_time }} - {{ optional($studentAttendance->session)->end_time }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-600 dark:text-slate-400 uppercase font-semibold">Location</p>
                                <p class="text-slate-900 dark:text-white">{{ optional($studentAttendance->session)->location ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-600 dark:text-slate-400 uppercase font-semibold">Coach</p>
                                <p class="text-slate-900 dark:text-white">{{ optional($studentAttendance->session->coach)->name ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Attendance Details --}}
                    <div class="bg-slate-50 dark:bg-neutral-800 rounded-lg p-6">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4">📋 Attendance Details</h2>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-slate-600 dark:text-slate-400 uppercase font-semibold">Status</p>
                                <div class="mt-1">
                                    @if($studentAttendance->status == 'present')
                                        <span class="px-3 py-1 bg-green-100 text-green-800 text-sm font-bold rounded-lg">✓ Present</span>
                                    @elseif($studentAttendance->status == 'absent')
                                        <span class="px-3 py-1 bg-red-100 text-red-800 text-sm font-bold rounded-lg">✗ Absent</span>
                                    @elseif($studentAttendance->status == 'late')
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-800 text-sm font-bold rounded-lg">⏰ Late</span>
                                    @elseif($studentAttendance->status == 'excused')
                                        <span class="px-3 py-1 bg-blue-100 text-blue-800 text-sm font-bold rounded-lg">📝 Excused</span>
                                    @endif
                                </div>
                            </div>
                            <div>
                                <p class="text-xs text-slate-600 dark:text-slate-400 uppercase font-semibold">Notes</p>
                                <p class="text-slate-900 dark:text-white">{{ $studentAttendance->notes ?? 'No notes' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-600 dark:text-slate-400 uppercase font-semibold">Recorded By</p>
                                <p class="text-slate-900 dark:text-white">{{ optional($studentAttendance->recordedBy)->name ?? 'System' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Timestamps --}}
                    <div class="bg-slate-50 dark:bg-neutral-800 rounded-lg p-6">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-4">⏱️ Timestamps</h2>
                        <div class="space-y-3">
                            <div>
                                <p class="text-xs text-slate-600 dark:text-slate-400 uppercase font-semibold">Record Created</p>
                                <p class="text-slate-900 dark:text-white">{{ $studentAttendance->created_at->format('M d, Y • h:i A') }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-600 dark:text-slate-400 uppercase font-semibold">Last Updated</p>
                                <p class="text-slate-900 dark:text-white">{{ $studentAttendance->updated_at->format('M d, Y • h:i A') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-slate-200 dark:border-neutral-700">
                    <a href="{{ route('admin.student-attendance.edit', $studentAttendance) }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">
                        ✏️ Edit Record
                    </a>
                    <form method="POST" action="{{ route('admin.student-attendance.destroy', $studentAttendance) }}" class="inline" onsubmit="return confirm('Are you sure you want to delete this attendance record?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition font-semibold">
                            🗑️ Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
