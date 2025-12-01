@extends('layouts.app')

@section('content')
@section('hide-back')@endsection
<div class="container mx-auto px-6 py-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold text-slate-900 dark:text-white">Student Profile</h1>
        <div class="flex gap-2">
            <x-button href="{{ route('students-modern.edit', $student) }}" variant="secondary">Edit</x-button>
            <x-button href="{{ route('students-modern.index') }}" variant="secondary">Back to List</x-button>
        </div>
    </div>

    @if(session('status'))
        <x-alert type="success" class="mb-4">{{ session('status') }}</x-alert>
    @endif

    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-6">
        <div class="flex gap-6">
            <img class="w-28 h-28 rounded object-cover ring-1 ring-slate-200 dark:ring-slate-700" src="{{ $student->photo_url }}" />
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
