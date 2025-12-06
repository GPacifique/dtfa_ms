@php
    $editing = isset($game);
    $isScheduled = !$editing || $game->status === 'scheduled';
    $canReport = $editing && ($game->status === 'in_progress' || $game->status === 'completed');
@endphp

<form action="{{ $editing ? route('admin.games.update', $game) : route('admin.games.store') }}" method="POST" class="max-w-4xl mx-auto bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
    @csrf
    @if($editing)
        @method('PUT')
    @endif

    <!-- Status hidden: automated by scheduler -->

    <!-- SECTION 1: MATCH CREATION FIELDS (Always visible for creation, visible for scheduled matches) -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📋 Match Details
        </h2>

        <!-- Sports Discipline -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sports Discipline *</label>
            <select name="discipline" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" {{ !$isScheduled ? 'disabled' : '' }}>
                <option value="">Select discipline</option>
                <option value="Football" {{ $editing && $game->discipline=='Football' ? 'selected' : '' }}>Football</option>
                <option value="Basketball" {{ $editing && $game->discipline=='Basketball' ? 'selected' : '' }}>Basketball</option>
            </select>
            @error('discipline')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Home Team -->
        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Home Team *</label>
                <input type="text" name="home_team" value="{{ $editing ? $game->home_team : '' }}" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" {{ !$isScheduled ? 'disabled' : '' }}>
                @error('home_team')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Home Team Color</label>
                <input type="color" name="home_color" value="{{ $editing ? $game->home_color : '#ffffff' }}" class="w-full border rounded-lg h-10" {{ !$isScheduled ? 'disabled' : '' }}>
                @error('home_color')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <!-- Away Team -->
        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Away Team *</label>
                <input type="text" name="away_team" value="{{ $editing ? $game->away_team : '' }}" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" {{ !$isScheduled ? 'disabled' : '' }}>
                @error('away_team')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Away Team Color</label>
                <input type="color" name="away_color" value="{{ $editing ? $game->away_color : '#ffffff' }}" class="w-full border rounded-lg h-10" {{ !$isScheduled ? 'disabled' : '' }}>
                @error('away_color')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <!-- Objective -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Objective of the Match</label>
            <textarea name="objective" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" rows="3" {{ !$isScheduled ? 'disabled' : '' }}>{{ $editing ? $game->objective : '' }}</textarea>
            @error('objective')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>

        <!-- Date and Time -->
        <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Date *</label>
                <input type="date" name="date" value="{{ $editing ? $game->date : '' }}" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" {{ !$isScheduled ? 'disabled' : '' }}>
                @error('date')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Time of Game *</label>
                <input type="time" name="time" value="{{ $editing ? $game->time : '' }}" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" {{ !$isScheduled ? 'disabled' : '' }}>
                @error('time')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Departure Time</label>
                <input type="time" name="departure_time" value="{{ $editing ? $game->departure_time : '' }}" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" {{ !$isScheduled ? 'disabled' : '' }}>
                @error('departure_time')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Expected Finish Time</label>
                <input type="time" name="expected_finish_time" value="{{ $editing ? $game->expected_finish_time : '' }}" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" {{ !$isScheduled ? 'disabled' : '' }}>
                @error('expected_finish_time')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Game Category *</label>
                <select name="category" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" {{ !$isScheduled ? 'disabled' : '' }}>
                    <option value="">Select category</option>
                    <option value="In house" {{ $editing && $game->category=='In house' ? 'selected' : '' }}>In House</option>
                    <option value="Friendly" {{ $editing && $game->category=='Friendly' ? 'selected' : '' }}>Friendly</option>
                    <option value="League" {{ $editing && $game->category=='League' ? 'selected' : '' }}>League</option>
                </select>
                @error('category')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <!-- Transport, Venue, Age Group, Country, City, Base, Gender -->
        <div class="mb-4 grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Transport *</label>
                <select name="transport" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" {{ !$isScheduled ? 'disabled' : '' }}>
                    <option value="">Select transport</option>
                    <option value="Self" {{ $editing && $game->transport=='Self' ? 'selected' : '' }}>Self</option>
                    <option value="Group" {{ $editing && $game->transport=='Group' ? 'selected' : '' }}>Group</option>
                </select>
                @error('transport')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Venue *</label>
                <input type="text" name="venue" value="{{ $editing ? $game->venue : '' }}" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" {{ !$isScheduled ? 'disabled' : '' }}>
                @error('venue')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Age Group *</label>
                <select name="age_group" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" {{ !$isScheduled ? 'disabled' : '' }}>
                    <option value="">Select age group</option>
                    <option value="u18" {{ $editing && $game->age_group=='u18' ? 'selected' : '' }}>U18</option>
                    <option value="u16" {{ $editing && $game->age_group=='u16' ? 'selected' : '' }}>U16</option>
                    <option value="u14" {{ $editing && $game->age_group=='u14' ? 'selected' : '' }}>U14</option>
                    <option value="u12" {{ $editing && $game->age_group=='u12' ? 'selected' : '' }}>U12</option>
                </select>
                @error('age_group')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="mb-4 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Country *</label>
                <select name="country" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" {{ !$isScheduled ? 'disabled' : '' }}>
                    <option value="">Select country</option>
                    <option value="Rwanda" {{ $editing && $game->country=='Rwanda' ? 'selected' : '' }}>Rwanda</option>
                    <option value="Tanzania" {{ $editing && $game->country=='Tanzania' ? 'selected' : '' }}>Tanzania</option>
                </select>
                @error('country')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                <input type="text" name="city" value="{{ $editing ? $game->city : '' }}" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" {{ !$isScheduled ? 'disabled' : '' }}>
                @error('city')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Base</label>
                <input type="text" name="base" value="{{ $editing ? $game->base : '' }}" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" {{ !$isScheduled ? 'disabled' : '' }}>
                @error('base')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gender *</label>
                <select name="gender" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" {{ !$isScheduled ? 'disabled' : '' }}>
                    <option value="">Select gender</option>
                    <option value="Male" {{ $editing && $game->gender=='Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ $editing && $game->gender=='Female' ? 'selected' : '' }}>Female</option>
                    <option value="Mixed" {{ $editing && $game->gender=='Mixed' ? 'selected' : '' }}>Mixed</option>
                </select>
                @error('gender')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <!-- Staff Selection -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Staff Assignment</label>
            <select name="staff_ids[]" multiple class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" {{ !$isScheduled ? 'disabled' : '' }}>
                @foreach($staffs as $staff)
                    <option value="{{ $staff->id }}" {{ $editing && in_array($staff->id, $game->staff_ids ?? []) ? 'selected' : '' }}>
                        {{ $staff->name }}
                    </option>
                @endforeach
            </select>
            @error('staff_ids')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            <label class="inline-flex items-center mt-2">
                <input type="checkbox" name="notify_staff" class="form-checkbox" {{ $editing && $game->notify_staff ? 'checked' : '' }} {{ !$isScheduled ? 'disabled' : '' }}>
                <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Send Email Notification to Staff</span>
            </label>
        </div>

        <!-- Player Selection -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Player List</label>
            <select name="player_ids[]" multiple class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" {{ !$isScheduled ? 'disabled' : '' }}>
                @foreach($players as $player)
                    <option value="{{ $player->id }}" {{ $editing && in_array($player->id, $game->player_ids ?? []) ? 'selected' : '' }}>
                        {{ $player->name }}
                    </option>
                @endforeach
            </select>
            @error('player_ids')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>
    </div>

    <!-- SECTION 2: MATCH REPORTING FIELDS (Only visible when reporting) -->
    @if($canReport)
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📊 Match Report
        </h2>

        <!-- Scores -->
        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Home Team Score</label>
                <input type="number" name="home_score" value="{{ $editing ? $game->home_score : '' }}" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" min="0">
                @error('home_score')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Away Team Score</label>
                <input type="number" name="away_score" value="{{ $editing ? $game->away_score : '' }}" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" min="0">
                @error('away_score')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <!-- Discipline Sanctions -->
        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Yellow Cards - Players</label>
                <select name="yellow_cards_players[]" multiple class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    @foreach($players as $player)
                        <option value="{{ $player->id }}" {{ $editing && in_array($player->id, $game->yellow_cards_players ?? []) ? 'selected' : '' }}>
                            {{ $player->name }}
                        </option>
                    @endforeach
                </select>
                @error('yellow_cards_players')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Red Cards - Players</label>
                <select name="red_cards_players[]" multiple class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    @foreach($players as $player)
                        <option value="{{ $player->id }}" {{ $editing && in_array($player->id, $game->red_cards_players ?? []) ? 'selected' : '' }}>
                            {{ $player->name }}
                        </option>
                    @endforeach
                </select>
                @error('red_cards_players')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="mb-4 grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Yellow Cards - Staff</label>
                <select name="yellow_cards_staff[]" multiple class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->id }}" {{ $editing && in_array($staff->id, $game->yellow_cards_staff ?? []) ? 'selected' : '' }}>
                            {{ $staff->name }}
                        </option>
                    @endforeach
                </select>
                @error('yellow_cards_staff')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Red Cards - Staff</label>
                <select name="red_cards_staff[]" multiple class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    @foreach($staffs as $staff)
                        <option value="{{ $staff->id }}" {{ $editing && in_array($staff->id, $game->red_cards_staff ?? []) ? 'selected' : '' }}>
                            {{ $staff->name }}
                        </option>
                    @endforeach
                </select>
                @error('red_cards_staff')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <!-- Incidence & Technical Feedback -->
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Incidence/Events</label>
            <textarea name="incidence" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" rows="4">{{ $editing ? $game->incidence : '' }}</textarea>
            @error('incidence')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Technical Feedback</label>
            <textarea name="technical_feedback" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" rows="4">{{ $editing ? $game->technical_feedback : '' }}</textarea>
            @error('technical_feedback')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>
    </div>
    @endif

    <!-- Submit Button -->
    <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-neutral-700">
        <a href="{{ route('admin.games.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-800 font-medium">Cancel</a>
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition">
            {{ $editing ? 'Update Match' : 'Create Match' }}
        </button>
    </div>
</form>
