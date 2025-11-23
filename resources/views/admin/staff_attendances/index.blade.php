@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold">Staff Attendance</h2>
        <a href="{{ route('admin.staff_attendances.create') }}" class="inline-flex items-center px-3 py-1.5 bg-green-600 text-white rounded-md text-sm">New</a>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Staff</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Activity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($records as $r)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ optional($r->date)->format('Y-m-d') ?? $r->date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ optional(App\Models\User::find($r->staff_id))->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ \App\Models\StaffAttendance::activityLabel($r->activity_type) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ \App\Models\StaffAttendance::statusLabel($r->status) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                            <a href="{{ route('admin.staff_attendances.show', $r) }}" class="text-indigo-600 mr-3">View</a>
                            <a href="{{ route('admin.staff_attendances.edit', $r) }}" class="text-yellow-600 mr-3">Edit</a>
                            <form action="{{ route('admin.staff_attendances.destroy', $r) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this record?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $records->links() }}
    </div>
</div>
@endsection
