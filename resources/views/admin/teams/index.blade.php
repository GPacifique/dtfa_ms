@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold">Teams</h2>
            <a href="{{ route('admin.teams.create') }}" class="btn btn-primary">New Team</a>
        </div>

        <div class="bg-white shadow rounded p-4">
            <table class="w-full table-auto">
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
