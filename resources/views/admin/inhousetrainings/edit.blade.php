@extends('layouts.app')

@push('hero')
    <x-hero title="{{ __('app.edit_capacity_building') }}" subtitle="{{ __('app.update_training_details') }}">
        <div class="mt-4">

        </div>
    </x-hero>
@endpush

@section('content')
<div class="max-w-4xl mx-auto p-6">

    <form action="{{ route('admin.inhousetrainings.update', $training->id) }}" method="POST" class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">First Name</label>
                <input type="text" name="first_name" value="{{ old('first_name', $training->first_name) }}" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                @error('first_name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Second Name</label>
                <input type="text" name="second_name" value="{{ old('second_name', $training->second_name) }}" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                @error('second_name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Gender</label>
                <select name="gender" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="">Select Gender</option>
                    <option value="Male" @selected(old('gender', $training->gender) === 'Male')>Male</option>
                    <option value="Female" @selected(old('gender', $training->gender) === 'Female')>Female</option>
                </select>
                @error('gender')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Country</label>
                <select name="country" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="Rwanda" @selected(old('country', $training->country) === 'Rwanda')>Rwanda</option>
                    <option value="Tanzania" @selected(old('country', $training->country) === 'Tanzania')>Tanzania</option>
                </select>
                @error('country')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                <select name="city" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="Kigali" @selected(old('city', $training->city) === 'Kigali')>Kigali</option>
                    <option value="Mwanza" @selected(old('city', $training->city) === 'Mwanza')>Mwanza</option>
                </select>
                @error('city')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Discipline</label>
                <select name="discipline" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="Football" @selected(old('discipline', $training->discipline) === 'Football')>Football</option>
                    <option value="Basketball" @selected(old('discipline', $training->discipline) === 'Basketball')>Basketball</option>
                </select>
                @error('discipline')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Branch</label>
                <select name="branch_id" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="">Select Branch</option>
                    @foreach ($branches as $b)
                        <option value="{{ $b->id }}" @selected(old('branch_id', $training->branch_id) == $b->id)>{{ $b->name }}</option>
                    @endforeach
                </select>
                @error('branch_id')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Role</label>
                <select name="role_id" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="">Select Role</option>
                    @foreach ($roles as $r)
                        <option value="{{ $r->id }}" @selected(old('role_id', $training->role_id) == $r->id)>{{ $r->name }}</option>
                    @endforeach
                </select>
                @error('role_id')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Training Name</label>
                <input type="text" name="training_name" value="{{ old('training_name', $training->training_name) }}" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                @error('training_name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Channel</label>
                <select name="channel" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                    <option value="">Select Channel</option>
                    <option value="In person" @selected(old('channel', $training->channel) === 'In person')>In person</option>
                    <option value="virtual" @selected(old('channel', $training->channel) === 'virtual')>virtual</option>
                </select>
                @error('channel')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Training Date</label>
                <input type="date" name="training_date" value="{{ old('training_date', $training->training_date?->format('Y-m-d')) }}" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                @error('training_date')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Start Date & Time</label>
                <input type="datetime-local" name="start" value="{{ old('start', $training->start?->format('Y-m-d\TH:i')) }}" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                @error('start')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">End Date & Time</label>
                <input type="datetime-local" name="end" value="{{ old('end', $training->end?->format('Y-m-d\TH:i')) }}" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                @error('end')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cost Type <span class="text-red-500">*</span></label>
                <select name="cost" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" required>
                    <option value="Paid" @selected(old('cost', $training->cost) === 'Paid')>Paid</option>
                    <option value="Free" @selected(old('cost', $training->cost) === 'Free')>Free</option>
                </select>
                @error('cost')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Training Category <span class="text-red-500">*</span></label>
                <select name="training_category" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" required>
                    <option value="In house" @selected(old('training_category', $training->training_category) === 'In house')>In House</option>
                    <option value="Outside DTFA" @selected(old('training_category', $training->training_category) === 'Outside DTFA')>Outside DTFA</option>
                </select>
                @error('training_category')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Venue</label>
                <input type="text" name="venue" value="{{ old('venue', $training->venue) }}" placeholder="e.g., Conference Room A" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                @error('venue')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Location</label>
                <input type="text" name="location" value="{{ old('location', $training->location) }}" placeholder="e.g., Main Office Building" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                @error('location')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Trainer Name</label>
                <input type="text" name="trainer_name" value="{{ old('trainer_name', $training->trainer_name) }}" placeholder="e.g., John Doe" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">
                @error('trainer_name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Did participant receive certificate?</label>
                <div class="flex items-center space-x-4">
                    <label class="flex items-center">
                        <input type="radio" name="certificate_received" value="1" class="form-radio" @checked(old('certificate_received', $training->certificate_received) == '1')>
                        <span class="ml-2">Yes</span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="certificate_received" value="0" class="form-radio" @checked(old('certificate_received', $training->certificate_received) == '0')>
                        <span class="ml-2">No</span>
                    </label>
                </div>
                @error('certificate_received')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Notes</label>
                <textarea name="notes" rows="4" placeholder="Additional notes or description..." class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700">{{ old('notes', $training->notes) }}</textarea>
                @error('notes')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

        </div>

        <div class="flex items-center justify-end gap-2 pt-6 border-t border-gray-200 dark:border-neutral-700">
            <a href="{{ route('admin.inhousetrainings.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-100 dark:hover:bg-neutral-800 font-medium">Cancel</a>
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 font-medium transition">Update Training</button>
        </div>
    </form>
</div>
@endsection
