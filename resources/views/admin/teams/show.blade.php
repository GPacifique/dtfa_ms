
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">{{ $team->name }}</h2>
            <div>
                <a href="{{ route('admin.teams.edit', $team) }}" class="btn btn-secondary mr-2">Edit</a>
                <a href="{{ route('admin.teams.index') }}" class="btn">Back to teams</a>
            </div>
        </div>

        @if($team->description)
            <div class="mb-4 p-4 bg-white shadow rounded">{{ $team->description }}</div>
        @endif

        <div class="bg-white shadow rounded p-4">
            <h3 class="font-semibold mb-2">Players ({{ $team->players->count() }})</h3>
            @if($team->players->isEmpty())
                <p class="text-sm text-slate-500">No players assigned.</p>
            @else
                <ul class="list-disc pl-5">
                    @foreach($team->players as $player)
                        <li>{{ $player->name ?? ($player->first_name . ' ' . ($player->last_name ?? '')) }}</li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
@endsection
