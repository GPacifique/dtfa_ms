@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-semibold mb-4">Schedule Game</h2>

        <form action="{{ route('admin.games.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>Home Team</label>
                    <select name="home_team_id" class="border p-2 w-full">
                        <option value="">-- select --</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Away Team</label>
                    <select name="away_team_id" class="border p-2 w-full">
                        <option value="">-- select --</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Venue</label>
                    <input type="text" name="venue" class="border p-2 w-full" value="{{ old('venue') }}">
                </div>
                <div>
                    <label>When</label>
                    <input type="datetime-local" name="scheduled_at" class="border p-2 w-full" value="{{ old('scheduled_at') }}">
                </div>
            </div>
            <div class="mt-4">
                <button class="btn btn-primary">Schedule</button>
            </div>
        </form>
    </div>
@endsection
