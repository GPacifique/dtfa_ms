@extends('layouts.app-sidebar')

@section('content')
    <div class="flex items-center justify-between mb-4">
        <a href="{{ url()->previous() ?? route('staff.index') }}" class="btn-secondary">&larr; Back</a>
        <h2 class="text-xl font-semibold">Staff Details</h2>
        <div></div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded shadow p-6">
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
