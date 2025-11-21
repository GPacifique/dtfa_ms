@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold">Staff Attendance Details</h2>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.staff_attendances.index') }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm">Back</a>
            <a href="{{ route('admin.staff_attendances.edit', $attendance) }}" class="inline-flex items-center px-3 py-1.5 border border-yellow-300 rounded-md text-sm">Edit</a>
        </div>
    </div>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Date</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ optional($attendance->date)->format('Y-m-d') }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Staff</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ optional(App\Models\User::find($attendance->staff_id))->name }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Activity</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $attendance->activity_type }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $attendance->status }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Notes</dt>
                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $attendance->notes }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection
