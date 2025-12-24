@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">⚽ Players</h1>
            <a href="{{ route('admin.players.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">➕ New Player</a>
        </div>

        <div class="bg-white dark:bg-slate-800 shadow rounded-lg p-4">
            <table class="w-full text-sm">
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
