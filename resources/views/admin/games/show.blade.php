@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6 bg-white rounded shadow">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Match Details</h1>
        <a href="{{ route('admin.games.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded hover:bg-gray-700">Back to Matches</a>
    </div>

    <!-- Basic Info -->
    <div class="grid grid-cols-2 gap-6 mb-6">
        <div>
            <p><strong>Sports Discipline:</strong> {{ $game->discipline }}</p>
            <p><strong>Date:</strong> {{ $game->date }}</p>
            <p><strong>Time:</strong> {{ $game->time }}</p>
            <p><strong>Departure Time:</strong> {{ $game->departure_time ?? '-' }}</p>
            <p><strong>Expected Finish Time:</strong> {{ $game->expected_finish_time ?? '-' }}</p>
        </div>
        <div>
            <p><strong>Game Category:</strong> {{ $game->category }}</p>
            <p><strong>Transport:</strong> {{ $game->transport }}</p>
            <p><strong>Venue:</strong> {{ $game->venue }}</p>
            <p><strong>Age Group:</strong> {{ $game->age_group }}</p>
            <p><strong>Country / City:</strong> {{ $game->country }} / {{ $game->city }}</p>
            <p><strong>Base:</strong> {{ $game->base }}</p>
            <p><strong>Gender:</strong> {{ $game->gender }}</p>
        </div>
    </div>

    <!-- Teams and Scores -->
    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Teams & Score</h2>
        <div class="flex items-center gap-6">
            <div class="flex-1 p-4 bg-gray-100 rounded">
                <h3 class="font-semibold">Home Team</h3>
                <div class="flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full" style="background-color: {{ $game->home_color }}"></span>
                    <span>{{ $game->home_team }}</span>
                </div>
                <p class="mt-2 font-bold text-lg">Score: {{ $game->home_score ?? 0 }}</p>
            </div>
            <div class="flex-1 p-4 bg-gray-100 rounded">
                <h3 class="font-semibold">Away Team</h3>
                <div class="flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full" style="background-color: {{ $game->away_color }}"></span>
                    <span>{{ $game->away_team }}</span>
                </div>
                <p class="mt-2 font-bold text-lg">Score: {{ $game->away_score ?? 0 }}</p>
            </div>
        </div>
    </div>

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
