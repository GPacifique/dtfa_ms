@extends('layouts.app')
@section('title', 'Add Attendance Record')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900 py-12">
    <div class="container mx-auto px-6 max-w-3xl">

        <div class="card">
            <div class="card-body">
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white mb-6">➕ Add Player Attendance Record</h1>

                <form method="POST" action="{{ route('admin.student-attendance.store') }}" class="space-y-6">
                    @csrf

                    {{-- Player --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Player *</label>
                        <select name="student_id" required class="w-full border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white @error('student_id') border-red-500 @enderror">
                            <option value="">Select Player</option>
                            @foreach($students as $student)
                                <option value="{{ $student->id }}" @selected(old('student_id') == $student->id)>
                                    {{ $student->first_name }} {{ $student->second_name }} {{ $student->last_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('student_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Training Session --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Training Session *</label>
                        <select name="training_session_id" required class="w-full border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white @error('training_session_id') border-red-500 @enderror">
                            <option value="">Select Session</option>
                            @foreach($sessions as $session)
                                <option value="{{ $session->id }}" @selected(old('training_session_id') == $session->id)>
                                    {{ $session->date->format('M d, Y') }} • {{ $session->start_time }} - {{ $session->end_time }} • {{ $session->location }}
                                </option>
                            @endforeach
                        </select>
                        @error('training_session_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Attendance Status *</label>
                        <select name="status" required class="w-full border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white @error('status') border-red-500 @enderror">
                            <option value="">Select Status</option>
                            <option value="present" @selected(old('status') == 'present')>✓ Present</option>
                            <option value="absent" @selected(old('status') == 'absent')>✗ Absent</option>
                            <option value="late" @selected(old('status') == 'late')>⏰ Late</option>
                            <option value="excused" @selected(old('status') == 'excused')>📝 Excused</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Notes --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Notes</label>
                        <textarea name="notes" rows="4" class="w-full border border-slate-300 dark:border-neutral-600 rounded-lg px-3 py-2 dark:bg-neutral-800 dark:text-white @error('notes') border-red-500 @enderror" placeholder="Any additional notes...">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Actions --}}
                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-200 dark:border-neutral-700">
                        <a href="{{ route('admin.student-attendance.index') }}" class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition font-semibold">
                            Cancel
                        </a>
                        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">
                            💾 Save Record
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
