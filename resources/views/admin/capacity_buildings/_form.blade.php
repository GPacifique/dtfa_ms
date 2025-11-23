@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-slate-700">Date</label>
        <input type="date" name="date" value="{{ old('date', optional(optional($session)->date)->toDateString() ?? '') }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Start Time</label>
        <input type="time" name="start_time" value="{{ old('start_time', $session->start_time ?? '') }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">End Time</label>
        <input type="time" name="end_time" value="{{ old('end_time', $session->end_time ?? '') }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Location</label>
        <input type="text" name="location" value="{{ old('location', $session->location ?? '') }}" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Branch</label>
            <select name="branch_id" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required>
            <option value="">-- Select branch --</option>
            @foreach($branches as $b)
                <option value="{{ $b->id }}" {{ (old('branch_id', optional($session)->branch_id ?? '') == $b->id) ? 'selected' : '' }}>{{ $b->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Group</label>
            <select name="group_id" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required>
            <option value="">-- Select group --</option>
            @foreach($groups as $g)
                <option value="{{ $g->id }}" {{ (old('group_id', optional($session)->group_id ?? '') == $g->id) ? 'selected' : '' }}>{{ $g->name }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Coach</label>
            <select name="coach_user_id" class="mt-1 block w-full rounded-md border-gray-200 shadow-sm" required>
            <option value="">-- Select coach --</option>
            @foreach($coaches as $c)
                <option value="{{ $c->id }}" {{ (old('coach_user_id', optional($session)->coach_user_id ?? '') == $c->id) ? 'selected' : '' }}>{{ $c->name }}</option>
            @endforeach
        </select>
    </div>
</div>

@if($errors->any())
    <div class="mt-4 text-sm text-rose-600">
        <ul>
            @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif
