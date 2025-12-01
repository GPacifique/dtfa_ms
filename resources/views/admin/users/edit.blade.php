@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Edit User</h1>
        <div class="flex items-center gap-3">
            <form method="POST" action="{{ route('admin.users.sendReset', $user) }}">
                @csrf
                <button type="submit" class="px-3 py-2 border rounded">Send password reset</button>
            </form>
            <a href="{{ route('admin.users.index') }}" class="text-sm underline">Back to list</a>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.users.updateFull', $user) }}" class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 space-y-4" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Profile Picture Section -->
        <div class="border-b border-slate-200 dark:border-slate-700 pb-4">
            <h3 class="text-sm font-semibold mb-4">Profile Picture</h3>
            <div class="flex items-start gap-4">
                <div>
                    <img src="{{ $user->profile_picture_url }}" alt="{{ $user->name }}" class="w-16 h-16 rounded-full object-cover ring-2 ring-slate-200 dark:ring-slate-700" id="picture-preview">
                </div>
                <div class="flex-1">
                    <input type="file" name="profile_picture" accept="image/*" class="block w-full text-sm text-slate-600 file:mr-3 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 dark:file:bg-blue-900/30 file:text-blue-700 dark:file:text-blue-400" id="picture-input">
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">JPEG, PNG, GIF • Max 2MB</p>
                    @error('profile_picture')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Name</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full border rounded px-3 py-2 dark:bg-neutral-900 dark:border-neutral-700" required>
                @error('name')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full border rounded px-3 py-2 dark:bg-neutral-900 dark:border-neutral-700" required>
                @error('email')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-1">Branch</label>
                <select id="branch_id" name="branch_id" class="w-full border rounded px-3 py-2 dark:bg-neutral-900 dark:border-neutral-700">
                    <option value="">—</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}" @selected(old('branch_id', $user->branch_id) == $branch->id)>{{ $branch->name }}</option>
                    @endforeach
                </select>
                @error('branch_id')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Group</label>
                <select id="group_id" name="group_id" class="w-full border rounded px-3 py-2 dark:bg-neutral-900 dark:border-neutral-700">
                    <option value="">—</option>
                    @foreach ($groups as $group)
                        <option value="{{ $group->id }}" data-branch="{{ $group->branch_id }}" @selected(old('group_id', $user->group_id) == $group->id)>{{ $group->name }}</option>
                    @endforeach
                </select>
                @error('group_id')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Roles</label>
            @php($selectedRoles = old('roles', $user->roles->pluck('name')->all()))
            <select name="roles[]" multiple class="w-full border rounded px-3 py-2 dark:bg-neutral-900 dark:border-neutral-700">
                @foreach ($roles as $role)
                    <option value="{{ $role }}" @selected(collect($selectedRoles ?: ['user'])->contains($role))>{{ ucfirst($role) }}</option>
                @endforeach
            </select>
            @error('roles')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Change Password (optional)</label>
            <input type="password" name="password" class="w-full border rounded px-3 py-2 dark:bg-neutral-900 dark:border-neutral-700" placeholder="Leave empty to keep current">
            @error('password')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex items-center justify-end gap-2">
            <a href="{{ route('admin.users.index') }}" class="px-3 py-2 border rounded">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Save Changes</button>
        </div>
    </form>

    <script>
        const branchSel = document.getElementById('branch_id');
        const groupSel = document.getElementById('group_id');
        const allOptions = Array.from(groupSel.options);
        function filterGroups() {
            const b = branchSel.value;
            const current = '{{ old('group_id', $user->group_id) }}';
            groupSel.innerHTML = '';
            allOptions.forEach(opt => {
                if (!opt.value || opt.dataset.branch === b) {
                    const o = opt.cloneNode(true);
                    if (o.value === current) o.selected = true;
                    groupSel.appendChild(o);
                }
            });
            if (!groupSel.value) { groupSel.selectedIndex = 0; }
        }
        branchSel.addEventListener('change', filterGroups);
        filterGroups();

        // Picture preview on file selection
        const pictureInput = document.getElementById('picture-input');
        const picturePreview = document.getElementById('picture-preview');
        if (pictureInput) {
            pictureInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        picturePreview.src = event.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>
</div>
@endsection
