@extends('layouts.app')

@push('hero')
    <x-hero :title="__('app.attendance') . ': ' . ($session->date->format('M d, Y'))" :subtitle="$session->group->name ?? $session->group_name">
        <div class="mt-4">
            <a href="{{ route('admin.training_session_records.index') }}" class="btn-secondary">← {{ __('app.back_to_sessions') }}</a>
        </div>
    </x-hero>
@endpush

@section('content')
<div class="max-w-4xl mx-auto p-6">

    <form method="POST" action="{{ route('admin.sessions.attendance.store', $session) }}">
        @csrf

        <div class="bg-white shadow rounded p-4 mb-4">
            <table class="w-full table-auto">
                <thead>
                    <tr>
                        <th class="text-left">{{ __('app.student') }}</th>
                        <th class="text-left">{{ __('app.status') }}</th>
                        <th class="text-left">{{ __('app.notes') }}</th>
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
                                    <option value="present" {{ $status === 'present' ? 'selected' : '' }}>{{ __('app.present') }}</option>
                                    <option value="absent" {{ $status === 'absent' ? 'selected' : '' }}>{{ __('app.absent') }}</option>
                                    <option value="late" {{ $status === 'late' ? 'selected' : '' }}>{{ __('app.late') }}</option>
                                    <option value="excused" {{ $status === 'excused' ? 'selected' : '' }}>{{ __('app.excused') }}</option>
                                </select>
                            </td>
                            <td class="py-2">
                                <input type="text" name="attendances[{{ $student->id }}][notes]" class="border p-1 w-full" value="{{ old('attendances.'.$student->id.'.notes', $notes) }}">
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="3" class="py-4 text-sm text-slate-500">{{ __('app.no_students_found_session') }}</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex gap-3">
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">{{ __('app.save_attendance') }}</button>
            <a href="{{ route('admin.sessions.recordAllAttendance', $session) }}" class="px-4 py-2 bg-emerald-500 text-white rounded" onclick="return confirm('{{ __('app.confirm_mark_all_present') }}');">{{ __('app.mark_all_present') }}</a>
        </div>
    </form>
</div>
@endsection
