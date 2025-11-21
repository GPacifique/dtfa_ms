@extends('layouts.app-sidebar')

@section('content')
    <div class="flex items-center justify-between">
        <h2 class="text-xl font-semibold">Staff Profiles</h2>
        <a href="{{ route('staff.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded">New Staff</a>
    </div>

    <div class="mt-6 bg-white dark:bg-slate-800 rounded shadow p-4">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-slate-600 dark:text-slate-300">
                    <th class="p-2">Name</th>
                    <th class="p-2">Branch</th>
                    <th class="p-2">Discipline</th>
                    <th class="p-2">Role</th>
                    <th class="p-2">Email</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staff as $s)
                    <tr class="border-t">
                        <td class="p-2">{{ $s->first_name }} {{ $s->last_name }}</td>
                        <td class="p-2">{{ $s->branch }}</td>
                        <td class="p-2">{{ $s->discipline }}</td>
                        <td class="p-2">{{ $s->role_function }}</td>
                        <td class="p-2">{{ $s->email }}</td>
                        <td class="p-2">
                            <a href="{{ route('staff.show', $s) }}" class="text-slate-600 hover:text-slate-900 mr-3">View</a>
                            <a href="{{ route('staff.edit', $s) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('staff.destroy', $s) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 ml-2" type="submit" onclick="return confirm('Delete?')">Delete</button>
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
