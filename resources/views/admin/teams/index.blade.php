@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">🏆 Teams</h1>
            <a href="{{ route('admin.teams.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">➕ New Team</a>
        </div>

        <div class="bg-white dark:bg-slate-800 shadow rounded-lg p-4">
            <table class="w-full text-sm">
                <thead>
                    <tr>
                        <th class="text-left">Name</th>
                        <th class="text-left">Players</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($teams as $team)
                    <tr class="border-t">
                        <td>
                            <a href="{{ route('admin.teams.show', $team) }}" class="font-medium text-slate-700">{{ $team->name }}</a>
                        </td>
                        <td>{{ $team->players()->count() }}</td>
                        <td class="text-right">
                            <a href="{{ route('admin.teams.edit', $team) }}" class="text-indigo-600">Edit</a>
                            <form action="{{ route('admin.teams.destroy', $team) }}" method="POST" class="inline ml-3" onsubmit="return confirm('Delete this team? This action cannot be undone.');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $teams->links() }}</div>
    </div>
@endsection
