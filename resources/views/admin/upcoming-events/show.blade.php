@extends('layouts.app')

@push('hero')
    <x-hero title="{{ $event->event_name }}" subtitle="📅 {{ $event->date?->format('F j, Y') ?? 'No Date Set' }}">
        <span class="px-4 py-2 rounded-full font-semibold text-lg {{ $event->status === 'upcoming' ? 'bg-blue-200 text-blue-800 dark:bg-blue-900 dark:text-blue-200' : ($event->status === 'ongoing' ? 'bg-yellow-200 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200' : ($event->status === 'completed' ? 'bg-green-200 text-green-800 dark:bg-green-900 dark:text-green-200' : 'bg-red-200 text-red-800 dark:bg-red-900 dark:text-red-200')) }}">
            {{ ucfirst($event->status) }}
        </span>
    </x-hero>
@endpush

@section('content')
<div class="container mx-auto px-4 py-6">


    <!-- Action Buttons -->
    <div class="mb-6 flex flex-wrap gap-2">
        @if($event->isUpcoming())
            <form action="{{ route('admin.upcoming-events.mark-ongoing', $event) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg font-medium transition">
                    🔴 Mark as Ongoing
                </button>
            </form>
        @endif

        @if($event->isUpcoming() || $event->isOngoing())
            <form action="{{ route('admin.upcoming-events.mark-completed', $event) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition">
                    ✅ Mark as Completed
                </button>
            </form>
        @endif

        @if(!$event->isCancelled())
            <form action="{{ route('admin.upcoming-events.mark-cancelled', $event) }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition">
                    ❌ Mark as Cancelled
                </button>
            </form>
        @endif

        <a href="{{ route('admin.upcoming-events.edit', $event) }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg font-medium transition">
            ✏️ Edit Event
        </a>

        <form action="{{ route('admin.upcoming-events.destroy', $event) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition" onclick="return confirm('Are you sure?')">
                🗑️ Delete Event
            </button>
        </form>

        <a href="{{ route('admin.upcoming-events.index') }}" class="px-4 py-2 border border-gray-300 text-gray-700 dark:text-gray-300 dark:border-neutral-700 rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-800 font-medium transition">
            ← Back to Events
        </a>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content (2/3 width) -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Event Details Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-indigo-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">📋 Event Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Date</span>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $event->date?->format('F j, Y') ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Venue</span>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $event->venue }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Start Time</span>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $event->starting_time?->format('H:i') ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">End Time</span>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $event->ending_time?->format('H:i') ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Objective Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-blue-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">🎯 Event Objective</h2>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $event->objective }}</p>
            </div>

            <!-- Target Audience Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-purple-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">👥 Targeted Audience</h2>
                <p class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-wrap">{{ $event->targeted_audience }}</p>
            </div>

            <!-- Organizers Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-green-600">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">👨‍💼 Event Organizers</h2>
                <div class="space-y-3">
                    <div>
                        <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Event Coordinator</span>
                        <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $event->coordinator_name }}</p>
                    </div>
                    @if($event->supporting_staff_names && count($event->supporting_staff_names) > 0)
                        <div>
                            <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Supporting Staff</span>
                            <ul class="mt-2 space-y-1">
                                @foreach($event->supporting_staff_names as $staff)
                                    <li class="text-gray-900 dark:text-white">• {{ $staff }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Payment Information Card -->
            @if($event->is_paid)
                <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-yellow-600">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">💰 Payment Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Event Type</span>
                            <p class="text-lg font-semibold text-yellow-600 dark:text-yellow-400">Paid Event</p>
                        </div>
                        <div>
                            <span class="text-sm font-medium text-gray-600 dark:text-gray-400">Amount</span>
                            <p class="text-lg font-semibold text-gray-900 dark:text-white">
                                {{ number_format($event->amount, 2) }} {{ $event->currency ?? 'RWF' }}
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6 border-l-4 border-blue-600">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">💰 Payment Information</h2>
                    <p class="text-lg font-semibold text-blue-600 dark:text-blue-400">🎁 Free Event - No Registration Fee</p>
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
                        <span class="font-medium text-gray-600 dark:text-gray-400">Status</span>
                        <p class="text-gray-900 dark:text-white font-semibold">{{ ucfirst($event->status) }}</p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600 dark:text-gray-400">Created On</span>
                        <p class="text-gray-900 dark:text-white">{{ $event->created_at?->format('M j, Y') }}</p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600 dark:text-gray-400">Last Updated</span>
                        <p class="text-gray-900 dark:text-white">{{ $event->updated_at?->format('M j, Y') }}</p>
                    </div>
                    <div>
                        <span class="font-medium text-gray-600 dark:text-gray-400">Event ID</span>
                        <p class="text-gray-900 dark:text-white text-xs font-mono">{{ $event->id }}</p>
                    </div>
                </div>
            </div>

            <!-- Duration Card -->
            <div class="bg-white dark:bg-neutral-900 rounded-lg shadow p-6">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4">⏱️ Duration</h3>
                <div class="text-center">
                    <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">
                        @if($event->starting_time && $event->ending_time)
                            {{ $event->ending_time->diffInHours($event->starting_time) }}
                        @else
                            -
                        @endif
                    </p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">hours</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
