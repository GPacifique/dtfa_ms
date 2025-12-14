@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Create Role</h1>

    <form method="POST" action="{{ route('admin.roles.store') }}" class="space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-semibold">Role name</label>
            <input name="name" required class="w-full border rounded px-3 py-2" placeholder="e.g., admin" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.roles.index') }}" class="px-4 py-2 border rounded mr-2">Cancel</a>
            <button class="px-6 py-2 bg-indigo-600 text-white rounded">✅ Save</button>
        </div>
    </form>
</div>
@endsection
