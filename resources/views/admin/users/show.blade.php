@extends('layouts.app')

@section('hero')
    <x-hero :title="$user->name" :subtitle="$user->email">
        <div class="mt-4 flex items-center gap-2">
            <a href="{{ route('user.profile.show', $user) }}" class="btn-outline">👤 View Profile</a>
            <a href="{{ route('admin.users.edit', $user) }}" class="btn-primary">Edit User</a>
            <a href="{{ route('admin.users.index') }}" class="btn-secondary">Back to Users</a>
        </div>
    </x-hero>
@endsection

@section('content')
<div class="max-w-6xl mx-auto p-6">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- User Details -->
        <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4">User Details</h2>
            <div class="space-y-3">
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Name</p>
                    <p class="font-medium">{{ $user->name }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Email</p>
                    <p class="font-medium break-all">{{ $user->email }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Branch</p>
                    <p class="font-medium">{{ $user->branch?->name ?? '—' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Group</p>
                    <p class="font-medium">{{ $user->group?->name ?? '—' }}</p>
                </div>
            </div>
        </div>

        <!-- Roles & Permissions -->
        <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Roles</h2>
            <div class="space-y-2">
                @if ($user->roles->count() > 0)
                    @foreach ($user->roles as $role)
                        <div class="inline-block px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 rounded-full text-sm font-medium">
                            {{ ucfirst($role->name) }}
                        </div>
                    @endforeach
                @else
                    <p class="text-gray-500 dark:text-gray-400">No roles assigned</p>
                @endif
            </div>
        </div>

        <!-- Actions -->
        <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 flex flex-col">
            <h2 class="text-lg font-semibold mb-4">Actions</h2>
            <div class="flex-1 overflow-y-auto space-y-2 max-h-64">
                <form method="POST" action="{{ route('admin.users.sendReset', $user) }}" class="block">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 text-sm">
                        Send Password Reset
                    </button>
                </form>

                <a href="{{ route('admin.users.edit', $user) }}" class="block px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-center text-sm">
                    Edit User
                </a>

                @if ($user->id !== auth()->id())
                    <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Are you sure you want to delete this user?')" class="block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 text-sm">
                            Delete User
                        </button>
                    </form>
                @endif

                <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 border rounded hover:bg-gray-100 dark:hover:bg-neutral-800 text-center text-sm">
                    Back to Users
                </a>
            </div>
        </div>
    </div>

    <!-- Activity Section (Optional) -->
    @if (method_exists($user, 'auditLogs'))
        <div class="mt-6 bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold mb-4">Recent Activity</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="border-b dark:border-neutral-700">
                        <tr>
                            <th class="text-left py-2">Event</th>
                            <th class="text-left py-2">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user->auditLogs()->latest()->limit(10)->get() as $log)
                            <tr class="border-b dark:border-neutral-700">
                                <td class="py-2">{{ $log->event }}</td>
                                <td class="py-2">{{ $log->created_at->format('M d, Y H:i') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="py-2 text-gray-500 dark:text-gray-400">No activity recorded</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
