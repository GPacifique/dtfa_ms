@extends('layouts.app')

@push('hero')
    <x-hero title="Staff Profiles" subtitle="Manage and review staff details">
        <div class="mt-4 flex items-center gap-3">
            <a href="{{ route('staff.create') }}" class="btn-primary">New Staff</a>
            <span class="subtle">Total: {{ $staff->total() ?? count($staff) }}</span>
        </div>
    </x-hero>
@endpush

@section('content')

<div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 mb-6">
    <form method="get" class="flex flex-col sm:flex-row gap-3 items-end">
        <div class="flex-1">
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Search</label>
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by name, email, or phone..." class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
        </div>
        <div>
            <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Branch</label>
            <select name="branch" class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                <option value="">All Branches</option>
                @foreach($staff->pluck('branch')->unique() as $branch)
                    <option value="{{ $branch }}" {{ request('branch') === $branch ? 'selected' : '' }}>{{ $branch }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex gap-2">
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">Search</button>
            <a href="{{ route('staff.index') }}" class="px-6 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition font-medium">Reset</a>
        </div>
    </form>
</div>

<div class="overflow-x-auto bg-white dark:bg-slate-800 rounded-lg shadow p-4">
    <table class="min-w-full text-sm border-collapse">
        <thead class="bg-gray-50 dark:bg-slate-700">
            <tr class="text-left text-gray-600 dark:text-gray-300">
                <th class="p-3 font-medium">Photo</th>
                <th class="p-3 font-medium">Name</th>
                <th class="p-3 font-medium">Branch</th>
                <th class="p-3 font-medium">Discipline</th>
                <th class="p-3 font-medium">Role</th>
                <th class="p-3 font-medium">Email</th>
                <th class="p-3 font-medium">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($staff as $s)
                <tr class="border-t hover:bg-gray-50 dark:hover:bg-slate-700 transition">
                    <td class="p-3"><img src="{{ $s->photo_url }}" alt="{{ $s->first_name }}" class="w-10 h-10 rounded-full object-cover"></td>
                    <td class="p-3 font-semibold">{{ $s->first_name }} {{ $s->last_name }}</td>
                    <td class="p-3">{{ $s->branch }}</td>
                    <td class="p-3">{{ $s->discipline }}</td>
                    <td class="p-3">{{ $s->role_function }}</td>
                    <td class="p-3">{{ $s->email }}</td>
                    <td class="p-3 space-x-2 flex flex-wrap gap-2">
                        <a href="{{ route('staff.show', $s) }}" class="text-gray-600 hover:text-gray-900 font-medium">View</a>
                        <a href="{{ route('staff.edit', $s) }}" class="text-blue-600 hover:underline font-medium">Edit</a>
                        <a href="{{ route('attendances.create', ['staff_id' => $s->id]) }}" class="text-green-600 hover:underline font-medium" title="Record attendance for {{ $s->first_name }}">
                            📋 Attendance
                        </a>
                        <form action="{{ route('staff.destroy', $s) }}" method="POST" class="inline" onsubmit="return confirmDelete()">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:underline font-medium" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $staff->links() }}
    </div>
</div>

@endsection

@section('scripts')
<script>
    function confirmDelete() {
        return confirm('Are you sure you want to delete this staff member?');
    }
</script>
@endsection
