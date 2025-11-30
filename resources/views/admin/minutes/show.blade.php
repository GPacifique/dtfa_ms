@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Meeting Minutes</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">{{ $minute->date?->format('l, F d, Y') }}</p>
        </div>
        <a href="{{ route('admin.minutes.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-800 font-medium">← Back to Minutes</a>
    </div>

    <!-- Status Badge and Actions -->
    <div class="mb-6 p-4 rounded-lg {{ $minute->status === 'scheduled' ? 'bg-blue-50 dark:bg-blue-900' : ($minute->status === 'completed' ? 'bg-green-50 dark:bg-green-900' : 'bg-red-50 dark:bg-red-900') }}">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-gray-900 dark:text-white">Meeting Status</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    @if($minute->status === 'scheduled')
                        📅 Scheduled - Meeting to be held
                    @elseif($minute->status === 'completed')
                        ✅ Completed - Minutes recorded
                    @else
                        ❌ Cancelled - Meeting was cancelled
                    @endif
                </p>
            </div>
            <div class="flex items-center gap-3">
                <span class="px-4 py-2 rounded-full font-semibold {{ $minute->status === 'scheduled' ? 'bg-blue-200 text-blue-800' : ($minute->status === 'completed' ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800') }}">
                    {{ ucfirst($minute->status) }}
                </span>

                @if($minute->isScheduled())
                <form action="{{ route('admin.minutes.markCompleted', $minute) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 font-medium transition">
                        ✅ Mark Completed
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <!-- Meeting Details -->
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Meeting Details</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Date</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $minute->date?->format('F d, Y') }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Time</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $minute->starting_time }} - {{ $minute->end_time }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Venue</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $minute->venue }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Duration</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ \Carbon\Carbon::parse($minute->starting_time)->diff(\Carbon\Carbon::parse($minute->end_time))->format('%H:%I') }} hours</p>
                    </div>
                </div>
            </div>

            <!-- Participants -->
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Participants</h2>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Chaired By</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $minute->chaired_by }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Note Taken By</p>
                        <p class="font-medium text-gray-900 dark:text-white">{{ $minute->note_taken_by }}</p>
                    </div>
                </div>
            </div>

            <!-- Attendance -->
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Attendance</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <!-- Present -->
                    <div class="p-4 bg-green-50 dark:bg-green-900 rounded-lg">
                        <h3 class="font-semibold text-green-900 dark:text-green-200 mb-2">✓ Present</h3>
                        <ul class="text-sm text-green-800 dark:text-green-300">
                            @if($minute->attendance_list && count($minute->attendance_list) > 0)
                                @foreach($minute->attendance_list as $name)
                                    <li>{{ $name }}</li>
                                @endforeach
                            @else
                                <li class="text-gray-600 dark:text-gray-400">No attendees recorded</li>
                            @endif
                        </ul>
                    </div>

                    <!-- Absent with Apology -->
                    <div class="p-4 bg-yellow-50 dark:bg-yellow-900 rounded-lg">
                        <h3 class="font-semibold text-yellow-900 dark:text-yellow-200 mb-2">📝 Absent (with apology)</h3>
                        <ul class="text-sm text-yellow-800 dark:text-yellow-300">
                            @if($minute->absent_apology && count($minute->absent_apology) > 0)
                                @foreach($minute->absent_apology as $name)
                                    <li>{{ $name }}</li>
                                @endforeach
                            @else
                                <li class="text-gray-600 dark:text-gray-400">None</li>
                            @endif
                        </ul>
                    </div>

                    <!-- Absent without Apology -->
                    <div class="p-4 bg-red-50 dark:bg-red-900 rounded-lg">
                        <h3 class="font-semibold text-red-900 dark:text-red-200 mb-2">✗ Absent (without apology)</h3>
                        <ul class="text-sm text-red-800 dark:text-red-300">
                            @if($minute->absent_no_apology && count($minute->absent_no_apology) > 0)
                                @foreach($minute->absent_no_apology as $name)
                                    <li>{{ $name }}</li>
                                @endforeach
                            @else
                                <li class="text-gray-600 dark:text-gray-400">None</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Agenda -->
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">📋 Agenda/Topics</h2>
                <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $minute->agenda }}</p>
            </div>

            <!-- Resolution -->
            @if($minute->resolution)
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4">✅ Resolution/Decisions</h2>
                <p class="text-gray-700 dark:text-gray-300 whitespace-pre-wrap">{{ $minute->resolution }}</p>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div>
            <!-- Important Dates -->
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 mb-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-3">📅 Important Dates</h2>
                @if($minute->start_date)
                <div class="mb-4">
                    <p class="text-sm text-gray-600 dark:text-gray-400">Start Date</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ $minute->start_date?->format('F d, Y') }}</p>
                </div>
                @endif
                @if($minute->competition_date)
                <div>
                    <p class="text-sm text-gray-600 dark:text-gray-400">Competition Date</p>
                    <p class="font-medium text-gray-900 dark:text-white">{{ $minute->competition_date?->format('F d, Y') }}</p>
                </div>
                @endif
            </div>

            <!-- Responsible Person -->
            @if($minute->responsible_person)
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 mb-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-3">👤 Responsible Person</h2>
                <p class="text-gray-700 dark:text-gray-300">{{ $minute->responsible_person }}</p>
            </div>
            @endif

            <!-- Actions -->
            <div class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
                <h2 class="text-lg font-bold text-gray-900 dark:text-white mb-3">Actions</h2>
                <div class="space-y-2">
                    <a href="{{ route('admin.minutes.edit', $minute) }}" class="block w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium text-center transition">
                        ✏️ Edit
                    </a>
                    <form action="{{ route('admin.minutes.destroy', $minute) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 font-medium transition" onclick="return confirm('Delete these minutes?');">
                            🗑️ Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
