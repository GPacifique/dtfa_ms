@php
    $isEdit = isset($attendance) && $attendance->exists;
    $get = fn($k, $default='') => old($k, $isEdit ? ($attendance->$k ?? $default) : $default);
    $activityOptions = \App\Models\StaffAttendance::activityOptions();
    $statusOptions = \App\Models\StaffAttendance::statusOptions();
@endphp

<div class="grid grid-cols-1 gap-6">
    <div>
        <label class="block text-sm font-medium text-gray-700">Staff</label>
        <select name="staff_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            <option value="">-- Select Staff --</option>
            @foreach($staff as $s)
                <option value="{{ $s->id }}" {{ (string)$s->id === (string)$get('staff_id') ? 'selected' : '' }}>{{ $s->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Activity</label>
        <select name="activity_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @foreach($activityOptions as $opt)
                <option value="{{ $opt }}" {{ $get('activity_type') === $opt ? 'selected' : '' }}>{{ $opt }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Date</label>
        <input type="date" name="date" value="{{ $get('date') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" />
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
            @foreach($statusOptions as $sopt)
                <option value="{{ $sopt }}" {{ $get('status') === $sopt ? 'selected' : '' }}>{{ $sopt }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-gray-700">Notes</label>
        <textarea name="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ $get('notes') }}</textarea>
    </div>
</div>
