@php
    $isEdit = isset($trainingSessionRecord) && $trainingSessionRecord->exists;
    $old = fn($k, $default='') => old($k, $isEdit ? ($trainingSessionRecord->$k ?? $default) : $default);
@endphp

<div class="grid grid-cols-1 gap-6">
    <div>
        <label class="block text-sm font-medium text-gray-700">Date</label>
        <input type="date" name="date" value="{{ $old('date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Start Time</label>
            <input type="time" name="start_time" value="{{ $old('start_time') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Finish Time</label>
            <input type="time" name="finish_time" value="{{ $old('finish_time') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Coach</label>
        @if(!empty($coaches) && count($coaches))
            <select name="coach_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">-- Select coach --</option>
                @foreach($coaches as $c)
                    <option value="{{ $c->id }}" {{ (int)old('coach_id', $isEdit ? ($trainingSessionRecord->coach_id ?? '') : '') === $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
            </select>
        @else
            <input type="text" name="coach_name" value="{{ $old('coach_name') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            <p class="text-xs text-gray-500">No coaches found — enter a name manually.</p>
        @endif
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Branch</label>
            @if(!empty($branches) && count($branches))
                <select name="branch" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">-- Select branch --</option>
                    @foreach($branches as $b)
                        <option value="{{ $b }}" {{ old('branch', $isEdit ? ($trainingSessionRecord->branch ?? '') : '') === $b ? 'selected' : '' }}>{{ $b }}</option>
                    @endforeach
                </select>
            @else
                <input type="text" name="branch" value="{{ $old('branch') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            @endif
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Training Pitch</label>
            @if(!empty($pitches) && count($pitches))
                <select name="training_pitch" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    <option value="">-- Select pitch --</option>
                    @foreach($pitches as $p)
                        <option value="{{ $p }}" {{ old('training_pitch', $isEdit ? ($trainingSessionRecord->training_pitch ?? '') : '') === $p ? 'selected' : '' }}>{{ $p }}</option>
                    @endforeach
                </select>
            @else
                <input type="text" name="training_pitch" value="{{ $old('training_pitch') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            @endif
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Country</label>
            <select name="country" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">-- Select country --</option>
                <option value="Rwanda" {{ old('country', $isEdit ? ($trainingSessionRecord->country ?? '') : '') === 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
                <option value="Tanzania" {{ old('country', $isEdit ? ($trainingSessionRecord->country ?? '') : '') === 'Tanzania' ? 'selected' : '' }}>Tanzania</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">City</label>
            <select name="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">-- Select city --</option>
                <option value="Kigali" {{ old('city', $isEdit ? ($trainingSessionRecord->city ?? '') : '') === 'Kigali' ? 'selected' : '' }}>Kigali</option>
                <option value="Mwanza" {{ old('city', $isEdit ? ($trainingSessionRecord->city ?? '') : '') === 'Mwanza' ? 'selected' : '' }}>Mwanza</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Sport Discipline</label>
            <select name="sport_discipline" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                <option value="">-- Select discipline --</option>
                <option value="Football" {{ old('sport_discipline', $isEdit ? ($trainingSessionRecord->sport_discipline ?? '') : '') === 'Football' ? 'selected' : '' }}>Football</option>
                <option value="Basketball" {{ old('sport_discipline', $isEdit ? ($trainingSessionRecord->sport_discipline ?? '') : '') === 'Basketball' ? 'selected' : '' }}>Basketball</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Other Training Pitch</label>
            <input type="text" name="other_training_pitch" value="{{ $old('other_training_pitch') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Main Topic</label>
        <input type="text" name="main_topic" value="{{ $old('main_topic') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Area of Performance</label>
        <select name="area_performance" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            <option value="">-- Select area --</option>
            <option value="Physical" {{ old('area_performance', $isEdit ? ($trainingSessionRecord->area_performance ?? '') : '') === 'Physical' ? 'selected' : '' }}>Physical</option>
            <option value="Technical" {{ old('area_performance', $isEdit ? ($trainingSessionRecord->area_performance ?? '') : '') === 'Technical' ? 'selected' : '' }}>Technical</option>
            <option value="Tactical" {{ old('area_performance', $isEdit ? ($trainingSessionRecord->area_performance ?? '') : '') === 'Tactical' ? 'selected' : '' }}>Tactical</option>
            <option value="Mental" {{ old('area_performance', $isEdit ? ($trainingSessionRecord->area_performance ?? '') : '') === 'Mental' ? 'selected' : '' }}>Mental</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Training Objective</label>
        <textarea name="training_objective" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $old('training_objective') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Part 1 — Introduction (Activities + Time)</label>
        <div class="grid grid-cols-1 gap-3">
            <div class="grid grid-cols-6 gap-2">
                <input type="text" name="part1_a1_desc" placeholder="Activity 1 description" value="{{ $old('part1_a1_desc') }}" class="col-span-4 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                <input type="text" name="part1_a1_time" placeholder="Time (e.g. 10m)" value="{{ $old('part1_a1_time') }}" class="col-span-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>
            <div class="grid grid-cols-6 gap-2">
                <input type="text" name="part1_a2_desc" placeholder="Activity 2 description" value="{{ $old('part1_a2_desc') }}" class="col-span-4 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                <input type="text" name="part1_a2_time" placeholder="Time" value="{{ $old('part1_a2_time') }}" class="col-span-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>
            <div class="grid grid-cols-6 gap-2">
                <input type="text" name="part1_a3_desc" placeholder="Activity 3 description" value="{{ $old('part1_a3_desc') }}" class="col-span-4 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                <input type="text" name="part1_a3_time" placeholder="Time" value="{{ $old('part1_a3_time') }}" class="col-span-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>
            <textarea name="part1_activities" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Optional notes for Part 1">{{ $old('part1_activities') }}</textarea>
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Part 2 — Main Topic (Activities + Time)</label>
        <div class="grid grid-cols-1 gap-3">
            <div class="grid grid-cols-6 gap-2">
                <input type="text" name="part2_a1_desc" placeholder="Activity 1 description" value="{{ $old('part2_a1_desc') }}" class="col-span-4 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                <input type="text" name="part2_a1_time" placeholder="Time" value="{{ $old('part2_a1_time') }}" class="col-span-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>
            <div class="grid grid-cols-6 gap-2">
                <input type="text" name="part2_a2_desc" placeholder="Activity 2 description" value="{{ $old('part2_a2_desc') }}" class="col-span-4 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                <input type="text" name="part2_a2_time" placeholder="Time" value="{{ $old('part2_a2_time') }}" class="col-span-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>
            <div class="grid grid-cols-6 gap-2">
                <input type="text" name="part2_a3_desc" placeholder="Activity 3 description" value="{{ $old('part2_a3_desc') }}" class="col-span-4 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
                <input type="text" name="part2_a3_time" placeholder="Time" value="{{ $old('part2_a3_time') }}" class="col-span-2 mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
            </div>
            <textarea name="part2_activities" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" placeholder="Optional notes for Part 2">{{ $old('part2_activities') }}</textarea>
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Part 3 — Notes</label>
        <textarea name="part3_notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $old('part3_notes') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Part 4 — Message</label>
        <textarea name="part4_message" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $old('part4_message') }}</textarea>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700">Number of Kids</label>
            <input type="number" name="number_of_kids" value="{{ $old('number_of_kids') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700">Incident Report</label>
            <input type="text" name="incident_report" value="{{ $old('incident_report') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Missed / Damaged Equipment</label>
        <textarea name="missed_damaged_equipment" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $old('missed_damaged_equipment') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Comments / Improvements for next session</label>
        <textarea name="comments" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $old('comments') }}</textarea>
    </div>
</div>
