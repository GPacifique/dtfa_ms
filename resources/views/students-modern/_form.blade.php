@csrf
<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <x-input name="first_name" label="First Name" :value="$student->first_name ?? null" required />
    <x-input name="second_name" label="Last Name" :value="$student->second_name ?? null" required />
    <x-input type="date" name="dob" label="Date of Birth" :value="isset($student) && $student->dob ? $student->dob->format('Y-m-d') : null" />
    <x-select name="gender" label="Gender" :options="['male' => 'Male','female' => 'Female']" :value="$student->gender ?? null" placeholder="—" />
    <x-input name="email" type="email" label="Email" :value="$student->email ?? null" />
    <x-input name="phone" label="Phone" :value="$student->phone ?? null" />
    <x-select name="status" label="Status" :options="['active' => 'Active','inactive' => 'Inactive']" :value="$student->status ?? 'active'" />
    <x-input type="datetime-local" name="joined_at" label="Joined At" :value="isset($student) && $student->joined_at ? $student->joined_at->format('Y-m-d\TH:i') : null" />
    <x-select name="branch_id" label="Branch" :options="$branches->pluck('name','id')" :value="$student->branch_id ?? null" placeholder="—" />
    <x-select name="group_id" label="Group" :options="$groups->pluck('name','id')" :value="$student->group_id ?? null" placeholder="—" />
    <div class="space-y-1 md:col-span-2">
        <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Profile Image</label>
        <input type="file" name="photo" accept="image/*" class="w-full px-3 py-2 rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100" />
        @if(!empty($student?->photo_path))
            <div class="mt-2"><img src="{{ $student->photo_url }}" class="h-20 rounded object-cover" /></div>
        @endif
    </div>
</div>
<div class="mt-4 flex items-center gap-2">
    <x-button type="submit">{{ $buttonText ?? 'Save' }}</x-button>
    <x-button variant="secondary" type="button" onclick="history.back()">Cancel</x-button>
</div>
