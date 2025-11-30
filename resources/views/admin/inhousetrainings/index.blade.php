@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">In-House Trainings</h1>
        <a href="{{ route('admin.inhousetrainings.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium transition">
            ➕ Add New Training
        </a>
    </div>

    <div class="bg-white dark:bg-neutral-900 shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-neutral-800">
                <tr class="text-left text-sm font-medium text-gray-700 dark:text-gray-300">
                    <th class="px-6 py-3">Training Name</th>
                    <th class="px-6 py-3">Discipline</th>
                    <th class="px-6 py-3">Country</th>
                    <th class="px-6 py-3">Start Date</th>
                    <th class="px-6 py-3">Branch</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @forelse ($inhousetrainings as $t)
                <tr class="hover:bg-gray-50 dark:hover:bg-neutral-800 transition">
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $t->training_name }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $t->discipline }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $t->country }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $t->start?->format('M d, Y') }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $t->branch->name ?? '—' }}</td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.inhousetrainings.show', $t->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:hover:text-indigo-400 font-medium">View</a>
                        <a href="{{ route('admin.inhousetrainings.edit', $t->id) }}" class="text-blue-600 hover:text-blue-900 dark:hover:text-blue-400 font-medium">Edit</a>
                        <form action="{{ route('admin.inhousetrainings.destroy', $t->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this training?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-900 dark:hover:text-red-400 font-medium">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                        No trainings found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $inhousetrainings->links() }}
    </div>
</div>
@endsection
