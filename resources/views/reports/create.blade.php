@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add Report</h1>
    <form action="{{ route('reports.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>No (Auto-generated)</label>
            <input type="number" name="no" class="form-control" value="{{ $nextNo }}" readonly>
        </div>
        <div class="mb-3">
            <label>Workstream</label>
            <select name="workstream" class="form-control" required>
                <option value="">Select</option>
                <option value="SPORTING">Sporting</option>
                <option value="BUSINESS">Business</option>
                <option value="ADMINISTRATION">Administration</option>
                <option value="TECHNOLOGY">Technology</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Activity</label>
            <input type="text" name="activity" class="form-control" value="{{ old('activity') }}" required>
        </div>
        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="">Select</option>
                <option value="RED">Red</option>
                <option value="YELLOW">Yellow</option>
                <option value="GREEN">Green</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Comments</label>
            <textarea name="comments" class="form-control">{{ old('comments') }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('reports.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
