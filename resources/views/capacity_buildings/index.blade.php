@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">🏫 In-House Trainings</h1>
        <a href="{{ route('trainings.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">➕ New Training</a>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 dark:bg-slate-700/50 text-slate-600 dark:text-slate-300">
                <tr class="border-b border-slate-200 dark:border-slate-700">
                <th>ID</th>
                <th>Training Name</th>
                <th>Discipline</th>
                <th>Country</th>
                <th>Start</th>
                <th>Branch</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($trainings as $t)
            <tr>
                <td>{{ $t->id }}</td>
                <td>{{ $t->training_name }}</td>
                <td>{{ $t->discipline }}</td>
                <td>{{ $t->country }}</td>
                <td>{{ $t->start }}</td>
                <td>{{ $t->branch->name ?? '' }}</td>

                <td>
                    <a href="{{ route('trainings.show', $t->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('trainings.edit', $t->id) }}" class="btn btn-warning btn-sm">Edit</a>

                    <form action="{{ route('trainings.destroy', $t->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </form>

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $trainings->links() }}
</div>
@endsection
