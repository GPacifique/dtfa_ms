@csrf
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <x-input name="first_name" label="First Name" :value="$student->first_name ?? null" required />
        <x-input name="second_name" label="Second Name" :value="$student->second_name ?? null" required />
        <x-input type="date" name="dob" label="Date of Birth" :value="isset($student) && $student->dob ? $student->dob->format('Y-m-d') : null" />
        <x-select name="gender" label="Gender" :options="['male' => 'Male','female' => 'Female']" :value="$student->gender ?? null" placeholder="—" />
        <x-select name="status" label="Status" :options="['active' => 'Active','inactive' => 'Inactive']" :value="$student->status ?? 'active'" />
        <x-input type="datetime-local" name="joined_at" label="Joined At" :value="isset($student) && $student->joined_at ? $student->joined_at->format('Y-m-d\TH:i') : null" />
        <x-select name="branch_id" label="Branch" :options="$branches->pluck('name','id')" :value="$student->branch_id ?? null" placeholder="—" />
        <x-select name="group_id" label="Group" :options="$groups->pluck('name','id')" :value="$student->group_id ?? null" placeholder="—" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <x-input name="email" type="email" label="Email" :value="$student->email ?? null" />
        <x-input name="phone" label="Phone" :value="$student->phone ?? null" />
        <x-input name="emergency_phone" label="Emergency Phone" :value="$student->emergency_phone ?? null" />
        <x-input name="school_name" label="School Name" :value="$student->school_name ?? null" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <x-input name="father_name" label="Father Name" :value="$student->father_name ?? null" />
        <x-input name="mother_name" label="Mother Name" :value="$student->mother_name ?? null" />
        <x-input name="program" label="Program" :value="$student->program ?? null" />
        <x-select name="membership_type" label="Membership Type" :options="$membershipTypes ?? []" :value="$student->membership_type ?? null" placeholder="Select membership type" />
        <x-input name="combination" label="Combination" :value="$student->combination ?? null" />
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <x-input name="jersey_number" label="Jersey Number" :value="$student->jersey_number ?? null" />
        <x-input name="jersey_name" label="Jersey Name" :value="$student->jersey_name ?? null" />
        <x-select name="sport_discipline" label="Sport Discipline" :options="($sportDisciplines ?? collect())->mapWithKeys(fn($d)=>[$d=>$d])->all()" :value="$student->sport_discipline ?? null" placeholder="Select sport" />
        <x-input name="position" label="Position" :value="$student->position ?? null" />
        <x-select name="coach" label="Coach" :options="($coaches ?? collect())->mapWithKeys(fn($c)=>[$c->name=>$c->name])->all()" :value="$student->coach ?? null" placeholder="Select coach" />
    </div>

    <div class="space-y-1">
        <label class="text-sm font-medium text-slate-700 dark:text-slate-300">Profile Image</label>
        <input type="file" name="photo" accept="image/*" class="w-full px-3 py-2 rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100" />
        @if(!empty($student?->photo_path))
            <div class="mt-2"><img src="{{ $student->photo_url }}" class="h-20 rounded object-cover" /></div>
        @endif
    </div>

    <div class="pt-2 flex items-center gap-2">
        <x-button type="submit">{{ $buttonText ?? 'Save' }}</x-button>
        <x-button variant="secondary" type="button" onclick="history.back()">Cancel</x-button>
    </div>
</div>
