@extends('layouts.app')
@php($title = 'Session Details')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="card">
        <div class="card-body">
            <h2 class="text-xl font-bold mb-2">Session Details</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <div class="text-sm text-slate-500">Date</div>
                    <div class="font-medium">{{ $session->date->format('M d, Y') }}</div>
                </div>
                <div>
                    <div class="text-sm text-slate-500">Time</div>
                    <div class="font-medium">{{ $session->start_time }} — {{ $session->end_time }}</div>
                </div>
                <div>
                    <div class="text-sm text-slate-500">Branch</div>
                    <div class="font-medium">{{ $session->branch->name ?? 'N/A' }}</div>
                </div>
                <div>
                    <div class="text-sm text-slate-500">Group</div>
                    <div class="font-medium">{{ $session->group->name ?? $session->group_name ?? 'N/A' }}</div>
                </div>
                <div>
                    <div class="text-sm text-slate-500">Coach</div>
                    <div class="font-medium">{{ $session->coach->name ?? 'TBD' }}</div>
                </div>
                <div>
                    <div class="text-sm text-slate-500">Location</div>
                    <div class="font-medium">{{ $session->location ?? '' }}</div>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('admin.sessions.index') }}" class="text-sm text-slate-600">Back to sessions</a>
            </div>
        </div>
    </div>
</div>
@endsection
