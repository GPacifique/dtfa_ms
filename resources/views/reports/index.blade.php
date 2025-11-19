@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reports</h1>
    <div class="mb-3 d-flex gap-2">
        <a href="{{ route('reports.create') }}" class="btn btn-primary">Add Report</a>
        <a href="{{ route('reports.export.pdf') }}" class="btn btn-secondary">Export PDF</a>
        @auth
            <a href="{{ route('reports.export.pdf.me') }}" class="btn btn-secondary">Export My PDF</a>
        @endauth
    </div>
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
