@extends('layouts.app')

@push('hero')
    <x-hero title="Meeting Minutes" subtitle="Plan, record, and track meeting outcomes">
        <a href="{{ route('admin.minutes.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium transition">➕ Create New Minutes</a>
    </x-hero>
@endpush

@section('content')
<div class="max-w-7xl mx-auto p-6">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">📝 Meeting Minutes</h1>
        <a href="{{ route('admin.minutes.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">➕ New Minutes</a>
    </div>

    <!-- Status Filter Tabs -->
    <div class="flex gap-2 mb-6 border-b border-gray-200 dark:border-neutral-700">
        <a href="{{ route('admin.minutes.index') }}" class="px-4 py-2 border-b-2 {{ !request('status') ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-gray-600 dark:text-gray-400' }} font-medium">All</a>
        <a href="{{ route('admin.minutes.index', ['status' => 'scheduled']) }}" class="px-4 py-2 border-b-2 border-transparent text-gray-600 dark:text-gray-400 hover:border-blue-400">📅 Scheduled</a>
        <a href="{{ route('admin.minutes.index', ['status' => 'completed']) }}" class="px-4 py-2 border-b-2 border-transparent text-gray-600 dark:text-gray-400 hover:border-green-400">✅ Completed</a>
        <a href="{{ route('admin.minutes.index', ['status' => 'cancelled']) }}" class="px-4 py-2 border-b-2 border-transparent text-gray-600 dark:text-gray-400 hover:border-red-400">❌ Cancelled</a>
    </div>

    <div class="bg-white dark:bg-neutral-900 shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-neutral-800">
                <tr class="text-left text-sm font-medium text-gray-700 dark:text-gray-300">
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Time</th>
                    <th class="px-6 py-3">Venue</th>
                    <th class="px-6 py-3">Chaired By</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @forelse($minutes as $minute)
                <tr class="hover:bg-gray-50 dark:hover:bg-neutral-800 transition">
                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white font-medium">{{ $minute->date?->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $minute->starting_time }} - {{ $minute->end_time }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $minute->venue }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $minute->chaired_by }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $minute->status === 'scheduled' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : ($minute->status === 'completed' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200') }}">
                            {{ ucfirst($minute->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.minutes.show', $minute) }}" class="text-indigo-600 hover:text-indigo-900 dark:hover:text-indigo-400 font-medium text-sm">View</a>
                        <a href="{{ route('admin.minutes.edit', $minute) }}" class="text-blue-600 hover:text-blue-900 dark:hover:text-blue-400 font-medium text-sm">Edit</a>
                        <form action="{{ route('admin.minutes.destroy', $minute) }}" method="POST" class="inline" onsubmit="return confirm('Delete these minutes?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-900 dark:hover:text-red-400 font-medium text-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                        No minutes found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $minutes->links() }}
    </div>
</div>
@endsection
