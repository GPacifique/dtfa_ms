@extends('layouts.app')

@section('content')
<div class="flex flex-col md:flex-row items-center justify-between mb-6">
    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Staff Profiles</h2>
    <a href="{{ route('staff.create') }}" class="mt-3 md:mt-0 px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow transition">
        New Staff
    </a>
</div>

<div class="overflow-x-auto bg-white dark:bg-slate-800 rounded-lg shadow p-4">
    <table class="min-w-full text-sm border-collapse">
        <thead class="bg-gray-50 dark:bg-slate-700">
            <tr class="text-left text-gray-600 dark:text-gray-300">
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
                    <td class="p-3">{{ $s->first_name }} {{ $s->last_name }}</td>
                    <td class="p-3">{{ $s->branch }}</td>
                    <td class="p-3">{{ $s->discipline }}</td>
                    <td class="p-3">{{ $s->role_function }}</td>
                    <td class="p-3">{{ $s->email }}</td>
                    <td class="p-3 space-x-2">
                        <a href="{{ route('staff.show', $s) }}" class="text-gray-600 hover:text-gray-900 font-medium">View</a>
                        <a href="{{ route('staff.edit', $s) }}" class="text-blue-600 hover:underline font-medium">Edit</a>
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
