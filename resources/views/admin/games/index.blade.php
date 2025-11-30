@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Matches</h1>
        <a href="{{ route('admin.games.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium transition">
            ➕ Create New Match
        </a>
    </div>

    <!-- Status Filter Tabs -->
    <div class="flex gap-2 mb-6 border-b border-gray-200 dark:border-neutral-700">
        <a href="{{ route('admin.games.index') }}" class="px-4 py-2 border-b-2 border-indigo-600 text-indigo-600 font-medium">All</a>
        <a href="{{ route('admin.games.index', ['status' => 'scheduled']) }}" class="px-4 py-2 border-b-2 border-transparent text-gray-600 dark:text-gray-400 hover:border-blue-400">📅 Scheduled</a>
        <a href="{{ route('admin.games.index', ['status' => 'in_progress']) }}" class="px-4 py-2 border-b-2 border-transparent text-gray-600 dark:text-gray-400 hover:border-yellow-400">🏃 In Progress</a>
        <a href="{{ route('admin.games.index', ['status' => 'completed']) }}" class="px-4 py-2 border-b-2 border-transparent text-gray-600 dark:text-gray-400 hover:border-green-400">✅ Completed</a>
    </div>

    <div class="bg-white dark:bg-neutral-900 shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-neutral-800">
                <tr class="text-left text-sm font-medium text-gray-700 dark:text-gray-300">
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Match</th>
                    <th class="px-6 py-3">Discipline</th>
                    <th class="px-6 py-3">Score</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @forelse($games as $game)
                <tr class="hover:bg-gray-50 dark:hover:bg-neutral-800 transition">
                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">{{ $game->date?->format('M d, Y') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <span class="w-4 h-4 rounded-full" style="background-color: {{ $game->home_color ?? '#ccc' }}"></span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $game->home_team }}</span>
                            <span class="text-gray-500 dark:text-gray-400">vs</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $game->away_team }}</span>
                            <span class="w-4 h-4 rounded-full" style="background-color: {{ $game->away_color ?? '#ccc' }}"></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $game->discipline }}</td>
                    <td class="px-6 py-4">
                        @if($game->status === 'completed')
                            <span class="font-bold text-lg text-gray-900 dark:text-white">{{ $game->home_score ?? 0 }} - {{ $game->away_score ?? 0 }}</span>
                        @else
                            <span class="text-gray-500 dark:text-gray-400">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $game->status === 'scheduled' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : ($game->status === 'in_progress' ? 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200') }}">
                            {{ ucfirst(str_replace('_', ' ', $game->status)) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-right space-x-2">
                        <a href="{{ route('admin.games.show', $game) }}" class="text-indigo-600 hover:text-indigo-900 dark:hover:text-indigo-400 font-medium text-sm">View</a>
                        <a href="{{ route('admin.games.edit', $game) }}" class="text-blue-600 hover:text-blue-900 dark:hover:text-blue-400 font-medium text-sm">Edit</a>
                        <form action="{{ route('admin.games.destroy', $game) }}" method="POST" class="inline" onsubmit="return confirm('Delete this match?');">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-900 dark:hover:text-red-400 font-medium text-sm">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                        No matches found.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $games->links() }}
    </div>
</div>
@endsection
