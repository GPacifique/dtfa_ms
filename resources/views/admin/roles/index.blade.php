@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    {{-- Hero Section --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-indigo-600 via-purple-600 to-violet-600 rounded-2xl shadow-2xl mb-6">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2230%22 height=%2230%22 viewBox=%220 0 30 30%22 fill=%22none%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z%22 fill=%22rgba(255,255,255,0.07)%22/%3E%3C/svg%3E')] opacity-50"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-gradient-to-br from-pink-400/30 to-rose-500/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-gradient-to-br from-cyan-400/30 to-blue-500/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>

        <div class="relative z-10 px-6 py-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg">👥 Role & Permission Management</h1>
                <p class="text-white/90 mt-1">Configure user roles and access permissions</p>
            </div>
            <a href="{{ route('admin.roles.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white hover:bg-slate-50 text-indigo-700 font-semibold rounded-xl shadow-lg transition-all duration-200 hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                New Role
            </a>
        </div>
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
