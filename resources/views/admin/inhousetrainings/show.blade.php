@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $training->training_name }}</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">Training Details</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.inhousetrainings.edit', $training->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition">Edit</a>
            <a href="{{ route('admin.inhousetrainings.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-800 font-medium">Back</a>
        </div>
    </div>

    <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">First Name</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $training->first_name ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Discipline</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $training->discipline ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Country</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $training->country ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Start Date</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $training->start?->format('M d, Y H:i') ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">End Date</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $training->end?->format('M d, Y H:i') ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Branch</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $training->branch->name ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Venue</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $training->venue ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Location</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $training->location ?? '—' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
