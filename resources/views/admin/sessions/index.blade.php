@extends('layouts.app')
@php($title = 'Training Sessions')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-xl font-bold">Training Sessions</h2>
        <a href="{{ route('admin.sessions.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">New Session</a>
    </div>

    <div class="card">
        <div class="card-body overflow-x-auto">
            @if($sessions->isEmpty())
                <div class="p-6 text-slate-500">No sessions found.</div>
            @else
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-xs text-slate-500">
                            <th class="p-2">Date</th>
                            <th class="p-2">Time</th>
                            <th class="p-2">Branch</th>
                            <th class="p-2">Group</th>
                            <th class="p-2">Coach</th>
                            <th class="p-2">Location</th>
                            <th class="p-2 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sessions as $s)
                            <tr class="border-t">
                                <td class="p-2">{{ $s->date->format('M d, Y') }}</td>
                                <td class="p-2">{{ $s->start_time }} — {{ $s->end_time }}</td>
                                <td class="p-2">{{ $s->branch->name ?? 'N/A' }}</td>
                                <td class="p-2">{{ $s->group->name ?? $s->group_name ?? 'N/A' }}</td>
                                <td class="p-2">{{ $s->coach->name ?? 'TBD' }}</td>
                                <td class="p-2">{{ $s->location ?? '' }}</td>
                                <td class="p-2 text-right">
                                    <a href="{{ route('admin.sessions.edit', $s) }}" class="text-indigo-600 mr-2">Edit</a>
                                    <form action="{{ route('admin.sessions.destroy', $s) }}" method="POST" class="inline-block" onsubmit="return confirm('Delete this session?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-rose-600">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $sessions->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Sessions</h1>
        <a href="{{ route('admin.sessions.create') }}" class="px-3 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">New Session</a>
    </div>

    @if (session('status'))
        <div class="text-green-600 text-sm mb-3">{{ session('status') }}</div>
    @endif

    <div class="bg-white dark:bg-neutral-900 shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-neutral-200 dark:divide-neutral-800">
            <thead class="bg-neutral-50 dark:bg-neutral-800">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Date</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Time</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Coach</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Branch</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Group</th>
                    <th class="px-4 py-3 text-left text-xs font-medium uppercase tracking-wider">Location</th>
                    <th class="px-4 py-3 text-right text-xs font-medium uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-neutral-200 dark:divide-neutral-800">
                @foreach ($sessions as $session)
                    <tr>
                        <td class="px-4 py-3">{{ $session->date->format('M d, Y') }}</td>
                        <td class="px-4 py-3">{{ $session->start_time }}–{{ $session->end_time }}</td>
                        <td class="px-4 py-3">{{ $session->coach?->name ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $session->branch?->name ?? '—' }}</td>
                        <td class="px-4 py-3">{{ $session->group?->name ?? $session->group_name }}</td>
                        <td class="px-4 py-3">{{ $session->location }}</td>
                        <td class="px-4 py-3 text-right">
                            <a href="{{ route('admin.sessions.edit', $session) }}" class="px-2 py-1 text-indigo-700 hover:underline">Edit</a>
                            <form method="POST" action="{{ route('admin.sessions.destroy', $session) }}" class="inline" onsubmit="return confirm('Delete this session? This will remove related attendance.');">
                                @csrf
                                @method('DELETE')
                                <button class="px-2 py-1 text-red-700 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $sessions->links() }}
    </div>
</div>
@endsection
