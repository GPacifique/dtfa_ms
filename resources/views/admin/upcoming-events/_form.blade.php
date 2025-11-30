@php
    $editing = isset($event);
@endphp

<form action="{{ $editing ? route('admin.upcoming-events.update', $event) : route('admin.upcoming-events.store') }}" method="POST" class="max-w-4xl mx-auto bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
    @csrf
    @if($editing)
        @method('PUT')
    @endif

    <!-- Status Badge -->
    @if($editing)
    <div class="mb-6 p-4 rounded-lg {{ $event->status === 'upcoming' ? 'bg-blue-50 dark:bg-blue-900' : ($event->status === 'ongoing' ? 'bg-yellow-50 dark:bg-yellow-900' : ($event->status === 'completed' ? 'bg-green-50 dark:bg-green-900' : 'bg-red-50 dark:bg-red-900')) }}">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-gray-900 dark:text-white">Event Status</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    @if($event->status === 'upcoming')
                        📅 Upcoming - Event is scheduled
                    @elseif($event->status === 'ongoing')
                        🔴 Ongoing - Event is happening now
                    @elseif($event->status === 'completed')
                        ✅ Completed - Event has finished
                    @else
                        ❌ Cancelled - Event was cancelled
                    @endif
                </p>
            </div>
            <span class="px-4 py-2 rounded-full font-semibold {{ $event->status === 'upcoming' ? 'bg-blue-200 text-blue-800' : ($event->status === 'ongoing' ? 'bg-yellow-200 text-yellow-800' : ($event->status === 'completed' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800')) }}">
                {{ ucfirst($event->status) }}
            </span>
        </div>
    </div>
    @endif

    <!-- Event Information -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📋 Event Details
        </h2>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Event Name *</label>
            <input type="text" name="event_name" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="e.g., Annual Sports Championship" value="{{ $editing ? $event->event_name : '' }}" required>
            @error('event_name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <!-- Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Event Date *</label>
                <input type="date" name="date" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="{{ $editing ? $event->date?->format('Y-m-d') : '' }}" required>
                @error('date')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <!-- Venue -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Venue *</label>
                <input type="text" name="venue" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="e.g., National Stadium" value="{{ $editing ? $event->venue : '' }}" required>
                @error('venue')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <!-- Starting Time -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Starting Time *</label>
                <input type="time" name="starting_time" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="{{ $editing ? $event->starting_time : '' }}" required>
                @error('starting_time')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <!-- Ending Time -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ending Time *</label>
                <input type="time" name="ending_time" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="{{ $editing ? $event->ending_time : '' }}" required>
                @error('ending_time')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <!-- Content -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📝 Event Content
        </h2>

        <!-- Objective -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Objective of Event *</label>
            <textarea name="objective" rows="4" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Describe the main objective..." required>{{ $editing ? $event->objective : '' }}</textarea>
            @error('objective')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Targeted Audience -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Targeted Audience *</label>
            <textarea name="targeted_audience" rows="4" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Describe the target audience..." required>{{ $editing ? $event->targeted_audience : '' }}</textarea>
            @error('targeted_audience')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>
    </div>

    <!-- Organizers -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            👥 Event Organizers
        </h2>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Coordinator Name *</label>
            <input type="text" name="coordinator_name" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Coordinator's full name" value="{{ $editing ? $event->coordinator_name : '' }}" required>
            @error('coordinator_name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Supporting Staff (one per line)</label>
            <textarea name="supporting_staff_names" rows="4" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700 text-sm" placeholder="Staff Name 1&#10;Staff Name 2&#10;Staff Name 3">@if($editing && $event->supporting_staff_names){{ implode("\n", $event->supporting_staff_names) }}@endif</textarea>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Enter each staff member on a new line</p>
        </div>
    </div>

    <!-- Payment -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            💰 Payment Information
        </h2>

        <div class="flex items-center gap-4 mb-4">
            <label class="flex items-center gap-2">
                <input type="checkbox" name="is_paid" class="rounded" {{ $editing && $event->is_paid ? 'checked' : '' }}>
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">This is a Paid Event</span>
            </label>
        </div>

        <div id="paymentFields" class="grid grid-cols-1 md:grid-cols-2 gap-4" style="display: {{ ($editing && $event->is_paid) || request('is_paid') ? 'grid' : 'none' }};">
            <!-- Amount -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Amount</label>
                <input type="number" name="amount" step="0.01" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="0.00" value="{{ $editing ? $event->amount : '' }}">
                @error('amount')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <!-- Currency -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Currency</label>
                <select name="currency" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="RWF" {{ $editing && $event->currency === 'RWF' ? 'selected' : '' }}>RWF - Rwanda Franc</option>
                    <option value="USD" {{ $editing && $event->currency === 'USD' ? 'selected' : '' }}>USD - US Dollar</option>
                    <option value="EUR" {{ $editing && $event->currency === 'EUR' ? 'selected' : '' }}>EUR - Euro</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-between items-center">
        <a href="{{ route('admin.upcoming-events.index') }}" class="px-4 py-2 border rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-neutral-800 font-medium transition">
            ← Cancel
        </a>
        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium transition">
            {{ $editing ? '💾 Update Event' : '✅ Create Event' }}
        </button>
    </div>
</form>

<script>
    // Toggle payment fields based on checkbox
    document.querySelector('input[name="is_paid"]')?.addEventListener('change', function() {
        document.getElementById('paymentFields').style.display = this.checked ? 'grid' : 'none';
    });
</script>
