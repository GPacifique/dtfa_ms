@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $game->home_team }} vs {{ $game->away_team }}</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $game->date?->format('l, F d, Y') }} at {{ $game->time }}</p>
        </div>
        <a href="{{ route('admin.games.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-800 font-medium">Back to Matches</a>
    </div>

    <!-- Status Badge and Actions -->
    <div class="mb-6 p-4 rounded-lg {{ $game->status === 'scheduled' ? 'bg-blue-50 dark:bg-blue-900' : ($game->status === 'in_progress' ? 'bg-yellow-50 dark:bg-yellow-900' : 'bg-green-50 dark:bg-green-900') }}">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-gray-900 dark:text-white">Match Status</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    @if($game->status === 'scheduled')
                        📅 Ready to start - Click "Start Match" when ready
                    @elseif($game->status === 'in_progress')
                        🏃 Currently in progress - Record events and results
                    @else
                        ✅ Match completed
                    @endif
                </p>
            </div>
            <div class="flex items-center gap-3">
                <span class="px-4 py-2 rounded-full font-semibold {{ $game->status === 'scheduled' ? 'bg-blue-200 text-blue-800' : ($game->status === 'in_progress' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800') }}">
                    {{ ucfirst(str_replace('_', ' ', $game->status)) }}
                </span>

                @if($game->isScheduled())
                <form action="{{ route('admin.games.start', $game) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 font-medium transition">
                        🏃 Start Match
                    </button>
                </form>
                @elseif($game->isInProgress())
                <a href="{{ route('admin.games.edit', $game) }}" class="px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 font-medium transition">
                    📝 Record Results
                </a>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Teams and Scores -->
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Teams & Score</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-50 dark:bg-neutral-800 rounded-lg">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Home Team</h3>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-6 h-6 rounded-full" style="background-color: {{ $game->home_color ?? '#ccc' }}"></span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $game->home_team }}</span>
                        </div>
                        <p class="text-4xl font-bold text-gray-900 dark:text-white">{{ $game->home_score ?? '—' }}</p>
                    </div>
                    <div class="p-4 bg-gray-50 dark:bg-neutral-800 rounded-lg">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2">Away Team</h3>
                        <div class="flex items-center gap-2 mb-3">
                            <span class="w-6 h-6 rounded-full" style="background-color: {{ $game->away_color ?? '#ccc' }}"></span>
                            <span class="font-medium text-gray-900 dark:text-white">{{ $game->away_team }}</span>
                        </div>
                        <p class="text-4xl font-bold text-gray-900 dark:text-white">{{ $game->away_score ?? '—' }}</p>
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

    <!-- Objectives -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Objective of the Match/Game</h2>
        <p>{{ $game->objective ?? '-' }}</p>
    </div>

    <!-- Staff & Notifications -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Staff Involved</h2>
        <ul class="list-disc pl-5">
            @foreach($game->staff_ids ?? [] as $staffId)
                @php
                    $staff = \App\Models\Staff::find($staffId);
                @endphp
                <li>{{ $staff->name ?? 'Deleted Staff' }}</li>
            @endforeach
        </ul>
        <p class="mt-2"><strong>Email Notifications Sent:</strong> {{ $game->notify_staff ? 'Yes' : 'No' }}</p>
    </div>

    <!-- Players -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Players Involved</h2>
        <ul class="list-disc pl-5">
            @foreach($game->player_ids ?? [] as $playerId)
                @php
                    $player = \App\Models\Player::find($playerId);
                @endphp
                <li>{{ $player->name ?? 'Deleted Player' }}</li>
            @endforeach
        </ul>
    </div>

    <!-- Discipline -->
    <div class="mb-6 grid grid-cols-2 gap-6">
        <div class="bg-red-50 p-4 rounded">
            <h3 class="font-semibold mb-2">Player Discipline</h3>
            <p><strong>Yellow Cards:</strong></p>
            <ul class="list-disc pl-5">
                @foreach($game->yellow_cards_players ?? [] as $playerId)
                    @php $player = \App\Models\Player::find($playerId); @endphp
                    <li>{{ $player->name ?? 'Deleted Player' }}</li>
                @endforeach
            </ul>
            <p class="mt-2"><strong>Red Cards:</strong></p>
            <ul class="list-disc pl-5">
                @foreach($game->red_cards_players ?? [] as $playerId)
                    @php $player = \App\Models\Player::find($playerId); @endphp
                    <li>{{ $player->name ?? 'Deleted Player' }}</li>
                @endforeach
            </ul>
        </div>

        <div class="bg-red-50 p-4 rounded">
            <h3 class="font-semibold mb-2">Staff Discipline</h3>
            <p><strong>Yellow Cards:</strong></p>
            <ul class="list-disc pl-5">
                @foreach($game->yellow_cards_staff ?? [] as $staffId)
                    @php $staff = \App\Models\Staff::find($staffId); @endphp
                    <li>{{ $staff->name ?? 'Deleted Staff' }}</li>
                @endforeach
            </ul>
            <p class="mt-2"><strong>Red Cards:</strong></p>
            <ul class="list-disc pl-5">
                @foreach($game->red_cards_staff ?? [] as $staffId)
                    @php $staff = \App\Models\Staff::find($staffId); @endphp
                    <li>{{ $staff->name ?? 'Deleted Staff' }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Incidents & Technical Feedback -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Incidence</h2>
        <p>{{ $game->incidence ?? '-' }}</p>
    </div>

    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Technical Feedback</h2>
        <p>{{ $game->technical_feedback ?? '-' }}</p>
    </div>
</div>
@endsection
