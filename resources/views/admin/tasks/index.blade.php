@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    {{-- Hero Section --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 rounded-2xl shadow-2xl mb-6">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2230%22 height=%2230%22 viewBox=%220 0 30 30%22 fill=%22none%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z%22 fill=%22rgba(255,255,255,0.07)%22/%3E%3C/svg%3E')] opacity-50"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-gradient-to-br from-yellow-400/30 to-lime-500/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-gradient-to-br from-blue-400/30 to-indigo-500/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>

        <div class="relative z-10 px-6 py-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg">✓ Task Management</h1>
                <p class="text-white/90 mt-1">Track and manage staff tasks and objectives</p>
            </div>
            <a href="{{ route('admin.tasks.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white hover:bg-slate-50 text-emerald-700 font-semibold rounded-xl shadow-lg transition-all duration-200 hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                New Task
            </a>
        </div>
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
