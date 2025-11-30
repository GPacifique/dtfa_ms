@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Upcoming Events</h1>
        <a href="{{ route('admin.upcoming-events.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium transition">
            ➕ Create New Event
        </a>
    </div>

    <!-- Status Filter Tabs -->
    <div class="flex gap-2 mb-6 border-b border-gray-200 dark:border-neutral-700">
        <a href="{{ route('admin.upcoming-events.index') }}" class="px-4 py-2 border-b-2 {{ !request('status') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-600 dark:text-gray-400' }} font-medium">All</a>
        <a href="{{ route('admin.upcoming-events.index', ['status' => 'upcoming']) }}" class="px-4 py-2 border-b-2 border-transparent text-gray-600 dark:text-gray-400 hover:border-blue-400">📅 Upcoming</a>
        <a href="{{ route('admin.upcoming-events.index', ['status' => 'ongoing']) }}" class="px-4 py-2 border-b-2 border-transparent text-gray-600 dark:text-gray-400 hover:border-yellow-400">🔴 Ongoing</a>
        <a href="{{ route('admin.upcoming-events.index', ['status' => 'completed']) }}" class="px-4 py-2 border-b-2 border-transparent text-gray-600 dark:text-gray-400 hover:border-green-400">✅ Completed</a>
        <a href="{{ route('admin.upcoming-events.index', ['status' => 'cancelled']) }}" class="px-4 py-2 border-b-2 border-transparent text-gray-600 dark:text-gray-400 hover:border-red-400">❌ Cancelled</a>
    </div>

    <div class="bg-white dark:bg-neutral-900 shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-neutral-800">
                <tr class="text-left text-sm font-medium text-gray-700 dark:text-gray-300">
                    <th class="px-6 py-3">Event Name</th>
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Time</th>
                    <th class="px-6 py-3">Venue</th>
                    <th class="px-6 py-3">Coordinator</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @forelse($events as $event)
                <tr class="hover:bg-gray-50 dark:hover:bg-neutral-800 transition">
                    <td class="px-6 py-4 text-sm font-medium text-gray-900 dark:text-white">{{ $event->event_name }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $event->date?->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $event->starting_time }} - {{ $event->ending_time }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $event->venue }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $event->coordinator_name }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $event->status === 'upcoming' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : ($event->status === 'ongoing' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : ($event->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200')) }}">
                            {{ ucfirst($event->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.upcoming-events.show', $event) }}" class="text-indigo-600 hover:text-indigo-900 dark:hover:text-indigo-400 font-medium text-sm">View</a>
                        <a href="{{ route('admin.upcoming-events.edit', $event) }}" class="text-blue-600 hover:text-blue-900 dark:hover:text-blue-400 font-medium text-sm">Edit</a>
                        <form action="{{ route('admin.upcoming-events.destroy', $event) }}" method="POST" class="inline" onsubmit="return confirm('Delete this event?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-900 dark:hover:text-red-400 font-medium text-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                        No events found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $events->links() }}
    </div>
</div>
@endsection
