@extends('layouts.app')

@section('hero')
    <x-hero :title="$inhousetraining->training_name" subtitle="Training Details">
        <div class="mt-4 flex gap-2">
            <a href="{{ route('admin.inhousetrainings.index') }}" class="btn-secondary">← {{ __('app.back_to_trainings') }}</a>
            <a href="{{ route('admin.inhousetrainings.edit', $inhousetraining->id) }}" class="btn-primary">Edit</a>
        </div>
    </x-hero>
@endsection

@section('content')
<div class="max-w-4xl mx-auto p-6">

    <div class="bg-white dark:bg-neutral-900 shadow rounded-lg overflow-hidden">
        <!-- Participant Information -->
        <div class="border-b border-gray-200 dark:border-neutral-700 px-6 py-4 bg-gray-50 dark:bg-neutral-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Participant Information</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">First Name</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $inhousetraining->first_name ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Second Name</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $inhousetraining->second_name ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Gender</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $inhousetraining->gender ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Role</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $inhousetraining->role->name ?? '—' }}</p>
            </div>
        </div>

        <!-- Location & Discipline -->
        <div class="border-t border-gray-200 dark:border-neutral-700 px-6 py-4 bg-gray-50 dark:bg-neutral-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Location & Discipline</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Country</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $inhousetraining->country ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">City</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $inhousetraining->city ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Discipline</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $inhousetraining->discipline ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Branch</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $inhousetraining->branch->name ?? '—' }}</p>
            </div>
        </div>

        <!-- Training Details -->
        <div class="border-t border-gray-200 dark:border-neutral-700 px-6 py-4 bg-gray-50 dark:bg-neutral-800">
            <h2 class="text-lg font-semibold text-gray-900 dark:text-white">Training Details</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 p-6">
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Training Category</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">
                    <span class="px-2 py-1 text-sm rounded-full {{ $inhousetraining->training_category === 'In house' ? 'bg-green-100 text-green-800' : 'bg-blue-100 text-blue-800' }}">
                        {{ $inhousetraining->training_category ?? '—' }}
                    </span>
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Cost</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">
                    <span class="px-2 py-1 text-sm rounded-full {{ $inhousetraining->cost === 'Free' ? 'bg-gray-100 text-gray-800' : 'bg-amber-100 text-amber-800' }}">
                        {{ $inhousetraining->cost ?? '—' }}
                    </span>
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Channel</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $inhousetraining->channel ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Training Date</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $inhousetraining->training_date?->format('M d, Y') ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Start Date & Time</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $inhousetraining->start?->format('M d, Y H:i') ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">End Date & Time</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $inhousetraining->end?->format('M d, Y H:i') ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Venue</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $inhousetraining->venue ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Location</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $inhousetraining->location ?? '—' }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-600 dark:text-gray-400">Trainer Name</p>
                <p class="text-lg font-medium text-gray-900 dark:text-white">{{ $inhousetraining->trainer_name ?? '—' }}</p>
            </div>
            <div class="md:col-span-2">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Notes</p>
                <p class="text-gray-900 dark:text-white">{{ $inhousetraining->notes ?? 'No notes available' }}</p>
            </div>
        </div>

        <!-- Timestamps -->
        <div class="border-t border-gray-200 dark:border-neutral-700 px-6 py-4 bg-gray-50 dark:bg-neutral-800">
            <div class="grid grid-cols-2 gap-4 text-sm text-gray-600 dark:text-gray-400">
                <div>
                    <span class="font-medium">Created:</span> {{ $inhousetraining->created_at?->format('M d, Y H:i') ?? '—' }}
                </div>
                <div>
                    <span class="font-medium">Updated:</span> {{ $inhousetraining->updated_at?->format('M d, Y H:i') ?? '—' }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
