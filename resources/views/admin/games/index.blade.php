@extends('layouts.app')

@section('content')
<h1>Matches</h1>
<a href="{{ route('admin.games.create') }}" class="btn btn-primary">Create New Match</a>

<table class="table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Discipline</th>
            <th>Home Team</th>
            <th>Away Team</th>
            <th>Score</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($games as $game)
        <tr>
            <td>{{ $game->date }}</td>
            <td>{{ $game->discipline }}</td>
            <td>{{ $game->home_team }}</td>
            <td>{{ $game->away_team }}</td>
            <td>{{ $game->home_score ?? '-' }} - {{ $game->away_score ?? '-' }}</td>
            <td>
                <a href="{{ route('admin.games.show', $game) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('admin.games.edit', $game) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.games.destroy', $game) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete match?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $games->links() }}
@endsection
