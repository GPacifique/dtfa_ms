@extends('layouts.app')

@push('hero')
    <x-hero :title="$game->home_team . ' vs ' . $game->away_team" :subtitle="$game->date?->format('l, F d, Y') . ' at ' . ($game->time ?? '')">
        <div class="mt-4">
            <a href="{{ route('admin.games.index') }}" class="btn-secondary">← Back to Matches</a>
            <a href="{{ route('admin.games.edit', $game) }}" class="btn-outline">📝 Update Report</a>
        </div>
    </x-hero>
@endpush

@section('content')
<div class="max-w-7xl mx-auto p-6">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Teams and Scores -->
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Teams & Score</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 rounded-lg border-4" style="border-color: {{ $game->home_color ?? '#3B82F6' }}; background: linear-gradient(135deg, {{ $game->home_color ?? '#3B82F6' }}15, transparent);">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Home Team</h3>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-8 h-8 rounded-full shadow-lg border-2 border-white" style="background-color: {{ $game->home_color ?? '#3B82F6' }}"></span>
                            <span class="font-bold text-lg text-gray-900 dark:text-white">{{ $game->home_team }}</span>
                        </div>
                        <p class="text-5xl font-bold text-gray-900 dark:text-white">{{ $game->home_score ?? '—' }}</p>
                    </div>
                    <div class="p-4 rounded-lg border-4" style="border-color: {{ $game->away_color ?? '#EF4444' }}; background: linear-gradient(135deg, {{ $game->away_color ?? '#EF4444' }}15, transparent);">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Away Team</h3>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-8 h-8 rounded-full shadow-lg border-2 border-white" style="background-color: {{ $game->away_color ?? '#EF4444' }}"></span>
                            <span class="font-bold text-lg text-gray-900 dark:text-white">{{ $game->away_team }}</span>
                        </div>
                        <p class="text-5xl font-bold text-gray-900 dark:text-white">{{ $game->away_score ?? '—' }}</p>
                    </div>
                </div>
            </div>

            <!-- Match Details -->
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Match Details</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Discipline</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $game->discipline }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Category</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $game->category }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Age Group</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $game->age_group }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Gender</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $game->gender }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Venue</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $game->venue ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Location</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $game->city }}, {{ $game->country }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Transport</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $game->transport }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Base</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $game->base ?? '—' }}</p>
                    </div>
                </div>

                @if($game->objective)
                <div class="mt-4 pt-4 border-t border-gray-200 dark:border-neutral-700">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Objective</p>
                    <p class="text-gray-900 dark:text-white">{{ $game->objective }}</p>
                </div>
                @endif
            </div>

            <!-- Times -->
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Schedule</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Match Time</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $game->time }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Departure</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $game->departure_time ?? '—' }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Expected End</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $game->expected_finish_time ?? '—' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Staff -->
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 mb-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-3">Staff</h2>
                @if($game->staff_ids && count($game->staff_ids) > 0)
                <ul class="space-y-2">
                    @foreach($game->staff_ids as $staffId)
                        @php $staff = \App\Models\Staff::find($staffId); @endphp
                        @if($staff)
                        <li class="text-sm text-gray-600 dark:text-gray-400">{{ $staff->name }}</li>
                        @endif
                    @endforeach
                </ul>
                @else
                <p class="text-sm text-gray-500 dark:text-gray-400">No staff assigned</p>
                @endif
                @if($game->notify_staff)
                <p class="text-xs text-green-600 dark:text-green-400 mt-2">✉️ Notifications sent</p>
                @endif
            </div>

            <!-- Players -->
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-3">Players</h2>
                @if($game->player_ids && count($game->player_ids) > 0)
                <ul class="space-y-2">
                    @foreach($game->player_ids as $playerId)
                        @php $player = \App\Models\Player::find($playerId); @endphp
                        @if($player)
                        <li class="text-sm text-gray-600 dark:text-gray-400">{{ $player->name }}</li>
                        @endif
                    @endforeach
                </ul>
                @else
                <p class="text-sm text-gray-500 dark:text-gray-400">No players assigned</p>
                @endif
            </div>
        </div>
    </div>

    @if($game->isCompleted() && ($game->yellow_cards_players || $game->red_cards_players || $game->incidence || $game->technical_feedback))
    <!-- Report Section -->
    <div class="mt-6 bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Match Report</h2>

        @if($game->yellow_cards_players || $game->red_cards_players || $game->yellow_cards_staff || $game->red_cards_staff)
        <div class="grid grid-cols-2 gap-4 mb-6">
            @if($game->yellow_cards_players || $game->yellow_cards_staff)
            <div class="bg-yellow-50 dark:bg-neutral-800 p-4 rounded">
                <h3 class="font-semibold text-yellow-900 dark:text-yellow-200 mb-2">🟡 Yellow Cards</h3>
                @if($game->yellow_cards_players)
                <p class="text-sm font-medium text-yellow-800 dark:text-yellow-300">Players:</p>
                <ul class="text-sm text-yellow-700 dark:text-yellow-400 ml-4">
                    @foreach($game->yellow_cards_players as $playerId)
                        @php $player = \App\Models\Player::find($playerId); @endphp
                        @if($player)
                        <li>{{ $player->name }}</li>
                        @endif
                    @endforeach
                </ul>
                @endif
                @if($game->yellow_cards_staff)
                <p class="text-sm font-medium text-yellow-800 dark:text-yellow-300 mt-2">Staff:</p>
                <ul class="text-sm text-yellow-700 dark:text-yellow-400 ml-4">
                    @foreach($game->yellow_cards_staff as $staffId)
                        @php $staff = \App\Models\Staff::find($staffId); @endphp
                        @if($staff)
                        <li>{{ $staff->name }}</li>
                        @endif
                    @endforeach
                </ul>
                @endif
            </div>
            @endif

            @if($game->red_cards_players || $game->red_cards_staff)
            <div class="bg-red-50 dark:bg-neutral-800 p-4 rounded">
                <h3 class="font-semibold text-red-900 dark:text-red-200 mb-2">🔴 Red Cards</h3>
                @if($game->red_cards_players)
                <p class="text-sm font-medium text-red-800 dark:text-red-300">Players:</p>
                <ul class="text-sm text-red-700 dark:text-red-400 ml-4">
                    @foreach($game->red_cards_players as $playerId)
                        @php $player = \App\Models\Player::find($playerId); @endphp
                        @if($player)
                        <li>{{ $player->name }}</li>
                        @endif
                    @endforeach
                </ul>
                @endif
                @if($game->red_cards_staff)
                <p class="text-sm font-medium text-red-800 dark:text-red-300 mt-2">Staff:</p>
                <ul class="text-sm text-red-700 dark:text-red-400 ml-4">
                    @foreach($game->red_cards_staff as $staffId)
                        @php $staff = \App\Models\Staff::find($staffId); @endphp
                        @if($staff)
                        <li>{{ $staff->name }}</li>
                        @endif
                    @endforeach
                </ul>
                @endif
            </div>
            @endif
        </div>
        @endif

        @if($game->incidence)
        <div class="mb-6">
            <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Incidents/Events</p>
            <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $game->incidence }}</p>
        </div>
        @endif

        @if($game->technical_feedback)
        <div>
            <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Technical Feedback</p>
            <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $game->technical_feedback }}</p>
        </div>
        @endif
    </div>
    @endif
</div>
@endsection
