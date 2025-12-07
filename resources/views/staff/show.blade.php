@extends('layouts.app')

@push('hero')
    <x-hero :title="'Staff: ' . ($staff->first_name . ' ' . $staff->last_name)" subtitle="Profile overview and details">
        <div class="mt-4 flex items-center gap-2">
            <a href="{{ route('staff.index') }}" class="btn-secondary">← Back to Staff</a>
            <a href="{{ route('staff.edit', $staff) }}" class="btn-primary">Edit</a>
        </div>
    </x-hero>
@endpush

@section('content')
    <div class="bg-white dark:bg-slate-800 rounded shadow p-6">
        {{-- Staff Photo --}}
        <div class="flex items-start gap-6 mb-6 pb-6 border-b border-slate-200 dark:border-slate-700">
            <img src="{{ $staff->photo_url }}" alt="{{ $staff->first_name }} {{ $staff->last_name }}" class="w-32 h-32 rounded-full object-cover ring-4 ring-slate-200 dark:ring-slate-700 shadow-lg">
            <div>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $staff->first_name }} {{ $staff->last_name }}</h3>
                <p class="text-slate-600 dark:text-slate-400 mt-1">{{ $staff->role_function }}</p>
                @if($staff->email)
                    <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">{{ $staff->email }}</p>
                @endif
            </div>
        </div>
        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <dt class="text-sm font-medium text-slate-600">First Name</dt>
                <dd class="mt-1">{{ $staff->first_name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-600">Last Name</dt>
                <dd class="mt-1">{{ $staff->last_name }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-600">Gender</dt>
                <dd class="mt-1">{{ $staff->gender }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-600">Branch</dt>
                <dd class="mt-1">{{ $staff->branch }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-600">Discipline</dt>
                <dd class="mt-1">{{ $staff->discipline }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-600">Role / Function</dt>
                <dd class="mt-1">{{ $staff->role_function }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-600">Date of Birth</dt>
                <dd class="mt-1">{{ optional($staff->dob)->format('Y-m-d') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-600">Email</dt>
                <dd class="mt-1">{{ $staff->email }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-600">Academic Qualification</dt>
                <dd class="mt-1">{{ $staff->academic_qualification }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-600">Professional Certificates</dt>
                <dd class="mt-1">{{ $staff->professional_certificates }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-600">Sizes (T-shirt / Short / Top Tracksuit / Pant Tracksuit)</dt>
                <dd class="mt-1">{{ $staff->tshirt_size }} / {{ $staff->short_size }} / {{ $staff->top_tracksuit_size }} / {{ $staff->pant_tracksuit_size }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-600">Other Organizations</dt>
                <dd class="mt-1">{{ $staff->other_organizations }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-600">Entry Date</dt>
                <dd class="mt-1">{{ optional($staff->date_entry)->format('Y-m-d') }}</dd>
            </div>
            <div>
                <dt class="text-sm font-medium text-slate-600">Exit Date</dt>
                <dd class="mt-1">{{ optional($staff->date_exit)->format('Y-m-d') }}</dd>
            </div>
        </dl>

        <div class="mt-6 flex items-center gap-3 justify-end">
            <a href="{{ route('staff.edit', $staff) }}" class="btn-primary">Edit</a>
            <form action="{{ route('staff.destroy', $staff) }}" method="POST" onsubmit="return confirm('Delete staff?')">
                @csrf
                @method('DELETE')
                <button class="btn-danger">Delete</button>
            </form>
        </div>
    </div>
@endsection
