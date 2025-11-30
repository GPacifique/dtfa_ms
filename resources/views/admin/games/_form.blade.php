@php
    $editing = isset($game);
@endphp

<form action="{{ $editing ? route('admin.games.update', $game) : route('admin.games.store') }}" method="POST">
    @csrf
    @if($editing)
        @method('PUT')
    @endif

    <!-- Sports Discipline -->
    <div class="mb-4">
        <label class="block font-semibold mb-1">Sports Discipline</label>
        <select name="discipline" class="border rounded w-full p-2">
            <option value="Football" {{ $editing && $match->discipline=='Football' ? 'selected' : '' }}>Football</option>
            <option value="Basketball" {{ $editing && $match->discipline=='Basketball' ? 'selected' : '' }}>Basketball</option>
        </select>
    </div>

    <!-- Home Team -->
    <div class="mb-4 grid grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold mb-1">Home Team</label>
            <input type="text" name="home_team" value="{{ $editing ? $match->home_team : '' }}" class="border rounded w-full p-2">
        </div>
        <div>
            <label class="block font-semibold mb-1">Home Team Color</label>
            <input type="color" name="home_color" value="{{ $editing ? $match->home_color : '#ffffff' }}" class="w-full h-10">
        </div>
    </div>

    <!-- Away Team -->
    <div class="mb-4 grid grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold mb-1">Away Team</label>
            <input type="text" name="away_team" value="{{ $editing ? $match->away_team : '' }}" class="border rounded w-full p-2">
        </div>
        <div>
            <label class="block font-semibold mb-1">Away Team Color</label>
            <input type="color" name="away_color" value="{{ $editing ? $match->away_color : '#ffffff' }}" class="w-full h-10">
        </div>
    </div>

    <!-- Objective -->
    <div class="mb-4">
        <label class="block font-semibold mb-1">Objective of the Match/Game</label>
        <textarea name="objective" class="border rounded w-full p-2">{{ $editing ? $match->objective : '' }}</textarea>
    </div>

    <!-- Date and Time -->
    <div class="mb-4 grid grid-cols-3 gap-4">
        <div>
            <label class="block font-semibold mb-1">Date</label>
            <input type="date" name="date" value="{{ $editing ? $match->date : '' }}" class="border rounded w-full p-2">
        </div>
        <div>
            <label class="block font-semibold mb-1">Time of Game</label>
            <input type="time" name="time" value="{{ $editing ? $match->time : '' }}" class="border rounded w-full p-2">
        </div>
        <div>
            <label class="block font-semibold mb-1">Departure Time</label>
            <input type="time" name="departure_time" value="{{ $editing ? $match->departure_time : '' }}" class="border rounded w-full p-2">
        </div>
    </div>

    <div class="mb-4 grid grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold mb-1">Expected Finish Time</label>
            <input type="time" name="expected_finish_time" value="{{ $editing ? $match->expected_finish_time : '' }}" class="border rounded w-full p-2">
        </div>
        <div>
            <label class="block font-semibold mb-1">Game Category</label>
            <select name="category" class="border rounded w-full p-2">
                <option value="In house" {{ $editing && $match->category=='In house' ? 'selected' : '' }}>In house</option>
                <option value="Friendly" {{ $editing && $match->category=='Friendly' ? 'selected' : '' }}>Friendly</option>
                <option value="League" {{ $editing && $match->category=='League' ? 'selected' : '' }}>League</option>
            </select>
        </div>
    </div>

    <!-- Transport, Venue, Age Group, Country, City, Base, Gender -->
    <div class="mb-4 grid grid-cols-3 gap-4">
        <div>
            <label class="block font-semibold mb-1">Transport Arrangement</label>
            <select name="transport" class="border rounded w-full p-2">
                <option value="Self" {{ $editing && $match->transport=='Self' ? 'selected' : '' }}>Self</option>
                <option value="Group" {{ $editing && $match->transport=='Group' ? 'selected' : '' }}>Group</option>
            </select>
        </div>
        <div>
            <label class="block font-semibold mb-1">Venue</label>
            <input type="text" name="venue" value="{{ $editing ? $match->venue : '' }}" class="border rounded w-full p-2">
        </div>
        <div>
            <label class="block font-semibold mb-1">Age Group</label>
            <input type="text" name="age_group" value="{{ $editing ? $match->age_group : '' }}" class="border rounded w-full p-2">
        </div>
    </div>

    <div class="mb-4 grid grid-cols-4 gap-4">
        <div>
            <label class="block font-semibold mb-1">Country</label>
            <select name="country" class="border rounded w-full p-2">
                <option value="Rwanda" {{ $editing && $match->country=='Rwanda' ? 'selected' : '' }}>Rwanda</option>
                <option value="Tanzania" {{ $editing && $match->country=='Tanzania' ? 'selected' : '' }}>Tanzania</option>
            </select>
        </div>
        <div>
            <label class="block font-semibold mb-1">City</label>
            <select name="city" class="border rounded w-full p-2">
                <option value="Kigali" {{ $editing && $match->city=='Kigali' ? 'selected' : '' }}>Kigali</option>
                <option value="Nyamagana" {{ $editing && $match->city=='Nyamagana' ? 'selected' : '' }}>Nyamagana</option>
            </select>
        </div>
        <div>
            <label class="block font-semibold mb-1">Base</label>
            <select name="base" class="border rounded w-full p-2">
                <option value="IPRC Kicukiro" {{ $editing && $match->base=='IPRC Kicukiro' ? 'selected' : '' }}>IPRC Kicukiro</option>
                <option value="Nyamagana" {{ $editing && $match->base=='Nyamagana' ? 'selected' : '' }}>Nyamagana</option>
            </select>
        </div>
        <div>
            <label class="block font-semibold mb-1">Gender</label>
            <select name="gender" class="border rounded w-full p-2">
                <option value="Male" {{ $editing && $match->gender=='Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ $editing && $match->gender=='Female' ? 'selected' : '' }}>Female</option>
                <option value="Mixed" {{ $editing && $match->gender=='Mixed' ? 'selected' : '' }}>Mixed</option>
            </select>
        </div>
    </div>

    <!-- Staff Selection -->
    <div class="mb-4">
        <label class="block font-semibold mb-1">Name of Staffs</label>
        <select name="staff_ids[]" multiple class="border rounded w-full p-2">
            @foreach($staffs as $staff)
                <option value="{{ $staff->id }}" {{ $editing && in_array($staff->id, $match->staff_ids ?? []) ? 'selected' : '' }}>
                    {{ $staff->name }}
                </option>
            @endforeach
        </select>
        <label class="inline-flex items-center mt-2">
            <input type="checkbox" name="notify_staff" class="form-checkbox" {{ $editing && $match->notify_staff ? 'checked' : '' }}>
            <span class="ml-2">Send Email Notification to Staff</span>
        </label>
    </div>

    <!-- Player Selection -->
    <div class="mb-4">
        <label class="block font-semibold mb-1">Player List</label>
        <select name="player_ids[]" multiple class="border rounded w-full p-2">
            @foreach($players as $player)
                <option value="{{ $player->id }}" {{ $editing && in_array($player->id, $match->player_ids ?? []) ? 'selected' : '' }}>
                    {{ $player->name }}
                </option>
            @endforeach
        </select>
    </div>

    <!-- Scores -->
    <div class="mb-4 grid grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold mb-1">Home Team Score</label>
            <input type="number" name="home_score" value="{{ $editing ? $match->home_score : '' }}" class="border rounded w-full p-2">
        </div>
        <div>
            <label class="block font-semibold mb-1">Away Team Score</label>
            <input type="number" name="away_score" value="{{ $editing ? $match->away_score : '' }}" class="border rounded w-full p-2">
        </div>
    </div>

    <!-- Discipline Sanctions -->
    <div class="mb-4 grid grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold mb-1">Yellow Cards - Players</label>
            <select name="yellow_cards_players[]" multiple class="border rounded w-full p-2">
                @foreach($players as $player)
                    <option value="{{ $player->id }}" {{ $editing && in_array($player->id, $match->yellow_cards_players ?? []) ? 'selected' : '' }}>
                        {{ $player->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-semibold mb-1">Red Cards - Players</label>
            <select name="red_cards_players[]" multiple class="border rounded w-full p-2">
                @foreach($players as $player)
                    <option value="{{ $player->id }}" {{ $editing && in_array($player->id, $match->red_cards_players ?? []) ? 'selected' : '' }}>
                        {{ $player->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="mb-4 grid grid-cols-2 gap-4">
        <div>
            <label class="block font-semibold mb-1">Yellow Cards - Staff</label>
            <select name="yellow_cards_staff[]" multiple class="border rounded w-full p-2">
                @foreach($staffs as $staff)
                    <option value="{{ $staff->id }}" {{ $editing && in_array($staff->id, $match->yellow_cards_staff ?? []) ? 'selected' : '' }}>
                        {{ $staff->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block font-semibold mb-1">Red Cards - Staff</label>
            <select name="red_cards_staff[]" multiple class="border rounded w-full p-2">
                @foreach($staffs as $staff)
                    <option value="{{ $staff->id }}" {{ $editing && in_array($staff->id, $match->red_cards_staff ?? []) ? 'selected' : '' }}>
                        {{ $staff->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Incidence & Technical Feedback -->
    <div class="mb-4">
        <label class="block font-semibold mb-1">Incidence</label>
        <textarea name="incidence" class="border rounded w-full p-2">{{ $editing ? $match->incidence : '' }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block font-semibold mb-1">Technical Feedback</label>
        <textarea name="technical_feedback" class="border rounded w-full p-2">{{ $editing ? $match->technical_feedback : '' }}</textarea>
    </div>

    <div>
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">
            {{ $editing ? 'Update Match' : 'Create Match' }}
        </button>
    </div>
</form>
