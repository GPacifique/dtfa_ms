@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Prepare Match</h1>
            <p class="text-gray-600 dark:text-gray-400 mt-1">Schedule and configure match details</p>
        </div>
        <a href="{{ route('admin.games.index') }}" class="px-4 py-2 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 font-medium transition">
            ← Back to Matches
        </a>
    </div>

    <form action="{{ isset($game) ? route('admin.games.update', $game) : route('admin.games.store') }}" method="POST" class="bg-white dark:bg-neutral-900 shadow rounded-xl p-8">
        @csrf
        @if(isset($game))
            @method('PUT')
        @endif

        <!-- Match Details Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-indigo-500">
                ⚽ Match Details
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Sports Discipline -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Sports Discipline *</label>
                    <select name="discipline" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Select discipline</option>
                        <option value="Football" {{ (isset($game) && $game->discipline=='Football') ? 'selected' : '' }}>⚽ Football</option>
                        <option value="Basketball" {{ (isset($game) && $game->discipline=='Basketball') ? 'selected' : '' }}>🏀 Basketball</option>
                    </select>
                    @error('discipline')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <!-- Category -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Category *</label>
                    <select name="category" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="">Select category</option>
                        <option value="In house" {{ (isset($game) && $game->category=='In house') ? 'selected' : '' }}>🏠 In house</option>
                        <option value="Friendly" {{ (isset($game) && $game->category=='Friendly') ? 'selected' : '' }}>🤝 Friendly</option>
                        <option value="League" {{ (isset($game) && $game->category=='League') ? 'selected' : '' }}>🏆 League</option>
                    </select>
                    @error('category')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <!-- Teams Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-emerald-500">
                👥 Teams
            </h2>

            <!-- Home Team -->
            <div class="mb-6 p-6 bg-blue-50 dark:bg-blue-900/20 rounded-lg">
                <h3 class="font-semibold text-lg mb-4 text-blue-900 dark:text-blue-200">🏠 Home Team</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Team Name *</label>
                        <input type="text" name="home_team" value="{{ $game->home_team ?? '' }}" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        @error('home_team')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Team Color</label>
                        <input type="color" name="home_color" value="{{ $game->home_color ?? '#1E40AF' }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg h-[50px] cursor-pointer">
                        @error('home_color')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            <!-- Away Team -->
            <div class="p-6 bg-red-50 dark:bg-red-900/20 rounded-lg">
                <h3 class="font-semibold text-lg mb-4 text-red-900 dark:text-red-200">✈️ Away Team</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Team Name *</label>
                        <input type="text" name="away_team" value="{{ $game->away_team ?? '' }}" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        @error('away_team')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Team Color</label>
                        <input type="color" name="away_color" value="{{ $game->away_color ?? '#DC2626' }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg h-[50px] cursor-pointer">
                        @error('away_color')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- Schedule Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-purple-500">
                📅 Schedule
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Match Date *</label>
                    <input type="date" name="date" value="{{ isset($game) && $game->date ? $game->date->format('Y-m-d') : '' }}" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('date')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Game Time *</label>
                    <input type="time" name="time" value="{{ $game->time ?? '' }}" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('time')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Departure Time</label>
                    <input type="time" name="departure_time" value="{{ $game->departure_time ?? '' }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('departure_time')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Expected Finish</label>
                    <input type="time" name="expected_finish_time" value="{{ $game->expected_finish_time ?? '' }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('expected_finish_time')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <!-- Venue & Logistics Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-amber-500">
                📍 Venue & Logistics
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Venue *</label>
                    <input type="text" name="venue" value="{{ $game->venue ?? '' }}" required class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('venue')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Country</label>
                    <select name="country" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="Rwanda" {{ (isset($game) && $game->country=='Rwanda') ? 'selected' : '' }}>🇷🇼 Rwanda</option>
                        <option value="Tanzania" {{ (isset($game) && $game->country=='Tanzania') ? 'selected' : '' }}>🇹🇿 Tanzania</option>
                    </select>
                    @error('country')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">City</label>
                    <input type="text" name="city" value="{{ $game->city ?? '' }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('city')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Base</label>
                    <input type="text" name="base" value="{{ $game->base ?? '' }}" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    @error('base')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Transport</label>
                    <select name="transport" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="Self" {{ (isset($game) && $game->transport=='Self') ? 'selected' : '' }}>🚗 Self</option>
                        <option value="Group" {{ (isset($game) && $game->transport=='Group') ? 'selected' : '' }}>🚌 Group</option>
                    </select>
                    @error('transport')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Age Group</label>
                    <select name="age_group" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="u18" {{ (isset($game) && $game->age_group=='u18') ? 'selected' : '' }}>U18</option>
                        <option value="u16" {{ (isset($game) && $game->age_group=='u16') ? 'selected' : '' }}>U16</option>
                        <option value="u14" {{ (isset($game) && $game->age_group=='u14') ? 'selected' : '' }}>U14</option>
                        <option value="u12" {{ (isset($game) && $game->age_group=='u12') ? 'selected' : '' }}>U12</option>
                    </select>
                    @error('age_group')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Gender</label>
                    <select name="gender" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <option value="Male" {{ (isset($game) && $game->gender=='Male') ? 'selected' : '' }}>👨 Male</option>
                        <option value="Female" {{ (isset($game) && $game->gender=='Female') ? 'selected' : '' }}>👩 Female</option>
                        <option value="Mixed" {{ (isset($game) && $game->gender=='Mixed') ? 'selected' : '' }}>👥 Mixed</option>
                    </select>
                    @error('gender')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <!-- Objective Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-teal-500">
                🎯 Match Objective
            </h2>
            <textarea name="objective" rows="3" class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="Describe the objective or purpose of this match...">{{ $game->objective ?? '' }}</textarea>
            @error('objective')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
        </div>

        <!-- Staff & Players Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-6 pb-3 border-b-2 border-pink-500">
                👔 Staff & Players
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Staff -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Select Staff</label>
                    <select name="staff_ids[]" multiple class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent h-40">
                        @foreach($staffs as $staff)
                            <option value="{{ $staff->id }}" {{ (isset($game) && in_array($staff->id, $game->staff_ids ?? [])) ? 'selected' : '' }}>
                                {{ $staff->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl (Cmd on Mac) to select multiple</p>
                    @error('staff_ids')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror

                    <div class="mt-3">
                        <label class="flex items-center">
                            <input type="checkbox" name="notify_staff" value="1" {{ (isset($game) && $game->notify_staff) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">📧 Notify staff via email</span>
                        </label>
                    </div>
                </div>

                <!-- Players -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Select Players</label>
                    <select name="player_ids[]" multiple class="w-full border border-gray-300 dark:border-gray-600 rounded-lg px-4 py-3 dark:bg-neutral-800 focus:ring-2 focus:ring-indigo-500 focus:border-transparent h-40">
                        @foreach($players as $player)
                            <option value="{{ $player->id }}" {{ (isset($game) && in_array($player->id, $game->player_ids ?? [])) ? 'selected' : '' }}>
                                {{ $player->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Hold Ctrl (Cmd on Mac) to select multiple</p>
                    @error('player_ids')<span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>@enderror
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-neutral-700">
            <a href="{{ route('admin.games.index') }}" class="px-6 py-3 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 font-semibold transition">
                Cancel
            </a>
            <button type="submit" class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg font-semibold shadow-lg transition transform hover:scale-105">
                {{ isset($game) ? '✅ Update Match' : '➕ Create Match' }}
            </button>
        </div>
    </form>
</div>
@endsection
