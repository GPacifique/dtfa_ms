@extends('layouts.app')

@section('content')
@section('hide-back')@endsection
<div class="container mx-auto px-6 py-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Student Profile</h1>
        <div class="flex gap-2">
            <x-button href="{{ route('students-modern.create') }}" variant="primary">+ New Student</x-button>
            <x-button href="{{ route('students-modern.edit', $student) }}" variant="secondary">Edit</x-button>
            <x-button href="{{ route('students-modern.index') }}" variant="secondary">Back to List</x-button>
        </div>
    </div>

    @if(session('status'))
        <x-alert type="success" class="mb-4">{{ session('status') }}</x-alert>
    @endif

    @if(session('attendance_success'))
        <div class="mb-4 p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-lg">
            <p class="text-emerald-800 dark:text-emerald-300 font-semibold">✅ {{ session('attendance_success') }}</p>
        </div>
    @endif

    <!-- Quick Attendance Recording -->
    @if(!empty($sessions) && $sessions->count())
    <div class="bg-emerald-50 dark:bg-emerald-900/20 rounded-xl shadow-sm border border-emerald-200 dark:border-emerald-800 p-6 mb-4">
        <h2 class="text-lg font-bold text-emerald-900 dark:text-emerald-300 mb-4">✅ Quick Attendance Recording</h2>

        @if($errors->any())
            <div class="mb-4 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                <ul class="text-sm text-red-800 dark:text-red-300 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.student-attendance.store') }}" class="flex flex-col md:flex-row gap-4 items-end">
            @csrf
            <input type="hidden" name="student_id" value="{{ $student->id }}">
            <input type="hidden" name="redirect_to_student" value="1">
            <div class="flex-1">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Select Session</label>
                <select name="training_session_id" required class="w-full px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-500 dark:bg-slate-800 dark:text-white">
                    <option value="">-- Choose a session --</option>
                    @foreach($sessions as $s)
                        <option value="{{ $s->id }}">
                            {{ optional($s->date)->format('M d, Y') }} - {{ $s->start_time }}
                            @if($s->branch) ({{ $s->branch }}) @endif
                            @if($s->city) - {{ $s->city }} @endif
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Status</label>
                <select name="status" required class="px-3 py-2 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-emerald-500 dark:bg-slate-800 dark:text-white">
                    <option value="present" selected>Present</option>
                    <option value="late">Late</option>
                    <option value="absent">Absent</option>
                    <option value="excused">Excused</option>
                </select>
            </div>
            <div>
                <button type="submit" class="px-6 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition">
                    ✅ Record Attendance
                </button>
            </div>
        </form>
    </div>
    @else
    <div class="bg-amber-50 dark:bg-amber-900/20 rounded-xl shadow-sm border border-amber-200 dark:border-amber-800 p-6 mb-4">
        <p class="text-amber-800 dark:text-amber-300 font-semibold">⚠️ No recent training sessions available. Please create a training session first to record attendance.</p>
    </div>
    @endif

    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-6">
        <div class="flex gap-6">
            <x-image :path="$student->photo_path" :name="($student->first_name.' '.$student->second_name)" size="112" class="w-28 h-28 rounded object-cover ring-1 ring-slate-200 dark:ring-slate-700" />
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 w-full">
                <div>
                    <p class="text-xs text-slate-500">Name</p>
                    <p class="font-semibold">{{ $student->first_name }} {{ $student->second_name }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Email</p>
                    <p>{{ $student->email ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Phone</p>
                    <p>{{ $student->phone ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Status</p>
                    <p><span class="px-2 py-1 rounded-full text-xs {{ $student->status==='active' ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300' : 'bg-slate-100 text-slate-700 dark:bg-slate-800/50 dark:text-slate-300' }}">{{ ucfirst($student->status) }}</span></p>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Group</p>
                    <p>{{ optional($student->group)->name ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Branch</p>
                    <p>{{ optional($student->branch)->name ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Joined</p>
                    <p>{{ $student->joined_at?->format('M d, Y') ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500">DOB / Age</p>
                    <p>{{ $student->dob?->format('Y-m-d') ?? '—' }} @if($student->age) <span class="text-slate-500">({{ $student->age }})</span> @endif</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Emergency Phone</p>
                    <p>{{ $student->emergency_phone ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Parents</p>
                    <p>{{ $student->father_name ?? '—' }} / {{ $student->mother_name ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500">School</p>
                    <p>{{ $student->school_name ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Program / Membership</p>
                    <p>{{ $student->program ?? '—' }} {{ $student->membership_type ? '(' . $student->membership_type . ')' : '' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Sport</p>
                    <p>{{ $student->sport_discipline ?? '—' }} {{ $student->position ? '• ' . $student->position : '' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Jersey</p>
                    <p>{{ $student->jersey_name ?? '—' }} {{ $student->jersey_number ? '#' . $student->jersey_number : '' }}</p>
                </div>
                <div>
                    <p class="text-xs text-slate-500">Coach</p>
                    <p>{{ $student->coach ?? '—' }}</p>
                </div>
            </div>
        </div>
        <div class="mt-6 flex items-center justify-between">
            <form method="post" action="{{ route('students-modern.destroy', $student) }}" onsubmit="return confirm('Delete this student?')">
                @csrf
                @method('DELETE')
                <x-button variant="danger" type="submit">Delete</x-button>
            </form>
        </div>
    </div>
</div>
@endsection
