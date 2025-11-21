@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold">Edit Staff Attendance</h2>
        <a href="{{ route('admin.staff_attendances.index') }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm">Back</a>
    </div>

    <form action="{{ route('admin.staff_attendances.update', $staffAttendance) }}" method="POST" class="space-y-6">
        @csrf
        @method('PUT')

        @include('admin.staff_attendances._form')

        <div class="pt-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md">Save Changes</button>
        </div>
    </form>
</div>
@endsection
