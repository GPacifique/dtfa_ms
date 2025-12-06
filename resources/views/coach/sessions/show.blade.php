@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <div class="mb-6 flex items-center justify-between gap-2">
        <h1 class="text-3xl font-bold text-slate-900">Session Details</h1>
        <div class="flex gap-2">
            <a href="{{ route('coach.sessions.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition">➕ Schedule New Session</a>
            <a href="{{ url()->previous() }}" class="text-sm underline text-indigo-600 hover:text-indigo-800">← Back</a>
        </div>
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
            @if($session->training_days && count($session->training_days) > 0)
            <div class="py-3 flex justify-between">
                <dt class="font-semibold text-slate-700">Training Days</dt>
                <dd>{{ implode(', ', $session->training_days) }}</dd>
            </div>
            @endif
        </dl>
    </div>
</div>
@endsection
