@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Players</h2>
            <a href="{{ route('admin.players.create') }}" class="btn btn-primary">New Player</a>
        </div>

        <div class="bg-white shadow rounded p-4">
            <table class="w-full table-auto">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Team</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($players as $player)
                    <tr class="border-t">
                        <td>{{ $player->first_name }} {{ $player->last_name }}</td>
                        <td>{{ optional($player->team)->name }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.players.edit', $player) }}" class="text-indigo-600">Edit</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $players->links() }}</div>
    </div>
@endsection
