@php
    $item = $item ?? null;
    $costType = old('cost_type', $item->cost_type ?? 'free');
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
    <div>
        <label class="block text-sm font-medium text-slate-700">First Name</label>
        <input name="first_name" value="{{ old('first_name', $item->first_name ?? '') }}" class="mt-1 block w-full rounded border-slate-200 shadow-sm" />
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Second Name</label>
        <input name="second_name" value="{{ old('second_name', $item->second_name ?? '') }}" class="mt-1 block w-full rounded border-slate-200 shadow-sm" />
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Discipline</label>
        <input name="discipline" value="{{ old('discipline', $item->discipline ?? '') }}" class="mt-1 block w-full rounded border-slate-200 shadow-sm" />
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Gender</label>
        <select name="gender" class="mt-1 block w-full rounded border-slate-200 shadow-sm">
            <option value="">-- Select --</option>
            <option value="Male" {{ (old('gender', $item->gender ?? '') === 'Male') ? 'selected' : '' }}>Male</option>
            <option value="Female" {{ (old('gender', $item->gender ?? '') === 'Female') ? 'selected' : '' }}>Female</option>
            <option value="Other" {{ (old('gender', $item->gender ?? '') === 'Other') ? 'selected' : '' }}>Other</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">DTFA Branch</label>
        <input name="branch" value="{{ old('branch', $item->branch ?? '') }}" class="mt-1 block w-full rounded border-slate-200 shadow-sm" />
    </div>

    <div class="sm:col-span-2">
        <label class="block text-sm font-medium text-slate-700">Role/Function</label>
        <input name="role_function" value="{{ old('role_function', $item->role_function ?? '') }}" class="mt-1 block w-full rounded border-slate-200 shadow-sm" />
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Training Name</label>
        <input name="training_name" value="{{ old('training_name', $item->training_name ?? '') }}" class="mt-1 block w-full rounded border-slate-200 shadow-sm" required />
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Institution Name</label>
        <input name="institution_name" value="{{ old('institution_name', $item->institution_name ?? '') }}" class="mt-1 block w-full rounded border-slate-200 shadow-sm" />
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Start Date</label>
        <input type="date" name="start_date" value="{{ old('start_date', isset($item->start_date) ? $item->start_date->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded border-slate-200 shadow-sm" />
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">End Date</label>
        <input type="date" name="end_date" value="{{ old('end_date', isset($item->end_date) ? $item->end_date->format('Y-m-d') : '') }}" class="mt-1 block w-full rounded border-slate-200 shadow-sm" />
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Channel</label>
        <select name="channel" class="mt-1 block w-full rounded border-slate-200 shadow-sm">
            <option value="">-- Select --</option>
            <option value="Face to face" {{ (old('channel', $item->channel ?? '') === 'Face to face') ? 'selected' : '' }}>Face to face</option>
            <option value="Virtual" {{ (old('channel', $item->channel ?? '') === 'Virtual') ? 'selected' : '' }}>Virtual</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Cost Type</label>
        <select name="cost_type" id="cost_type" class="mt-1 block w-full rounded border-slate-200 shadow-sm">
            <option value="free" {{ $costType === 'free' ? 'selected' : '' }}>Free</option>
            <option value="paid" {{ $costType === 'paid' ? 'selected' : '' }}>Paid</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Cost Amount (RWF)</label>
        <input name="cost_amount" type="number" step="0.01" value="{{ old('cost_amount', $item->cost_amount ?? '') }}" class="mt-1 block w-full rounded border-slate-200 shadow-sm" />
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Training Category</label>
        <select name="training_category" class="mt-1 block w-full rounded border-slate-200 shadow-sm">
            <option value="">-- Select --</option>
            <option value="In house" {{ (old('training_category', $item->training_category ?? '') === 'In house') ? 'selected' : '' }}>In house</option>
            <option value="Outside DTFA" {{ (old('training_category', $item->training_category ?? '') === 'Outside DTFA') ? 'selected' : '' }}>Outside DTFA</option>
        </select>
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Venue</label>
        <input name="venue" value="{{ old('venue', $item->venue ?? '') }}" class="mt-1 block w-full rounded border-slate-200 shadow-sm" />
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">City</label>
        <input name="city" value="{{ old('city', $item->city ?? '') }}" class="mt-1 block w-full rounded border-slate-200 shadow-sm" />
    </div>

    <div>
        <label class="block text-sm font-medium text-slate-700">Country</label>
        <input name="country" value="{{ old('country', $item->country ?? '') }}" class="mt-1 block w-full rounded border-slate-200 shadow-sm" />
    </div>
</div>
