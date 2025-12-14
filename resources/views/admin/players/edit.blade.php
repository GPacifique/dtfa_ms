@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-semibold mb-4">Edit Player</h2>

        <form action="{{ route('admin.players.update', $player) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>First name</label>
                    <input type="text" name="first_name" class="border p-2 w-full" value="{{ old('first_name', $player->first_name) }}" required>
                    @error('first_name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label>Last name</label>
                    <input type="text" name="last_name" class="border p-2 w-full" value="{{ old('last_name', $player->last_name) }}">
                    @error('last_name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label>Team</label>
                    <select name="team_id" class="border p-2 w-full">
                        <option value="">-- none --</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}" @selected(old('team_id', $player->team_id) == $team->id)>{{ $team->name }}</option>
                        @endforeach
                    </select>
                    @error('team_id')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label>Position</label>
                    <input type="text" name="position" class="border p-2 w-full" value="{{ old('position', $player->position) }}">
                    @error('position')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label>Number</label>
                    <input type="number" name="number" class="border p-2 w-full" value="{{ old('number', $player->number) }}">
                    @error('number')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>
            <div class="mt-4">
                <button class="btn btn-primary">✅Update</button>
                <a href="{{ route('admin.players.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
