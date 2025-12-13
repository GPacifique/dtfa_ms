@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-semibold mb-4">Create Player</h2>

        <form action="{{ route('admin.players.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label>First name</label>
                    <input type="text" name="first_name" class="border p-2 w-full" value="{{ old('first_name') }}">
                </div>
                <div>
                    <label>Last name</label>
                    <input type="text" name="last_name" class="border p-2 w-full" value="{{ old('last_name') }}">
                </div>
                <div>
                    <label>Team</label>
                    <select name="team_id" class="border p-2 w-full">
                        <option value="">-- none --</option>
                        @foreach($teams as $team)
                            <option value="{{ $team->id }}">{{ $team->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label>Number</label>
                    <input type="number" name="number" class="border p-2 w-full" value="{{ old('number') }}">
                </div>
            </div>
            <div class="mt-4">
                <button class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection
