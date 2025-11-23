@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4">In-House Trainings</h2>

    <a href="{{ route('trainings.create') }}" class="btn btn-primary mb-3">
        + Add New Training
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
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
