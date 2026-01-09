@extends('layouts.app')

@push('hero')
    <x-hero title="Training Session Details" subtitle="View session record information" gradient="emerald">
        <div class="flex gap-2">
            <a href="{{ route('training_sessions.edit', $record) }}" class="inline-flex items-center px-3 py-1.5 bg-white/20 hover:bg-white/30 rounded-md text-sm text-white transition">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Edit
            </a>
            <a href="{{ route('training_sessions.index') }}" class="inline-flex items-center px-3 py-1.5 border border-white/30 rounded-md text-sm text-white hover:bg-white/10">← Back</a>
        </div>
    </x-hero>
@endpush

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="bg-white dark:bg-slate-800 rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Session Information</h2>
        </div>

        <dl class="divide-y divide-gray-200 dark:divide-gray-700">
            <div class="px-6 py-4 grid grid-cols-3 gap-4">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Date</dt>
                <dd class="text-sm text-gray-900 dark:text-white col-span-2">{{ optional($record->date)->format('F j, Y') ?? $record->date ?? '—' }}</dd>
            </div>

            <div class="px-6 py-4 grid grid-cols-3 gap-4">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Time</dt>
                <dd class="text-sm text-gray-900 dark:text-white col-span-2">{{ $record->start_time ?? '—' }} - {{ $record->finish_time ?? '—' }}</dd>
            </div>

            <div class="px-6 py-4 grid grid-cols-3 gap-4">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Coach</dt>
                <dd class="text-sm text-gray-900 dark:text-white col-span-2">{{ $record->coach_name ?? ($record->coach->name ?? '—') }}</dd>
            </div>

            <div class="px-6 py-4 grid grid-cols-3 gap-4">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Branch</dt>
                <dd class="text-sm text-gray-900 dark:text-white col-span-2">{{ $record->branch ?? '—' }}</dd>
            </div>

            <div class="px-6 py-4 grid grid-cols-3 gap-4">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Training Pitch</dt>
                <dd class="text-sm text-gray-900 dark:text-white col-span-2">{{ $record->training_pitch ?? '—' }}</dd>
            </div>

            <div class="px-6 py-4 grid grid-cols-3 gap-4">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Sport Discipline</dt>
                <dd class="text-sm text-gray-900 dark:text-white col-span-2">{{ $record->sport_discipline ?? '—' }}</dd>
            </div>

            <div class="px-6 py-4 grid grid-cols-3 gap-4">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Location</dt>
                <dd class="text-sm text-gray-900 dark:text-white col-span-2">{{ $record->city ?? '—' }}, {{ $record->country ?? '—' }}</dd>
            </div>

            @if($record->main_topic)
            <div class="px-6 py-4 grid grid-cols-3 gap-4">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Main Topic</dt>
                <dd class="text-sm text-gray-900 dark:text-white col-span-2">{{ $record->main_topic }}</dd>
            </div>
            @endif

            @if($record->training_objective)
            <div class="px-6 py-4 grid grid-cols-3 gap-4">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Training Objective</dt>
                <dd class="text-sm text-gray-900 dark:text-white col-span-2">{{ $record->training_objective }}</dd>
            </div>
            @endif

            @if($record->number_of_kids)
            <div class="px-6 py-4 grid grid-cols-3 gap-4">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Number of Kids</dt>
                <dd class="text-sm text-gray-900 dark:text-white col-span-2">{{ $record->number_of_kids }}</dd>
            </div>
            @endif

            @if($record->comments)
            <div class="px-6 py-4 grid grid-cols-3 gap-4">
                <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Comments</dt>
                <dd class="text-sm text-gray-900 dark:text-white col-span-2">{{ $record->comments }}</dd>
            </div>
            @endif
        </dl>

        <div class="px-6 py-4 bg-gray-50 dark:bg-slate-700/50 flex gap-3">
            <a href="{{ route('training_sessions.edit', $record) }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-md font-medium transition">
                Edit Record
            </a>
            <form action="{{ route('training_sessions.destroy', $record) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this record?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-md font-medium transition">
                    Delete
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
