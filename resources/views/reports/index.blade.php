@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reports</h1>
    <a href="{{ route('reports.create') }}" class="btn btn-primary mb-3">Add Report</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Workstream</th>
                <th>Activity</th>
                <th>Status</th>
                <th>Comments</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reports as $report)
            <tr>
                <td>{{ $report->no }}</td>
                <td>{{ $report->workstream }}</td>
                <td>{{ $report->activity }}</td>
                <td>{{ $report->status }}</td>
                <td>{{ $report->comments }}</td>
                <td>
                    <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('reports.destroy', $report->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
