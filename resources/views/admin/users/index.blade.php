@extends('layouts.app')

@section('hero')
    <x-hero title="User Role Management" subtitle="Manage roles, status, and access">
        <div class="mt-4 flex items-center gap-2">
            <x-button :href="route('admin.users.create')" variant="primary">New User</x-button>
        </div>
    </x-hero>
@endsection

@section('content')
<div class="container-page">

    <div class="mb-4">
        <form method="GET" class="flex flex-wrap items-end gap-3">
            <div>
                <label class="label mb-1">Search</label>
                <input type="text" name="q" value="{{ $q ?? '' }}" placeholder="Name or email" class="input" />
            </div>
            <div>
                <label class="label mb-1">Role</label>
                <select name="role" class="select">
                    <option value="">All</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role }}" @selected(($roleFilter ?? '') === $role)>{{ ucfirst($role) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="ml-auto flex items-center gap-2">
                <x-button :href="route('admin.users.create')" variant="primary">New User</x-button>
                <x-button type="submit" variant="outline">Filter</x-button>
            </div>
        </form>
    </div>

    <div class="card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table w-full whitespace-nowrap">
                <thead>
                    <tr>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Branch</th>
                        <th>Group</th>
                        <th>Roles</th>
                        <th>Status</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr onclick="window.location='{{ route('admin.users.edit', $user) }}'" class="cursor-pointer hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors {{ $user->deleted_at ? 'bg-red-50 dark:bg-red-900/20' : '' }}">
                            <td class="px-4 py-3">
                                <img src="{{ $user->profile_picture_url }}" alt="{{ $user->name }}" class="w-10 h-10 rounded-full object-cover ring-1 ring-slate-200 dark:ring-slate-700">
                            </td>
                            <td class="px-4 py-3 font-medium text-slate-900 dark:text-white">
                                {{ $user->name }}
                            </td>
                            <td class="px-4 py-3 text-slate-600 dark:text-slate-400">
                                {{ $user->email }}
                            </td>
                            <td class="px-4 py-3 text-slate-600 dark:text-slate-400">
                                {{ $user->branch?->name ?? '—' }}
                            </td>
                            <td class="px-4 py-3 text-slate-600 dark:text-slate-400">
                                {{ $user->group?->name ?? '—' }}
                            </td>
                            <td class="px-4 py-3" onclick="event.stopPropagation()">
                                <form method="POST" action="{{ route('admin.users.update', $user) }}" class="flex items-center gap-3">
                                    @csrf
                                    @method('PATCH')
                                    <select name="roles[]" multiple class="select w-64 min-w-[200px]" @disabled($user->deleted_at)>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}" @selected($user->roles->pluck('name')->contains($role))>{{ ucfirst($role) }}</option>
                                        @endforeach
                                    </select>
                                    <x-button type="submit" variant="primary" size="sm" :disabled="$user->deleted_at">Save</x-button>
                                </form>
                            </td>
                            <td class="px-4 py-3">
                                @if($user->deleted_at)
                                    <span class="badge badge-red">Deactivated</span>
                                @else
                                    <span class="badge badge-green">Active</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right" onclick="event.stopPropagation()">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" @class(['text-indigo-600 hover:text-indigo-900 font-medium','opacity-50 pointer-events-none' => $user->deleted_at])>Edit</a>

                                    <form method="POST" action="{{ route('admin.users.sendReset', $user) }}" class="inline">
                                        @csrf
                                        <button class="text-slate-600 hover:text-slate-900 text-sm" type="submit" @disabled($user->deleted_at) title="Send Password Reset">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                                            </svg>
                                        </button>
                                    </form>

                                    @if(!$user->deleted_at)
                                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" class="inline" onsubmit="return confirm('Deactivate this user?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:text-red-900" type="submit" title="Deactivate">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636" />
                                                </svg>
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.users.restore', $user->id) }}" class="inline">
                                            @csrf
                                            <button class="text-green-600 hover:text-green-900" type="submit" title="Restore">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                                                </svg>
                                            </button>
                                        </form>
                                        <form method="POST" action="{{ route('admin.users.forceDelete', $user->id) }}" class="inline" onsubmit="return confirm('Permanently delete this user? This cannot be undone.');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:text-red-900" type="submit" title="Delete permanently">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
