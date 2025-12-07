@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-4xl font-bold text-slate-900 dark:text-white">➕ Create Training Session</h1>
        <a href="{{ route('coach.sessions.index') }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 font-semibold transition">

        </a>
    </div>

    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 p-8">
        <form method="POST" action="{{ route('coach.sessions.store') }}" class="space-y-8">
            @csrf

            <!-- Date & Time Section -->
            <div>
                <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">📅 Schedule</h2>
                <div class="space-y-6">
                    <div>
                        <label for="date" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Date *</label>
                        <input type="date" name="date" id="date" value="{{ old('date', now()->format('Y-m-d')) }}" required
                               class="block w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        @error('date')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="start_time" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Start Time *</label>
                            <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" required
                                   class="block w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            @error('start_time')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="end_time" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">End Time *</label>
                            <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" required
                                   class="block w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            @error('end_time')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Location & Group Section -->
            <div>
                <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">📍 Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="location" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Location *</label>
                        <input type="text" name="location" id="location" value="{{ old('location', $branch->name ?? '') }}" required
                               class="block w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        @error('location')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="group_id" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Group *</label>
                        <select name="group_id" id="group_id" required
                                class="block w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">-- Select a group --</option>
                            @foreach ($groups as $group)
                                <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>
                                    {{ $group->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('group_id')
                            <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Training Days Section -->
            <div>
                <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">📆 Training Days</h2>
                <div class="grid grid-cols-4 md:grid-cols-7 gap-3">
                    @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                        <label class="flex flex-col items-center gap-2 cursor-pointer p-3 border border-slate-300 dark:border-slate-600 rounded-lg hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition">
                            <input type="checkbox" name="training_days[]" value="{{ $day }}" {{ in_array($day, old('training_days', [])) ? 'checked' : '' }}
                                   class="rounded border-slate-300 dark:border-slate-600 text-indigo-600 dark:bg-slate-700 focus:ring-indigo-500">
                            <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ substr($day, 0, 3) }}</span>
                        </label>
                    @endforeach
                </div>
                @error('training_days')
                    <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-4 pt-6 border-t border-slate-200 dark:border-slate-700">
                <button type="submit" class="px-8 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg transition">
                    ✓ Create Session
                </button>
                <a href="{{ route('coach.sessions.index') }}" class="px-8 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-semibold rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
