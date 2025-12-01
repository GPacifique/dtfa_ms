@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6 space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold">Student Profile</h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('student.profile.show', $student) }}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-semibold transition">👤 My Profile</a>
            <a href="{{ url()->previous() }}" class="text-sm underline">← Back</a>
        </div>
    </div>

    <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
        <div class="flex justify-center mb-6">
            <img src="{{ $student->photo_url }}" alt="Profile Image" class="h-32 w-32 rounded-full object-cover border-2 border-slate-200 shadow">
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <div class="text-sm text-neutral-500">Name</div>
                <div class="font-medium">{{ $student->first_name }} {{ $student->second_name }}</div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Status</div>
                <div class="font-medium">{{ ucfirst($student->status ?? 'active') }}</div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Email</div>
                <div class="font-medium">{{ $student->email ?? '—' }}</div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Phone</div>
                <div class="font-medium">{{ $student->phone ?? '—' }}</div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Emergency Phone</div>
                <div class="font-medium">{{ $student->emergency_phone ?? '—' }}</div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Date of Birth</div>
                <div class="font-medium">{{ optional($student->dob)->format('M d, Y') ?? '—' }}</div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Branch / Group</div>
                <div class="font-medium">{{ $student->branch?->name ?? '—' }} / {{ $student->group?->name ?? '—' }}</div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Sport Discipline</div>
                <div class="font-medium">{{ $student->sport_discipline ?? '—' }}</div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Position</div>
                <div class="font-medium">{{ $student->position ?? '—' }}</div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Coach</div>
                <div class="font-medium">{{ $student->coach ?? '—' }}</div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Father's Name</div>
                <div class="font-medium">{{ $student->father_name ?? '—' }}</div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Mother's Name</div>
                <div class="font-medium">{{ $student->mother_name ?? '—' }}</div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Parent</div>
                <div class="font-medium">{{ $student->parent?->name ?? '—' }}</div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">School</div>
                <div class="font-medium">{{ $student->school_name ?? '—' }}</div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Jersey Number</div>
                <div class="font-medium">{{ $student->jersey_number ?? '—' }}</div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Jersey Name</div>
                <div class="font-medium">{{ $student->jersey_name ?? '—' }}</div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Membership Type</div>
                <div class="font-medium">{{ $student->membership_type ?? '—' }}</div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Program</div>
                <div class="font-medium">{{ $student->program ?? '—' }}</div>
            </div>
            <div>
                <div class="text-sm text-neutral-500">Joined</div>
                <div class="font-medium">{{ optional($student->joined_at)->format('M d, Y') ?? '—' }}</div>
            </div>
        </div>

        <div class="mt-6">
            <a href="{{ route('coach.students.attendance', $student) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">View Attendance History</a>
        </div>
    </div>
</div>
@endsection
