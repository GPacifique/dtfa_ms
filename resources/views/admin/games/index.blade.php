@extends('layouts.app')

@push('hero')
    <x-hero title="Matches" subtitle="Schedule and manage match reports">
        <div class="mt-4 flex items-center gap-2">
            <a href="{{ route('admin.games.create') }}" class="btn-primary">➕ Schedule New Match</a>
        </div>
    </x-hero>
@endpush

@section('content')
<div class="max-w-7xl mx-auto p-6">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">⚽ Matches</h1>
        <a href="{{ route('admin.games.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">➕ Schedule Match</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white dark:bg-neutral-900 shadow rounded-lg overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 dark:bg-neutral-800">
                <tr class="text-left text-sm font-medium text-gray-700 dark:text-gray-300">
                    <th class="px-6 py-3">Date</th>
                    <th class="px-6 py-3">Match</th>
                    <th class="px-6 py-3">Venue</th>
                    <th class="px-6 py-3">Discipline</th>
                    <th class="px-6 py-3">Score</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                @forelse($games as $game)
                <tr class="hover:bg-gray-50 dark:hover:bg-neutral-800 transition">
                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-white">
                        {{ $game->date?->format('M d, Y') }}
                        @if($game->time)
                            <span class="text-gray-500 text-xs block">{{ $game->time }}</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-2">
                            <span class="w-5 h-5 rounded-full shadow-md border border-gray-200 dark:border-gray-600" style="background-color: {{ $game->home_color ?? '#3B82F6' }}" title="{{ $game->home_team }} color"></span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $game->home_team }}</span>
                            <span class="text-gray-500 dark:text-gray-400 mx-1">vs</span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $game->away_team }}</span>
                            <span class="w-5 h-5 rounded-full shadow-md border border-gray-200 dark:border-gray-600" style="background-color: {{ $game->away_color ?? '#EF4444' }}" title="{{ $game->away_team }} color"></span>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600 dark:text-gray-400">{{ $game->venue ?? '—' }}</td>
                    <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $game->discipline }}</td>
                    <td class="px-6 py-4">
                        @if($game->home_score !== null && $game->away_score !== null)
                            <span class="font-bold text-lg text-gray-900 dark:text-white">{{ $game->home_score }} - {{ $game->away_score }}</span>
                        @else
                            <span class="text-gray-400">—</span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        @if($game->home_score !== null && $game->away_score !== null)
                            <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Completed</span>
                        @elseif($game->date && $game->date->isPast())
                            <span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Pending Report</span>
                        @else
                            <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Scheduled</span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex gap-2 justify-end items-center">
                            <a href="{{ route('admin.games.report', $game) }}" class="px-3 py-1.5 bg-indigo-100 hover:bg-indigo-200 text-indigo-700 rounded-lg font-medium text-sm transition" title="Match Report">
                                📝 Report
                            </a>
                            <a href="{{ route('admin.games.edit', $game) }}" class="px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg font-medium text-sm transition" title="Edit Match">
                                ✏️
                            </a>
                            <form action="{{ route('admin.games.destroy', $game) }}" method="POST" class="inline" onsubmit="return confirm('Delete this match?');">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1.5 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg font-medium text-sm transition" title="Delete">
                                    🗑️
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-8 text-center text-gray-500 dark:text-gray-400">
                        No matches found. <a href="{{ route('admin.games.create') }}" class="text-indigo-600 hover:underline">Schedule one now</a>
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
