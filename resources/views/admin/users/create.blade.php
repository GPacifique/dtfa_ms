@extends('layouts.app')

@push('hero')
    <x-hero title="➕ Create New User" subtitle="Add a user and assign roles">
        <div class="mt-4">
            <a href="{{ route('admin.users.index') }}" class="btn-secondary">← Back to Users</a>
        </div>
    </x-hero>
@endpush

@section('content')
<div class="container mx-auto px-6 py-8">

    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-8">
        <form method="POST" action="{{ route('admin.users.store') }}" class="space-y-8">
            @csrf

            <!-- Basic Information Section -->
            <div>
                <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">👤 Basic Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Name *</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
                        @error('name')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Email *</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent" required>
                        @error('email')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <!-- Organization Section -->
            <div>
                <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">🏢 Organization</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Branch</label>
                        <select id="branch_id" name="branch_id" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">— Select Branch —</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" @selected(old('branch_id') == $branch->id)>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                        @error('branch_id')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Group</label>
                        <select id="group_id" name="group_id" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">— Select Group —</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}" data-branch="{{ $group->branch_id }}" @selected(old('group_id') == $group->id)>{{ $group->name }}</option>
                            @endforeach
                        </select>
                        @error('group_id')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>
            </div>

            <!-- Roles Section -->
            <div>
                <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">👥 Roles & Permissions</h2>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">Assign Roles *</label>
                    <select name="roles[]" multiple class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        @foreach ($roles as $role)
                            <option value="{{ $role }}" @selected(collect(old('roles', ['user']))->contains($role))>{{ ucfirst($role) }}</option>
                        @endforeach
                    </select>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">Hold Ctrl/Cmd to select multiple roles</p>
                    @error('roles')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>

            <!-- Security Section -->
            <div>
                <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">🔐 Security</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Password (Optional)</label>
                        <input type="password" name="password" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Leave empty to auto-generate">
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">Auto-generated if left blank</p>
                        @error('password')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="flex items-end">
                        <label class="flex items-center gap-3 cursor-pointer p-4 border border-slate-300 dark:border-slate-600 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition w-full">
                            <input type="checkbox" id="send_reset" name="send_reset" value="1" @checked(old('send_reset')) class="rounded border-slate-300 dark:border-slate-600">
                            <span class="font-semibold text-slate-700 dark:text-slate-300">Send Password Reset Link</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-4 pt-6 border-t border-slate-200 dark:border-slate-700">
                <button type="submit" class="px-8 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg transition">
                    ✓ Create User
                </button>
                <a href="{{ route('admin.users.index') }}" class="px-8 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-semibold rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    const branchSel = document.getElementById('branch_id');
    const groupSel = document.getElementById('group_id');
    const allOptions = Array.from(groupSel.options);
    function filterGroups() {
        const b = branchSel.value;
        groupSel.innerHTML = '';
        allOptions.forEach(opt => {
            if (!opt.value || opt.dataset.branch === b) groupSel.appendChild(opt.cloneNode(true));
        });
        groupSel.selectedIndex = 0;
    }
    branchSel.addEventListener('change', filterGroups);
    filterGroups();
</script>
@endsection
