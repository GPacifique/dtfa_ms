@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <!-- Header Section -->
    <div class="mb-6">
        <div class="flex items-center justify-between mb-3">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $activityPlan->challenge }}</h1>
                <p class="text-gray-600 dark:text-gray-400 mt-2">{{ $activityPlan->year }} • {{ $activityPlan->country }}</p>
            </div>
            <span class="px-4 py-2 rounded-full font-semibold text-lg {{ $activityPlan->status === 'red' ? 'bg-red-200 text-red-800 dark:bg-red-900 dark:text-red-200' : ($activityPlan->status === 'yellow' ? 'bg-yellow-200 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : 'bg-green-200 text-green-800 dark:bg-green-900 dark:text-green-200') }}">
                {{ $activityPlan->status === 'red' ? '🔴 Not Achieved' : ($activityPlan->status === 'yellow' ? '🟡 Ongoing' : '🟢 Achieved') }}
            </span>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="mb-6 flex flex-wrap gap-2">
        @if($activityPlan->status !== 'red')
            <form action="{{ route('admin.activity-plans.markNotAchieved', $activityPlan) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition">
                    🔴 Mark as Not Achieved
                </button>
            </form>
        @endif

        @if($activityPlan->status !== 'yellow')
            <form action="{{ route('admin.activity-plans.markOngoing', $activityPlan) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg font-medium transition">
                    🟡 Mark as Ongoing
                </button>
            </form>
        @endif

        @if($activityPlan->status !== 'green')
            <form action="{{ route('admin.activity-plans.markAchieved', $activityPlan) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition">
                    🟢 Mark as Achieved
                </button>
            </form>
        @endif

        <a href="{{ route('admin.activity-plans.edit', $activityPlan) }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">
            ✏️ Edit Plan
        </a>

        <form action="{{ route('admin.activity-plans.destroy', $activityPlan) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition" onclick="return confirm('Are you sure?')">
                🗑️ Delete Plan
            </button>
        </form>

        <a href="{{ route('admin.activity-plans.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 dark:text-gray-300 dark:border-neutral-700 rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-800 font-medium transition">
            ← Back to Plans
        </a>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content (2/3 width) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Opportunity & Challenge Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-indigo-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">🎯 Challenge & Opportunity</h2>
                <div class="space-y-4">
                    <div>
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Challenge</span>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">{{ $activityPlan->challenge }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Opportunity</span>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">{{ $activityPlan->opportunity }}</p>
                    </div>
                </div>
            </div>

            <!-- Baseline Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-blue-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">📊 Baseline</h2>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $activityPlan->baseline }}</p>
            </div>

            <!-- Intervention & Objectives Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-purple-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">🎯 Intervention & Objective</h2>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $activityPlan->intervention_objective }}</p>
            </div>

            <!-- Activities Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-green-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">✅ List of Activities</h2>
                <ul class="space-y-2">
                    @forelse($activityPlan->list_of_activities as $activity)
                        <li class="flex items-start gap-3 p-2 bg-gray-50 dark:bg-neutral-800 rounded">
                            <span class="text-green-600 dark:text-green-400 font-bold">✓</span>
                            <span class="text-gray-900 dark:text-white">{{ $activity }}</span>
                        </li>
                    @empty
                        <p class="text-gray-500 dark:text-gray-400">No activities defined</p>
                    @endforelse
                </ul>
            </div>

            <!-- KPI Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-orange-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">📈 Key Performance Indicator</h2>
                <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $activityPlan->kpi }}</p>
            </div>

            <!-- Responsible Person Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-cyan-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">👤 Responsible Person</h2>
                <div class="text-lg font-semibold text-gray-900 dark:text-white">
                    {{ $activityPlan->responsiblePerson?->name ?? 'Not assigned' }}
                </div>
                @if($activityPlan->responsiblePerson)
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $activityPlan->responsiblePerson?->email }}</p>
                @endif
            </div>

            <!-- Budget & Timeline Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-yellow-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">💰 Budget & Timeline</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Budget Cost</span>
                        <p class="text-2xl font-bold text-gray-900 dark:text-white mt-1">RWF {{ number_format($activityPlan->cost, 0) }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Financing Mechanism</span>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">{{ $activityPlan->financing_mechanism }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Starting Date</span>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">{{ $activityPlan->starting_date->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Ending Date</span>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white mt-1">{{ $activityPlan->ending_date->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Status Remarks Card -->
            @if($activityPlan->status_remarks)
                <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-pink-600">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">📝 Status Remarks</h2>
                    <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $activityPlan->status_remarks }}</p>
                </div>
            @endif
        </div>

        <!-- Sidebar (1/3 width) -->
        <div class="space-y-6">
            <!-- Quick Info Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">📌 Quick Info</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <span class="font-medium text-gray-600 dark:text-gray-400">Year</span>
                        <p class="text-gray-900 dark:text-white font-semibold">{{ $activityPlan->year }}</p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600 dark:text-gray-400">Country</span>
                        <p class="text-gray-900 dark:text-white font-semibold">{{ $activityPlan->country }}</p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600 dark:text-gray-400">Focus Area</span>
                        <p class="text-gray-900 dark:text-white font-semibold">{{ $activityPlan->focus_area }}</p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600 dark:text-gray-400">Status</span>
                        <p class="text-lg font-bold {{ $activityPlan->status === 'red' ? 'text-red-600' : ($activityPlan->status === 'yellow' ? 'text-yellow-600' : 'text-green-600') }}">
                            {{ $activityPlan->status === 'red' ? 'Not Achieved' : ($activityPlan->status === 'yellow' ? 'Ongoing' : 'Achieved') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Duration Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">⏱️ Duration</h3>
                <div class="text-center">
                    <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">
                        {{ $activityPlan->getDurationInDays() }}
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">days</p>
                </div>
            </div>

            <!-- Dates Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">📅 Period</h3>
                <div class="space-y-2 text-sm">
                    <div>
                        <p class="text-gray-600 dark:text-gray-400">From</p>
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $activityPlan->starting_date->format('M d, Y') }}</p>
                    </div>
                    <div class="border-t border-gray-200 dark:border-neutral-700 pt-2">
                        <p class="text-gray-600 dark:text-gray-400">To</p>
                        <p class="font-semibold text-gray-900 dark:text-white">{{ $activityPlan->ending_date->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Created & Updated Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">ℹ️ Metadata</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <span class="font-medium text-gray-600 dark:text-gray-400">Created</span>
                        <p class="text-gray-900 dark:text-white">{{ $activityPlan->created_at->format('M d, Y') }}</p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600 dark:text-gray-400">Last Updated</span>
                        <p class="text-gray-900 dark:text-white">{{ $activityPlan->updated_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
