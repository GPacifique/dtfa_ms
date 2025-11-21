@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold">Training Session Records</h2>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.training_session_records.create') }}" class="inline-flex items-center px-3 py-1.5 bg-green-600 text-white rounded-md text-sm">New Record</a>
        </div>
    </div>

    <div class="bg-white shadow overflow-hidden sm:rounded-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Coach</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pitch</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Attendees</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($records as $record)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ optional($record->date)->format('Y-m-d') ?? $record->date }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $record->coach_name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $record->training_pitch }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $record->number_of_kids }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-right">
                            <a href="{{ route('admin.training_session_records.show', $record) }}" class="text-indigo-600 mr-3">View</a>
                            <a href="{{ route('admin.training_session_records.edit', $record) }}" class="text-yellow-600 mr-3">Edit</a>
                            <form action="{{ route('admin.training_session_records.destroy', $record) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this record?')">
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
