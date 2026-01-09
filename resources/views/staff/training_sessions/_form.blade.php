@php
    $isEdit = isset($record) && $record->exists;
    $old = fn($k, $default='') => old($k, $isEdit ? ($record->$k ?? $default) : $default);
@endphp

<div class="grid grid-cols-1 gap-6">
    {{-- Training Objectives Section --}}
    <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
        <h2 class="text-lg font-bold text-blue-900 dark:text-blue-300 mb-6">🎯 Training Objectives</h2>

        <div class="space-y-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Main Topic</label>
                <input type="text" name="main_topic" value="{{ $old('main_topic') }}" placeholder="e.g., Passing techniques, Ball control" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500" />
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Area of Performance</label>
                <select name="area_performance" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    <option value="">-- Select area --</option>
                    <option value="Physical" {{ old('area_performance', $isEdit ? ($record->area_performance ?? '') : '') === 'Physical' ? 'selected' : '' }}>Physical</option>
                    <option value="Technical" {{ old('area_performance', $isEdit ? ($record->area_performance ?? '') : '') === 'Technical' ? 'selected' : '' }}>Technical</option>
                    <option value="Tactical" {{ old('area_performance', $isEdit ? ($record->area_performance ?? '') : '') === 'Tactical' ? 'selected' : '' }}>Tactical</option>
                    <option value="Mental" {{ old('area_performance', $isEdit ? ($record->area_performance ?? '') : '') === 'Mental' ? 'selected' : '' }}>Mental</option>
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Training Objective</label>
                <textarea name="training_objective" rows="3" placeholder="Describe the training objectives for this session" class="mt-1 block w-full rounded-md border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ $old('training_objective') }}</textarea>
            </div>
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
        <input type="date" name="date" value="{{ $old('date') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm" />
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Start Time</label>
            <input type="time" name="start_time" value="{{ $old('start_time') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Finish Time</label>
            <input type="time" name="finish_time" value="{{ $old('finish_time') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm" />
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Coach</label>
        @if(!empty($coaches) && count($coaches))
            <select name="coach_id" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm">
                <option value="">-- Select coach --</option>
                @foreach($coaches as $c)
                    <option value="{{ $c->id }}" {{ (int)old('coach_id', $isEdit ? ($record->coach_id ?? '') : '') === $c->id ? 'selected' : '' }}>{{ $c->name }}</option>
                @endforeach
            </select>
        @else
            <input type="text" name="coach_name" value="{{ $old('coach_name') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm" />
            <p class="text-xs text-gray-500 dark:text-gray-400">No coaches found — enter a name manually.</p>
        @endif
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Branch</label>
            @if(!empty($branches) && count($branches))
                <select name="branch" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm">
                    <option value="">-- Select branch --</option>
                    @foreach($branches as $b)
                        <option value="{{ $b }}" {{ old('branch', $isEdit ? ($record->branch ?? '') : '') === $b ? 'selected' : '' }}>{{ $b }}</option>
                    @endforeach
                </select>
            @else
                <input type="text" name="branch" value="{{ $old('branch') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm" />
            @endif
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Training Pitch</label>
            @if(!empty($pitches) && count($pitches))
                <select name="training_pitch" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm">
                    <option value="">-- Select pitch --</option>
                    @foreach($pitches as $p)
                        <option value="{{ $p }}" {{ old('training_pitch', $isEdit ? ($record->training_pitch ?? '') : '') === $p ? 'selected' : '' }}>{{ $p }}</option>
                    @endforeach
                </select>
            @else
                <input type="text" name="training_pitch" value="{{ $old('training_pitch') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm" />
            @endif
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Country</label>
            <select name="country" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm">
                <option value="">-- Select country --</option>
                <option value="Rwanda" {{ old('country', $isEdit ? ($record->country ?? '') : '') === 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
                <option value="Tanzania" {{ old('country', $isEdit ? ($record->country ?? '') : '') === 'Tanzania' ? 'selected' : '' }}>Tanzania</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">City</label>
            <select name="city" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm">
                <option value="">-- Select city --</option>
                <option value="Kigali" {{ old('city', $isEdit ? ($record->city ?? '') : '') === 'Kigali' ? 'selected' : '' }}>Kigali</option>
                <option value="Mwanza" {{ old('city', $isEdit ? ($record->city ?? '') : '') === 'Mwanza' ? 'selected' : '' }}>Mwanza</option>
            </select>
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sport Discipline</label>
            <select name="sport_discipline" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm">
                <option value="">-- Select discipline --</option>
                <option value="Football" {{ old('sport_discipline', $isEdit ? ($record->sport_discipline ?? '') : '') === 'Football' ? 'selected' : '' }}>Football</option>
                <option value="Basketball" {{ old('sport_discipline', $isEdit ? ($record->sport_discipline ?? '') : '') === 'Basketball' ? 'selected' : '' }}>Basketball</option>
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Other Training Pitch</label>
            <input type="text" name="other_training_pitch" value="{{ $old('other_training_pitch') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm" />
        </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Number of Kids</label>
            <input type="number" name="number_of_kids" value="{{ $old('number_of_kids') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm" />
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Incident Report</label>
            <input type="text" name="incident_report" value="{{ $old('incident_report') }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm" />
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Comments / Notes</label>
        <textarea name="comments" rows="3" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white shadow-sm">{{ $old('comments') }}</textarea>
    </div>
</div>
