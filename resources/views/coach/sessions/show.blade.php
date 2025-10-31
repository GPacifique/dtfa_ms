@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-slate-900">Session Details</h1>
        <a href="{{ route('coach.sessions.index') }}" class="text-sm underline text-indigo-600 hover:text-indigo-800">← Back to Sessions</a>
    </div>
    <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border border-slate-200 dark:border-neutral-700">
        <dl class="divide-y divide-slate-100 dark:divide-neutral-800">
            <div class="py-3 flex justify-between">
                <dt class="font-semibold text-slate-700">Date</dt>
                <dd>{{ $session->date->format('M d, Y') }}</dd>
            </div>
            <div class="py-3 flex justify-between">
                <dt class="font-semibold text-slate-700">Time</dt>
                <dd>{{ $session->start_time }} – {{ $session->end_time }}</dd>
            </div>
            <div class="py-3 flex justify-between">
                <dt class="font-semibold text-slate-700">Location</dt>
                <dd>{{ $session->location }}</dd>
            </div>
            <div class="py-3 flex justify-between">
                <dt class="font-semibold text-slate-700">Group</dt>
                <dd>{{ $session->group->name ?? 'N/A' }}</dd>
            </div>
            <div class="py-3 flex justify-between">
                <dt class="font-semibold text-slate-700">Branch</dt>
                <dd>{{ $session->branch->name ?? 'N/A' }}</dd>
            </div>
        </dl>
    </div>
</div>
@endsection