@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-semibold mb-4">Edit Team</h2>

        <form action="{{ route('admin.teams.update', $team) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="block">Name</label>
                <input type="text" name="name" class="border p-2 w-full" value="{{ old('name', $team->name) }}">
            </div>
            <div class="mb-3">
                <label class="block">Description</label>
                <textarea name="description" class="border p-2 w-full">{{ old('description', $team->description) }}</textarea>
            </div>
            <div>
                <button class="btn btn-primary">Save</button>
                <a href="{{ route('admin.teams.index') }}" class="ml-2">Cancel</a>
                <form action="{{ route('admin.teams.destroy', $team) }}" method="POST" class="inline ml-3" onsubmit="return confirm('Delete this team? This action cannot be undone.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600">Delete</button>
                </form>
            </div>
        </form>
    </div>
@endsection
