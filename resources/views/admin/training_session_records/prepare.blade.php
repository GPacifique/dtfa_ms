@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Prepare Training Session</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">Plan and schedule training session details</p>
        </div>
        <a href="{{ route('admin.training_session_records.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 font-medium transition">
            ← Back to Records
        </a>
    </div>

    <form action="{{ isset($trainingSessionRecord) ? route('admin.training_session_records.update', $trainingSessionRecord) : route('admin.training_session_records.store') }}" method="POST" class="bg-white dark:bg-neutral-900 shadow rounded-xl p-8">
        @csrf
        @if(isset($trainingSessionRecord))
            @method('PUT')
        @endif

        <!-- Training Objectives Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-purple-500">
                🎯 Training Objectives
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Main Topic</label>
                    <input type="text" name="main_topic" value="{{ $trainingSessionRecord->main_topic ?? '' }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="e.g., Passing techniques, Ball control">
                    @error('main_topic')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Area of Performance</label>
                    <select name="area_performance" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="">Select area</option>
                        <option value="Physical" {{ (isset($trainingSessionRecord) && $trainingSessionRecord->area_performance=='Physical') ? 'selected' : '' }}>💪 Physical</option>
                        <option value="Technical" {{ (isset($trainingSessionRecord) && $trainingSessionRecord->area_performance=='Technical') ? 'selected' : '' }}>⚙️ Technical</option>
                        <option value="Tactical" {{ (isset($trainingSessionRecord) && $trainingSessionRecord->area_performance=='Tactical') ? 'selected' : '' }}>♟️ Tactical</option>
                        <option value="Mental" {{ (isset($trainingSessionRecord) && $trainingSessionRecord->area_performance=='Mental') ? 'selected' : '' }}>🧠 Mental</option>
                    </select>
                    @error('area_performance')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Training Objective</label>
                <textarea name="training_objective" rows="4" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Describe the objectives and goals for this training session...">{{ $trainingSessionRecord->training_objective ?? '' }}</textarea>
                @error('training_objective')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
            </div>
        </div>

        <!-- Basic Details Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-indigo-500">
                📅 Session Details
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Date</label>
                    <input type="date" name="date" value="{{ isset($trainingSessionRecord) && $trainingSessionRecord->date ? $trainingSessionRecord->date->format('Y-m-d') : '' }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('date')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Start Time</label>
                    <input type="time" name="start_time" value="{{ $trainingSessionRecord->start_time ?? '' }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('start_time')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Finish Time</label>
                    <input type="time" name="finish_time" value="{{ $trainingSessionRecord->finish_time ?? '' }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('finish_time')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Sport Discipline</label>
                    <select name="sport_discipline" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Select discipline</option>
                        <option value="Football" {{ (isset($trainingSessionRecord) && $trainingSessionRecord->sport_discipline=='Football') ? 'selected' : '' }}>⚽ Football</option>
                        <option value="Basketball" {{ (isset($trainingSessionRecord) && $trainingSessionRecord->sport_discipline=='Basketball') ? 'selected' : '' }}>🏀 Basketball</option>
                    </select>
                    @error('sport_discipline')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Coach</label>
                    <select name="coach_id" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Select coach</option>
                        @foreach($coaches as $coach)
                            <option value="{{ $coach->id }}" {{ (isset($trainingSessionRecord) && $trainingSessionRecord->coach_id == $coach->id) ? 'selected' : '' }}>
                                {{ $coach->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('coach_id')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Lead Coach</label>
                    <select name="lead_coach_id" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Select lead coach</option>
                        @foreach($coaches as $coach)
                            <option value="{{ $coach->id }}" {{ (isset($trainingSessionRecord) && $trainingSessionRecord->lead_coach_id == $coach->id) ? 'selected' : '' }}>
                                {{ $coach->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('lead_coach_id')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div class="lg:col-span-3">
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Support Staff</label>
                    <select name="support_staff[]" multiple class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        @foreach($coaches as $coach)
                            <option value="{{ $coach->id }}" {{ (isset($trainingSessionRecord) && in_array($coach->id, (array)$trainingSessionRecord->support_staff)) ? 'selected' : '' }}>
                                {{ $coach->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('support_staff')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Branch</label>
                    <select name="branch" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Select branch</option>
                        @foreach($branches as $b)
                            <option value="{{ $b }}" {{ (isset($trainingSessionRecord) && $trainingSessionRecord->branch == $b) ? 'selected' : '' }}>
                                {{ $b }}
                            </option>
                        @endforeach
                    </select>
                    @error('branch')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <!-- Location Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-emerald-500">
                📍 Location
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Country</label>
                    <select name="country" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                        <option value="">Select country</option>
                        <option value="Rwanda" {{ (isset($trainingSessionRecord) && $trainingSessionRecord->country=='Rwanda') ? 'selected' : '' }}>🇷🇼 Rwanda</option>
                        <option value="Tanzania" {{ (isset($trainingSessionRecord) && $trainingSessionRecord->country=='Tanzania') ? 'selected' : '' }}>🇹🇿 Tanzania</option>
                    </select>
                    @error('country')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">City</label>
                    <select name="city" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                        <option value="">Select city</option>
                        <option value="Kigali" {{ (isset($trainingSessionRecord) && $trainingSessionRecord->city=='Kigali') ? 'selected' : '' }}>Kigali</option>
                        <option value="Mwanza" {{ (isset($trainingSessionRecord) && $trainingSessionRecord->city=='Mwanza') ? 'selected' : '' }}>Mwanza</option>
                    </select>
                    @error('city')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Training Pitch</label>
                    <select name="training_pitch" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-emerald-500 focus:border-transparent">
                        <option value="">Select pitch</option>
                        @foreach($pitches as $p)
                            <option value="{{ $p }}" {{ (isset($trainingSessionRecord) && $trainingSessionRecord->training_pitch == $p) ? 'selected' : '' }}>
                                {{ $p }}
                            </option>
                        @endforeach
                        <option value="Other" {{ (isset($trainingSessionRecord) && $trainingSessionRecord->training_pitch == 'Other') ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('training_pitch')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Other Pitch (if Other)</label>
                    <input type="text" name="other_training_pitch" value="{{ $trainingSessionRecord->other_training_pitch ?? '' }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-emerald-500 focus:border-transparent" placeholder="Specify other pitch">
                    @error('other_training_pitch')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <!-- Training Plan - Part 1 Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-blue-500">
                📋 Training Plan - Part 1 (Warm-up & Drills)
            </h2>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Part 1 Activities Overview</label>
                <textarea name="part1_activities" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Brief overview of Part 1 activities...">{{ $trainingSessionRecord->part1_activities ?? '' }}</textarea>
                @error('part1_activities')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
            </div>

            <div class="grid grid-cols-1 gap-4">
                <!-- Activity 1 -->
                <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-blue-900 dark:text-blue-200">Activity 1</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part1_a1_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800">{{ $trainingSessionRecord->part1_a1_desc ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part1_a1_time" value="{{ $trainingSessionRecord->part1_a1_time ?? '' }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 10 min">
                        </div>
                    </div>
                </div>

                <!-- Activity 2 -->
                <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-blue-900 dark:text-blue-200">Activity 2</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part1_a2_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800">{{ $trainingSessionRecord->part1_a2_desc ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part1_a2_time" value="{{ $trainingSessionRecord->part1_a2_time ?? '' }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 15 min">
                        </div>
                    </div>
                </div>

                <!-- Activity 3 -->
                <div class="p-4 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-blue-900 dark:text-blue-200">Activity 3</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part1_a3_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800">{{ $trainingSessionRecord->part1_a3_desc ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part1_a3_time" value="{{ $trainingSessionRecord->part1_a3_time ?? '' }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 20 min">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Training Plan - Part 2 Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-teal-500">
                📋 Training Plan - Part 2 (Main Session)
            </h2>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Part 2 Activities Overview</label>
                <textarea name="part2_activities" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-teal-500 focus:border-transparent" placeholder="Brief overview of Part 2 activities...">{{ $trainingSessionRecord->part2_activities ?? '' }}</textarea>
                @error('part2_activities')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
            </div>

            <div class="grid grid-cols-1 gap-4">
                <!-- Activity 1 -->
                <div class="p-4 bg-teal-50 dark:bg-teal-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-teal-900 dark:text-teal-200">Activity 1</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part2_a1_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800">{{ $trainingSessionRecord->part2_a1_desc ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part2_a1_time" value="{{ $trainingSessionRecord->part2_a1_time ?? '' }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 25 min">
                        </div>
                    </div>
                </div>

                <!-- Activity 2 -->
                <div class="p-4 bg-teal-50 dark:bg-teal-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-teal-900 dark:text-teal-200">Activity 2</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part2_a2_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800">{{ $trainingSessionRecord->part2_a2_desc ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part2_a2_time" value="{{ $trainingSessionRecord->part2_a2_time ?? '' }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 30 min">
                        </div>
                    </div>
                </div>

                <!-- Activity 3 -->
                <div class="p-4 bg-teal-50 dark:bg-teal-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-teal-900 dark:text-teal-200">Activity 3</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part2_a3_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800">{{ $trainingSessionRecord->part2_a3_desc ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part2_a3_time" value="{{ $trainingSessionRecord->part2_a3_time ?? '' }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 20 min">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Notes Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-amber-500">
                📝 Additional Notes
            </h2>

            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Part 3 Notes (Cool Down / Conclusion)</label>
                <textarea name="part3_notes" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Brief overview of Part 3 activities...">{{ $trainingSessionRecord->part3_notes ?? '' }}</textarea>
                @error('part3_notes')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
            </div>

            <div class="grid grid-cols-1 gap-4">
                <!-- Activity 1 -->
                <div class="p-4 bg-amber-50 dark:bg-amber-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-amber-900 dark:text-amber-200">Activity 1</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part3_a1_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800">{{ $trainingSessionRecord->part3_a1_desc ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part3_a1_time" value="{{ $trainingSessionRecord->part3_a1_time ?? '' }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 10 min">
                        </div>
                    </div>
                </div>

                <!-- Activity 2 -->
                <div class="p-4 bg-amber-50 dark:bg-amber-900/20 rounded-lg">
                    <h3 class="font-semibold mb-3 text-amber-900 dark:text-amber-200">Activity 2</h3>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div class="md:col-span-3">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Description</label>
                            <textarea name="part3_a2_desc" rows="2" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800">{{ $trainingSessionRecord->part3_a2_desc ?? '' }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Duration</label>
                            <input type="text" name="part3_a2_time" value="{{ $trainingSessionRecord->part3_a2_time ?? '' }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 dark:bg-neutral-800" placeholder="e.g., 15 min">
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Part 4 Message (Communication to Players/Parents)</label>
                <textarea name="part4_message" rows="3" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-amber-500 focus:border-transparent" placeholder="Any messages or announcements...">{{ $trainingSessionRecord->part4_message ?? '' }}</textarea>
                @error('part4_message')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-neutral-700">
            <a href="{{ route('admin.training_session_records.index') }}" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 font-semibold transition">
                Cancel
            </a>
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg font-semibold shadow-lg transition transform hover:scale-105">
                {{ isset($trainingSessionRecord) ? '✅ Update Training Plan' : '➕ Create Training Plan' }}
            </button>
        </div>
    </form>
</div>
@endsection
