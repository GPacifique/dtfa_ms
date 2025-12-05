@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Match Report</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">Record match outcome and statistics</p>
        </div>
        <a href="{{ route('admin.games.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 font-medium transition">
            ← Back to Matches
        </a>
    </div>

    <!-- Match Info Card -->
    <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl shadow-xl p-6 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-sm opacity-90 mb-2">{{ $game->date?->format('l, F j, Y') }} at {{ $game->time }}</p>
                <div class="flex items-center gap-4 text-2xl font-bold">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full shadow-lg" style="background-color: {{ $game->home_color ?? '#fff' }}"></span>
                        <span>{{ $game->home_team }}</span>
                    </div>
                    <span class="opacity-75">vs</span>
                    <div class="flex items-center gap-2">
                        <span>{{ $game->away_team }}</span>
                        <span class="w-6 h-6 rounded-full shadow-lg" style="background-color: {{ $game->away_color ?? '#fff' }}"></span>
                    </div>
                </div>
                <p class="text-sm opacity-90 mt-2">📍 {{ $game->venue }} • {{ $game->discipline }} • {{ $game->category }}</p>
            </div>
            <div class="text-right">
                <span class="px-4 py-2 rounded-full font-semibold text-sm {{ $game->status === 'completed' ? 'bg-green-500' : 'bg-yellow-500' }}">
                    {{ $game->status === 'completed' ? '✅ Completed' : '🏃 In Progress' }}
                </span>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.games.update', $game) }}" method="POST" class="bg-white dark:bg-neutral-900 shadow rounded-xl p-8">
        @csrf
        @method('PUT')

        <!-- Match Score Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-emerald-500">
                🏆 Final Score
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Home Team Score -->
                <div class="p-6 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="w-8 h-8 rounded-full shadow-lg" style="background-color: {{ $game->home_color ?? '#1E40AF' }}"></span>
                        <h3 class="font-bold text-xl text-blue-900 dark:text-blue-200">{{ $game->home_team }}</h3>
                    </div>
                    <input type="number" name="home_score" value="{{ $game->home_score ?? '' }}" min="0" class="w-full text-5xl font-bold text-center border-2 border-blue-300 dark:border-blue-700 rounded-lg px-4 py-6 dark:bg-neutral-800 focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="0">
                    @error('home_score')<span class="text-red-600 text-sm mt-2 block">{{ $message }}</span>@enderror
                </div>

                <!-- Away Team Score -->
                <div class="p-6 bg-red-50 dark:bg-red-900/20 rounded-lg">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="w-8 h-8 rounded-full shadow-lg" style="background-color: {{ $game->away_color ?? '#DC2626' }}"></span>
                        <h3 class="font-bold text-xl text-red-900 dark:text-red-200">{{ $game->away_team }}</h3>
                    </div>
                    <input type="number" name="away_score" value="{{ $game->away_score ?? '' }}" min="0" class="w-full text-5xl font-bold text-center border-2 border-red-300 dark:border-red-700 rounded-lg px-4 py-6 dark:bg-neutral-800 focus:ring-2 focus:ring-red-500 focus:border-transparent" placeholder="0">
                    @error('away_score')<span class="text-red-600 text-sm mt-2 block">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <!-- Cards & Disciplinary Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-yellow-500">
                🟨🟥 Cards & Disciplinary Actions
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Yellow Cards Players -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">🟨 Yellow Cards (Players)</label>
                    <select name="yellow_cards_players[]" multiple class="w-full border border-yellow-300 dark:border-yellow-700 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-yellow-500 focus:border-transparent h-32">
                        @foreach($players as $player)
                            <option value="{{ $player->id }}" {{ (in_array($player->id, $game->yellow_cards_players ?? [])) ? 'selected' : '' }}>
                                {{ $player->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl (Cmd on Mac) to select multiple</p>
                    @error('yellow_cards_players')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <!-- Red Cards Players -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">🟥 Red Cards (Players)</label>
                    <select name="red_cards_players[]" multiple class="w-full border border-red-300 dark:border-red-700 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-red-500 focus:border-transparent h-32">
                        @foreach($players as $player)
                            <option value="{{ $player->id }}" {{ (in_array($player->id, $game->red_cards_players ?? [])) ? 'selected' : '' }}>
                                {{ $player->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl (Cmd on Mac) to select multiple</p>
                    @error('red_cards_players')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <!-- Yellow Cards Staff -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">🟨 Yellow Cards (Staff)</label>
                    <select name="yellow_cards_staff[]" multiple class="w-full border border-yellow-300 dark:border-yellow-700 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-yellow-500 focus:border-transparent h-32">
                        @foreach($staffs as $staff)
                            <option value="{{ $staff->id }}" {{ (in_array($staff->id, $game->yellow_cards_staff ?? [])) ? 'selected' : '' }}>
                                {{ $staff->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl (Cmd on Mac) to select multiple</p>
                    @error('yellow_cards_staff')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <!-- Red Cards Staff -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">🟥 Red Cards (Staff)</label>
                    <select name="red_cards_staff[]" multiple class="w-full border border-red-300 dark:border-red-700 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-red-500 focus:border-transparent h-32">
                        @foreach($staffs as $staff)
                            <option value="{{ $staff->id }}" {{ (in_array($staff->id, $game->red_cards_staff ?? [])) ? 'selected' : '' }}>
                                {{ $staff->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl (Cmd on Mac) to select multiple</p>
                    @error('red_cards_staff')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <!-- Match Incidents Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-orange-500">
                ⚠️ Match Incidents
            </h2>
            <textarea name="incidence" rows="5" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-orange-500 focus:border-transparent" placeholder="Describe any significant incidents during the match (injuries, disputes, unusual events, etc.)...">{{ $game->incidence ?? '' }}</textarea>
            @error('incidence')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
        </div>

        <!-- Technical Feedback Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-teal-500">
                📊 Technical Feedback
            </h2>
            <textarea name="technical_feedback" rows="6" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-teal-500 focus:border-transparent" placeholder="Provide technical analysis, team performance notes, areas of improvement, standout players, tactics used, etc...">{{ $game->technical_feedback ?? '' }}</textarea>
            @error('technical_feedback')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
        </div>

        <!-- Submit Buttons -->
        <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-neutral-700">
            <a href="{{ route('admin.games.index') }}" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 font-semibold transition">
                Cancel
            </a>
            <div class="flex gap-4">
                @if($game->status !== 'completed')
                    <button type="submit" name="action" value="save" class="px-8 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-lg font-semibold shadow-lg transition transform hover:scale-105">
                        💾 Save Progress
                    </button>
                    <button type="submit" name="action" value="complete" class="px-8 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white rounded-lg font-semibold shadow-lg transition transform hover:scale-105">
                        ✅ Complete Match
                    </button>
                @else
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg font-semibold shadow-lg transition transform hover:scale-105">
                        ✅ Update Report
                    </button>
                @endif
            </div>
        </div>
    </form>
</div>
@endsection
