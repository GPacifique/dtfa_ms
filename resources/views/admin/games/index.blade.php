@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Games</h2>
            <a href="{{ route('admin.games.create') }}" class="btn btn-primary">Schedule Game</a>
        </div>

        <div class="bg-white shadow rounded p-4">
            <table class="w-full table-auto">
                <thead>
                    <tr>
                        <th>When</th>
                        <th>Match</th>
                        <th>Venue</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($games as $game)
                    <tr class="border-t">
                        <td>{{ optional($game->scheduled_at)->format('Y-m-d H:i') ?? 'TBD' }}</td>
                        <td>{{ $game->homeTeam->name }} vs {{ $game->awayTeam->name }}</td>
                        <td>{{ $game->venue }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.games.edit', $game) }}" class="text-indigo-600">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $games->links() }}</div>
    </div>
@endsection
