@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Report</h1>
    <form action="{{ route('reports.update', $report->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>No</label>
            <input type="number" name="no" class="form-control" value="{{ old('no', $report->no) }}" required>
        </div>
        <div class="mb-3">
            <label>Workstream</label>
            <select name="workstream" class="form-control" required>
                <option value="SPORTING" {{ $report->workstream == 'SPORTING' ? 'selected' : '' }}>Sporting</option>
                <option value="BUSINESS" {{ $report->workstream == 'BUSINESS' ? 'selected' : '' }}>Business</option>
                <option value="ADMINISTRATION" {{ $report->workstream == 'ADMINISTRATION' ? 'selected' : '' }}>Administration</option>
                <option value="TECHNOLOGY" {{ $report->workstream == 'TECHNOLOGY' ? 'selected' : '' }}>Technology</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Activity</label>
            <input type="text" name="activity" class="form-control" value="{{ old('activity', $report->activity) }}" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="RED" {{ $report->status == 'RED' ? 'selected' : '' }}>Red</option>
                <option value="YELLOW" {{ $report->status == 'YELLOW' ? 'selected' : '' }}>Yellow</option>
                <option value="GREEN" {{ $report->status == 'GREEN' ? 'selected' : '' }}>Green</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Comments</label>
            <textarea name="comments" class="form-control">{{ old('comments', $report->comments) }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
