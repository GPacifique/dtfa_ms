@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4">
        <h2 class="text-xl font-semibold mb-4">Create Team</h2>

        <form action="{{ route('admin.teams.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="block">Name</label>
                <input type="text" name="name" class="border p-2 w-full" value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label class="block">Description</label>
                <textarea name="description" class="border p-2 w-full">{{ old('description') }}</textarea>
            </div>
            <div>
                <button class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection
