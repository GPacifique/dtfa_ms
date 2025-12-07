@csrf
<div class="space-y-8">
    {{-- Basic Information Section --}}
    <div>
        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">👤 Basic Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-input name="first_name" label="First Name" :value="$student->first_name ?? null" required />
            <x-input name="second_name" label="Second Name" :value="$student->second_name ?? null" required />
            <x-input type="date" name="dob" label="📅 Date of Birth" :value="isset($student) && $student->dob ? $student->dob->format('Y-m-d') : null" />
            <x-select name="gender" label="👥 Gender" :options="['male' => 'Male','female' => 'Female']" :value="$student->gender ?? null" placeholder="—" />
            <x-select name="status" label="📌 Status" :options="['active' => 'Active','inactive' => 'Inactive']" :value="$student->status ?? 'active'" />
            <x-input type="datetime-local" name="joined_at" label="📍 Joined At" :value="isset($student) && $student->joined_at ? $student->joined_at->format('Y-m-d\TH:i') : null" />
            <x-select name="branch_id" label="🏢 Branch" :options="$branches->pluck('name','id')" :value="$student->branch_id ?? null" placeholder="—" />
            <x-select name="group_id" label="👥 Group" :options="$groups->pluck('name','id')" :value="$student->group_id ?? null" placeholder="—" />
        </div>
    </div>

    {{-- Contact Information Section --}}
    <div>
        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">📧 Contact Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-input name="player_email" type="email" label="🎯 Player Email" :value="$student->player_email ?? null" />
            <x-input name="parent_email" type="email" label="👨‍👩‍👧 Parent Email" :value="$student->parent_email ?? null" />
            <x-input name="player_phone" label="📱 Player Phone" :value="$student->player_phone ?? null" />
            <x-input name="emergency_phone" label="🚨 Emergency Phone" :value="$student->emergency_phone ?? null" />
        </div>
    </div>

    {{-- Family Information Section --}}
    <div>
        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">👨‍👩‍👦 Family Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-input name="father_name" label="👨 Father Name" :value="$student->father_name ?? null" />
            <x-input name="mother_name" label="👩 Mother Name" :value="$student->mother_name ?? null" />
            <x-input name="school_name" label="🏫 School Name" :value="$student->school_name ?? null" />
            <x-input name="emergency_phone" label="📍 Emergency Contact" :value="$student->emergency_phone ?? null" />
        </div>
    </div>

    {{-- Sports & Program Section --}}
    <div>
        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">⚽ Sports & Program</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-select name="sport_discipline" label="🏆 Sport Discipline" :options="($sportDisciplines ?? collect())->mapWithKeys(fn($d)=>[$d=>$d])->all()" :value="$student->sport_discipline ?? null" placeholder="Select sport" />
            @php
                $positions = [
                    'GK' => 'GK',
                    'Left back' => 'Left back',
                    'Right Back' => 'Right Back',
                    'Central Defender' => 'Central Defender',
                    'Full Back Defender' => 'Full Back Defender',
                    'Midfield Defender' => 'Midfield Defender',
                    'Rightwing' => 'Rightwing',
                    'Midfield offensive' => 'Midfield offensive',
                    'Striker' => 'Striker',
                    'DD' => 'DD',
                    'Leftwing' => 'Leftwing',
                ];
            @endphp
            <x-select name="position" label="📍 Position" :options="$positions" :value="$student->position ?? null" placeholder="Select position" />
            <x-select name="coach" label="👨‍🏫 Coach" :options="($coaches ?? collect())->mapWithKeys(fn($c)=>[$c->name=>$c->name])->all()" :value="$student->coach ?? null" placeholder="Select coach" />
        </div>
    </div>

    {{-- Jersey Information Section --}}
    <div>
        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">👕 Jersey Information</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <x-input name="jersey_number" label="🔢 Jersey Number" :value="$student->jersey_number ?? null" />
            <x-input name="jersey_name" label="📝 Jersey Name" :value="$student->jersey_name ?? null" />
            <x-input name="program" label="📋 Program" :value="$student->program ?? null" />
        </div>
    </div>

    {{-- Membership & Training Days Section --}}
    <div>
        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">🎯 Membership & Training</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <x-select name="membership_type" label="💳 Membership Type" :options="$membershipTypes ?? []" :value="$student->membership_type ?? null" placeholder="Select membership type" />
        </div>

        <div class="p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
            <label class="block text-sm font-bold text-blue-900 dark:text-blue-300 mb-4">📆 Training Days</label>
            <div class="grid grid-cols-4 md:grid-cols-7 gap-2">
                @php
                    $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                    $selectedDays = old('training_days', isset($student) && $student->training_days ? $student->training_days : []);
                @endphp
                @foreach($days as $day)
                    <label class="flex flex-col items-center gap-2 cursor-pointer p-3 border border-slate-300 dark:border-slate-600 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-900/30 transition">
                        <input type="checkbox" name="training_days[]" value="{{ $day }}" {{ in_array($day, (array)$selectedDays) ? 'checked' : '' }} class="rounded border-slate-300 dark:border-slate-600 text-blue-600 dark:bg-slate-700 focus:ring-blue-500" />
                        <span class="text-sm font-semibold text-slate-700 dark:text-slate-300">{{ substr($day, 0, 3) }}</span>
                    </label>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Photo Upload Section --}}
    <div>
        <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">📸 Profile Photo</h2>
        <div class="p-6 bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg space-y-4">
            <input type="file" name="photo" id="photoInput" accept="image/*" class="w-full px-4 py-2 rounded-lg border border-green-300 dark:border-green-700 bg-white dark:bg-slate-700 text-slate-900 dark:text-white font-semibold cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-bold file:bg-green-200 dark:file:bg-green-900/50 file:text-green-800 dark:file:text-green-300 hover:file:bg-green-300 transition" onchange="previewImage(event)" />
            <p class="text-xs text-slate-600 dark:text-slate-400">📷 Supported: JPEG, PNG, GIF • Max: 2MB</p>

            {{-- Image Preview --}}
            <div id="imagePreviewContainer" class="mt-4 {{ !empty($student?->photo_path) ? '' : 'hidden' }}">
                <div class="relative inline-block">
                    <img id="imagePreview" src="{{ $student?->photo_url ?? '' }}" class="h-40 w-40 rounded-lg object-cover border-4 border-green-300 dark:border-green-700 shadow-lg" />
                    <button type="button" onclick="clearImage()" class="absolute -top-3 -right-3 bg-red-500 hover:bg-red-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-lg font-bold transition shadow-lg">×</button>
                </div>
                <p class="text-xs text-slate-600 dark:text-slate-400 mt-2">✓ Preview</p>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                    document.getElementById('imagePreviewContainer').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        }

        function clearImage() {
            document.getElementById('photoInput').value = '';
            document.getElementById('imagePreviewContainer').classList.add('hidden');
            document.getElementById('imagePreview').src = '';
        }
    </script>

    {{-- Action Buttons --}}
    <div class="flex items-center gap-3 pt-6 border-t border-slate-200 dark:border-slate-700">
        <x-button type="submit" class="text-lg font-bold px-8 py-3">✓ {{ $buttonText ?? 'Save Student' }}</x-button>
        <x-button variant="secondary" type="button" onclick="history.back()" class="text-lg font-bold px-8 py-3">Cancel</x-button>
    </div>
</div>
