@extends('layouts.app')

@section('hero')
    <x-hero title="Session Details" subtitle="Review session schedule and info">
        <a href="{{ route('coach.sessions.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition">➕ Schedule New Session</a>

    </x-hero>
@endsection

@section('content')
<div class="max-w-2xl mx-auto p-6">

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
