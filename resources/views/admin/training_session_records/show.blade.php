@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-semibold">Training Session Details</h2>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.training_session_records.index') }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md text-sm">Back</a>
            <a href="{{ route('admin.training_session_records.edit', $trainingSessionRecord) }}" class="inline-flex items-center px-3 py-1.5 border border-yellow-300 rounded-md text-sm">Edit</a>
        </div>
    </div>

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 sm:p-6">
            <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                <div>
                    <dt class="text-sm font-medium text-gray-500">Date</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ optional($trainingSessionRecord->date)->format('Y-m-d') ?? $trainingSessionRecord->date }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Time</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $trainingSessionRecord->start_time }} — {{ $trainingSessionRecord->finish_time }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Coach</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $trainingSessionRecord->coach_name }}</dd>
                </div>
                <div>
                    <dt class="text-sm font-medium text-gray-500">Branch / Pitch</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $trainingSessionRecord->branch }} — {{ $trainingSessionRecord->training_pitch }} @if($trainingSessionRecord->other_training_pitch) ({{ $trainingSessionRecord->other_training_pitch }}) @endif</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Country / City</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $trainingSessionRecord->country }} — {{ $trainingSessionRecord->city }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Sport Discipline</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $trainingSessionRecord->sport_discipline }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Training Objective</dt>
                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $trainingSessionRecord->training_objective }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Main Topic</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $trainingSessionRecord->main_topic }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Area of Performance</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $trainingSessionRecord->area_performance }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Part 1 — Activities / Notes</dt>
                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $trainingSessionRecord->part1_activities }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Part 2 — Activities / Notes</dt>
                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $trainingSessionRecord->part2_activities }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Part 3 — Notes</dt>
                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $trainingSessionRecord->part3_notes }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Part 4 — Message</dt>
                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $trainingSessionRecord->part4_message }}</dd>
                </div>

                <div>
                    <dt class="text-sm font-medium text-gray-500">Number of Kids</dt>
                    <dd class="mt-1 text-sm text-gray-900">{{ $trainingSessionRecord->number_of_kids }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Incident Report</dt>
                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $trainingSessionRecord->incident_report }}</dd>
                </div>

                <div class="sm:col-span-2">
                    <dt class="text-sm font-medium text-gray-500">Missed / Damaged Equipment</dt>
                    <dd class="mt-1 text-sm text-gray-900 whitespace-pre-wrap">{{ $trainingSessionRecord->missed_damaged_equipment }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>
@endsection
