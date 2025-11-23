@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-semibold mb-4">Edit Game</h2>

        <form action="{{ route('admin.games.update', $game) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>Home Team</label>
                    <select name="home_team_id" class="border p-2 w-full">
                        <option value="">-- select --</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" @if(old('home_team_id', $game->home_team_id) == $team->id) selected @endif>{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Away Team</label>
                    <select name="away_team_id" class="border p-2 w-full">
                        <option value="">-- select --</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" @if(old('away_team_id', $game->away_team_id) == $team->id) selected @endif>{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Venue</label>
                    <input type="text" name="venue" class="border p-2 w-full" value="{{ old('venue', $game->venue) }}">
                </div>
                <div>
                    <label>When</label>
                    <input type="datetime-local" name="scheduled_at" class="border p-2 w-full" value="{{ old('scheduled_at', optional($game->scheduled_at)->format('Y-m-d\TH:i')) }}">
                </div>
            </div>
            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
                <a href="{{ route('admin.games.index') }}" class="ml-2">Cancel</a>
            </div>
        </form>
    </div>
@endsection
