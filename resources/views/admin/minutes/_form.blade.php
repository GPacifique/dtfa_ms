@php
    $editing = isset($minute);
@endphp

<form action="{{ $editing ? route('admin.minutes.update', $minute) : route('admin.minutes.store') }}" method="POST" class="max-w-4xl mx-auto bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
    @csrf
    @if($editing)
        @method('PUT')
    @endif

    <!-- Status Badge -->
    @if($editing)
    <div class="mb-6 p-4 rounded-lg {{ $minute->status === 'scheduled' ? 'bg-blue-50 dark:bg-blue-900' : ($minute->status === 'completed' ? 'bg-green-50 dark:bg-green-900' : 'bg-red-50 dark:bg-red-900') }}">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-gray-900 dark:text-white">Minutes Status</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    @if($minute->status === 'scheduled')
                        📅 Scheduled - Ready to be held
                    @elseif($minute->status === 'completed')
                        ✅ Completed - Minutes recorded
                    @else
                        ❌ Cancelled - Meeting was cancelled
                    @endif
                </p>
            </div>
            <span class="px-4 py-2 rounded-full font-semibold {{ $minute->status === 'scheduled' ? 'bg-blue-200 text-blue-800' : ($minute->status === 'completed' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800') }}">
                {{ ucfirst($minute->status) }}
            </span>
        </div>
    </div>
    @endif

    <!-- Basic Information -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📋 Meeting Details
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <!-- Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Meeting Date *</label>
                <input type="date" name="date" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="{{ $editing ? $minute->date?->format('Y-m-d') : '' }}" required>
                @error('date')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <!-- Starting Time -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Starting Time *</label>
                <input type="time" name="starting_time" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="{{ $editing ? $minute->starting_time : '' }}" required>
                @error('starting_time')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <!-- End Time -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">End Time *</label>
                <input type="time" name="end_time" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="{{ $editing ? $minute->end_time : '' }}" required>
                @error('end_time')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <!-- Venue -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Venue *</label>
                <input type="text" name="venue" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="e.g., Conference Room A" value="{{ $editing ? $minute->venue : '' }}" required>
                @error('venue')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <!-- Chaired By -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Chaired By *</label>
                <input type="text" name="chaired_by" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Chairperson name" value="{{ $editing ? $minute->chaired_by : '' }}" required>
                @error('chaired_by')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <!-- Note Taken By -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Note Taken By *</label>
                <input type="text" name="note_taken_by" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Secretary name" value="{{ $editing ? $minute->note_taken_by : '' }}" required>
                @error('note_taken_by')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <!-- Attendance -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            👥 Attendance
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Attendance List -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Attendance (one per line)</label>
                <textarea name="attendance_list" rows="4" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700 text-sm" placeholder="Name 1&#10;Name 2&#10;Name 3">@if($editing && $minute->attendance_list){{ implode("\n", $minute->attendance_list) }}@endif</textarea>
            </div>

            <!-- Absent with Apology -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Absent with Apology</label>
                <textarea name="absent_apology" rows="4" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700 text-sm" placeholder="Name 1&#10;Name 2">@if($editing && $minute->absent_apology){{ implode("\n", $minute->absent_apology) }}@endif</textarea>
            </div>

            <!-- Absent without Apology -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Absent without Apology</label>
                <textarea name="absent_no_apology" rows="4" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700 text-sm" placeholder="Name 1&#10;Name 2">@if($editing && $minute->absent_no_apology){{ implode("\n", $minute->absent_no_apology) }}@endif</textarea>
            </div>
        </div>
    </div>

    <!-- Meeting Content -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📝 Meeting Content
        </h2>

        <!-- Agenda -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Agenda/Topics *</label>
            <textarea name="agenda" rows="5" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Describe the topics discussed..." required>{{ $editing ? $minute->agenda : '' }}</textarea>
            @error('agenda')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Resolution -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Resolution/Decisions</label>
            <textarea name="resolution" rows="5" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Describe the resolutions and decisions made...">{{ $editing ? $minute->resolution : '' }}</textarea>
            @error('resolution')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Responsible Person -->
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Responsible Person (for follow-up)</label>
            <input type="text" name="responsible_person" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Name and contact" value="{{ $editing ? $minute->responsible_person : '' }}">
            @error('responsible_person')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>
    </div>

    <!-- Important Dates -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📅 Important Dates
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <!-- Start Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Start Date</label>
                <input type="date" name="start_date" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="{{ $editing ? $minute->start_date?->format('Y-m-d') : '' }}">
                @error('start_date')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <!-- Competition Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Competition Date</label>
                <input type="date" name="competition_date" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="{{ $editing ? $minute->competition_date?->format('Y-m-d') : '' }}">
                @error('competition_date')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-between items-center">
        <a href="{{ route('admin.minutes.index') }}" class="px-4 py-2 border rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-neutral-800 font-medium transition">
            ← Cancel
        </a>
        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium transition">
            {{ $editing ? '💾 Update Minutes' : '✅ Create Minutes' }}
        </button>
    </div>
</form>
