@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">👥 Role & Permission Management</h1>
        <a href="{{ route('admin.roles.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">➕ New Role</a>
    </div>

    @if(session('status'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('status') }}</div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="card p-4">
            <h2 class="font-semibold mb-3">Roles</h2>
            <ul class="space-y-2">
                @foreach($roles as $role)
                    <li class="flex items-center justify-between">
                        <div>{{ $role->name }}</div>
                        <div><a href="{{ route('admin.roles.edit', $role) }}" class="text-sm text-indigo-600 hover:underline">Edit Permissions</a></div>
                    </li>
                @endforeach
            </ul>
        </div>

        <div class="card p-4">
            <h2 class="font-semibold mb-3">Permissions</h2>
            <form method="POST" action="{{ route('admin.permissions.store') }}" class="mb-4">
                @csrf
                <div class="flex gap-2">
                    <input name="name" placeholder="permission.name" required class="flex-1 border rounded px-3 py-2" />
                    <button class="px-4 py-2 bg-indigo-600 text-white rounded">Add</button>
                </div>
            </form>

            <div class="grid grid-cols-1 gap-2">
                @foreach($permissions as $p)
                    <div class="text-sm text-slate-700">{{ $p->name }}</div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
