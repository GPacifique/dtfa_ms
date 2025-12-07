@extends('layouts.app')

@push('hero')
    <x-hero title="Record Staff Attendance" :subtitle="$staff->first_name . ' ' . $staff->last_name">
        <div class="mt-4">
            <a href="{{ route('staff.index') }}" class="btn-secondary">← Back to Staff</a>
        </div>
    </x-hero>
@endpush

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
        <form method="POST" action="{{ route('attendances.store') }}" class="space-y-4">
            @csrf

            <input type="hidden" name="staff_id" value="{{ $staff->id }}">

            <div>
                <label class="block text-sm font-medium mb-1">Date</label>
                <input type="date" name="attendance_date" value="{{ old('attendance_date', now()->toDateString()) }}" class="w-full border rounded px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" required>
                @error('attendance_date')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Status</label>
                <select name="status" class="w-full border rounded px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" required>
                    <option value="">— Select Status —</option>
                    <option value="present" @selected(old('status') === 'present')>Present</option>
                    <option value="absent" @selected(old('status') === 'absent')>Absent</option>
                    <option value="late" @selected(old('status') === 'late')>Late</option>
                </select>
                @error('status')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Notes (Optional)</label>
                <textarea name="notes" rows="4" class="w-full border rounded px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Add any notes...">{{ old('notes') }}</textarea>
                @error('notes')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            <div class="flex items-center justify-end gap-2 pt-4">
                <a href="{{ route('staff.index') }}" class="px-4 py-2 border rounded hover:bg-gray-100 dark:hover:bg-neutral-800">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Record Attendance</button>
            </div>
        </form>
    </div>
</div>
@endsection
