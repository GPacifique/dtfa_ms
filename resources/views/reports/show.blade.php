@extends('layouts.app')

@section('meta_title', 'Report #'.($report->no ?? $report->id).' — '.config('app.name', 'App'))
@section('meta_description', 'Details for report '.($report->no ?? $report->id).': workstream '.($report->workstream ?? 'N/A').', activity '.($report->activity ?? 'N/A').', status '.($report->status ?? 'N/A').'.')

@section('content')
<div class="container">
    <h1>Report Details</h1>
    <div class="card">
        <div class="card-body">
            <p><strong>No:</strong> {{ $report->no }}</p>
            <p><strong>Workstream:</strong> {{ $report->workstream }}</p>
            <p><strong>Activity:</strong> {{ $report->activity }}</p>
            <p><strong>Status:</strong> {{ $report->status }}</p>
            <p><strong>Comments:</strong> {{ $report->comments }}</p>
        </div>
    </div>
    <a href="{{ route('reports.index') }}" class="btn btn-secondary mt-3">Back to List</a>
</div>
@endsection
