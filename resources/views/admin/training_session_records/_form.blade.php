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

    <div>
        <label class="block text-sm font-medium text-gray-700">Main Topic</label>
        <input type="text" name="main_topic" value="{{ $old('main_topic') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Area of Performance</label>
        <input type="text" name="area_performance" value="{{ $old('area_performance') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Part 1 — Activities / Notes</label>
        <textarea name="part1_activities" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $old('part1_activities') }}</textarea>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Part 2 — Activities / Notes</label>
        <textarea name="part2_activities" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $old('part2_activities') }}</textarea>
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
</div>
