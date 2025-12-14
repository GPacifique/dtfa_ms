@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Edit Role: {{ $role->name }}</h1>

    <form method="POST" action="{{ route('admin.roles.update', $role) }}" class="space-y-4">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @foreach($permissions as $perm)
                <label class="flex items-center gap-2">
                    <input type="checkbox" name="permissions[]" value="{{ $perm->name }}" @checked(in_array($perm->name, $rolePermissions)) />
                    <span class="text-sm">{{ $perm->name }}</span>
                </label>
            @endforeach
        </div>

        <div class="flex justify-end">
            <a href="{{ route('admin.roles.index') }}" class="px-4 py-2 border rounded mr-2">Back</a>
            <button class="px-6 py-2 bg-indigo-600 text-white rounded">✅Save</button>
        </div>
    </form>
</div>
@endsection
