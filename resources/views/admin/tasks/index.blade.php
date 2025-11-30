@extends('layouts.app')

@section('content')
<div class="p-6">
    <div class="flex justify-between mb-4">
        <h2 class="text-2xl font-bold">Task Management</h2>
        <a href="{{ route('admin.tasks.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded shadow">
            + New Task
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">Staff</th>
                    <th class="p-3">Goal</th>
                    <th class="p-3">Objective</th>
                    <th class="p-3">Start</th>
                    <th class="p-3">End</th>
                    <th class="p-3">Status</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                <tr class="border-t">
                    <td class="p-3">{{ $task->staff->first_name }}</td>
                    <td class="p-3">{{ Str::limit($task->goal, 25) }}</td>
                    <td class="p-3">{{ Str::limit($task->objective, 25) }}</td>
                    <td class="p-3">{{ $task->start_date }}</td>
                    <td class="p-3">{{ $task->end_date }}</td>

                    <td class="p-3">
                        @if(now() > $task->end_date)
                            <span class="bg-green-200 text-green-800 px-2 py-1 rounded">Completed</span>
                        @else
                            <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded">In Progress</span>
                        @endif
                    </td>

                    <td class="p-3 text-right">
                        <a href="{{ route('admin.tasks.show', $task->id) }}" class="text-blue-600 mr-3">View</a>
                        <a href="{{ route('admin.tasks.edit', $task->id) }}" class="text-yellow-600 mr-3">Edit</a>

                        <form action="{{ route('admin.tasks.destroy', $task->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this task?')" class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="p-5 text-center text-gray-500">No tasks found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <div class="p-3">
            {{ $tasks->links() }}
        </div>
    </div>
</div>
@endsection
