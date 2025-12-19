@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Attendance for {{ $session->date->format('M d, Y') }} — {{ $session->group->name ?? $session->group_name }}</h1>
        <div>
            <a href="{{ route('admin.training_session_records.index') }}" class="px-3 py-2 bg-gray-200 rounded">Back</a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.sessions.attendance.store', $session) }}">
        @csrf

        <div class="bg-white shadow rounded p-4 mb-4">
            <table class="w-full table-auto">
                <thead>
                    <tr>
                        <th class="text-left">Student</th>
                        <th class="text-left">Status</th>
                        <th class="text-left">Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($students as $student)
                        @php
                            $rec = $existing->get($student->id);
                            $status = $rec?->status ?? 'absent';
                            $notes = $rec?->notes ?? '';
                        @endphp
                        <tr class="border-t">
                            <td class="py-2">{{ $student->name ?? ($student->first_name . ' ' . ($student->last_name ?? '')) }}</td>
                            <td class="py-2">
                                <select name="attendances[{{ $student->id }}][status]" class="border p-1">
                                    <option value="present" {{ $status === 'present' ? 'selected' : '' }}>Present</option>
                                    <option value="absent" {{ $status === 'absent' ? 'selected' : '' }}>Absent</option>
                                    <option value="late" {{ $status === 'late' ? 'selected' : '' }}>Late</option>
                                    <option value="excused" {{ $status === 'excused' ? 'selected' : '' }}>Excused</option>
                                </select>
                            </td>
                            <td class="py-2">
                                <input type="text" name="attendances[{{ $student->id }}][notes]" class="border p-1 w-full" value="{{ old('attendances.'.$student->id.'.notes', $notes) }}">
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="py-4 text-sm text-slate-500">No students found for this session's group/branch.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex gap-3">
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Save Attendance</button>
            <a href="{{ route('admin.sessions.recordAllAttendance', $session) }}" class="px-4 py-2 bg-emerald-500 text-white rounded" onclick="return confirm('Mark all students present?');">Mark All Present</a>
        </div>
    </form>
</div>
@endsection
