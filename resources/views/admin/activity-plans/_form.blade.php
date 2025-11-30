@php
    $editing = isset($activityPlan);
@endphp

<form action="{{ $editing ? route('admin.activity-plans.update', $activityPlan) : route('admin.activity-plans.store') }}" method="POST" class="max-w-4xl mx-auto bg-white dark:bg-neutral-900 shadow rounded-lg p-6">
    @csrf
    @if($editing)
        @method('PUT')
    @endif

    <!-- Status Badge -->
    @if($editing)
    <div class="mb-6 p-4 rounded-lg {{ $activityPlan->status === 'red' ? 'bg-red-50 dark:bg-red-900' : ($activityPlan->status === 'yellow' ? 'bg-yellow-50 dark:bg-yellow-900' : 'bg-green-50 dark:bg-green-900') }}">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="font-semibold text-gray-900 dark:text-white">Plan Status</h3>
                <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                    {{ $activityPlan->status === 'red' ? '🔴 Not Achieved - Plan targets not met' : ($activityPlan->status === 'yellow' ? '🟡 Ongoing - Plan in progress' : '🟢 Achieved - Plan completed successfully') }}
                </p>
            </div>
            <span class="px-4 py-2 rounded-full font-semibold {{ $activityPlan->status === 'red' ? 'bg-red-200 text-red-800' : ($activityPlan->status === 'yellow' ? 'bg-yellow-200 text-yellow-800' : 'bg-green-200 text-green-800') }}">
                {{ $activityPlan->status === 'red' ? 'Not Achieved' : ($activityPlan->status === 'yellow' ? 'Ongoing' : 'Achieved') }}
            </span>
        </div>
    </div>
    @endif

    <!-- Basic Information -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📋 Basic Information
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <!-- Year -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Year *</label>
                <input type="number" name="year" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" min="2000" max="2100" value="{{ $editing ? $activityPlan->year : '' }}" required>
                @error('year')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <!-- Country -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Country *</label>
                <select name="country" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" required>
                    <option value="">Select Country</option>
                    <option value="Rwanda" {{ $editing && $activityPlan->country === 'Rwanda' ? 'selected' : '' }}>Rwanda</option>
                    <option value="Tanzania" {{ $editing && $activityPlan->country === 'Tanzania' ? 'selected' : '' }}>Tanzania</option>
                </select>
                @error('country')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Challenge *</label>
            <input type="text" name="challenge" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Describe the challenge" value="{{ $editing ? $activityPlan->challenge : '' }}" required>
            @error('challenge')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Opportunity *</label>
            <input type="text" name="opportunity" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Describe the opportunity" value="{{ $editing ? $activityPlan->opportunity : '' }}" required>
            @error('opportunity')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Baseline *</label>
            <textarea name="baseline" rows="3" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Current baseline situation" required>{{ $editing ? $activityPlan->baseline : '' }}</textarea>
            @error('baseline')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>
    </div>

    <!-- Intervention & Objectives -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            🎯 Intervention & Objectives
        </h2>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Intervention/Objective *</label>
            <textarea name="intervention_objective" rows="4" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Describe the intervention and objectives" required>{{ $editing ? $activityPlan->intervention_objective : '' }}</textarea>
            @error('intervention_objective')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">List of Activities (one per line) *</label>
            <textarea name="list_of_activities" rows="5" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700 text-sm font-mono" placeholder="Activity 1&#10;Activity 2&#10;Activity 3" required>@if($editing && $activityPlan->list_of_activities){{ implode("\n", $activityPlan->list_of_activities) }}@endif</textarea>
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Enter each activity on a new line</p>
            @error('list_of_activities')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Key Performance Indicator (KPI) *</label>
            <input type="text" name="kpi" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="e.g., 80% of activities completed by Q4" value="{{ $editing ? $activityPlan->kpi : '' }}" required>
            @error('kpi')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>
    </div>

    <!-- Responsible Person & Focus Area -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            👥 Accountability & Focus
        </h2>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Responsible Person (Staff Member) *</label>
            <select name="responsible_person_id" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" required>
                <option value="">Select Staff Member</option>
                @foreach($staff as $person)
                    <option value="{{ $person->id }}" {{ $editing && $activityPlan->responsible_person_id === $person->id ? 'selected' : '' }}>
                        {{ $person->name ?? $person->email }}
                    </option>
                @endforeach
            </select>
            @error('responsible_person_id')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Focus Area *</label>
            <select name="focus_area" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" required>
                <option value="">Select Focus Area</option>
                @foreach($focusAreas as $area)
                    <option value="{{ $area }}" {{ $editing && $activityPlan->focus_area === $area ? 'selected' : '' }}>
                        {{ $area }}
                    </option>
                @endforeach
            </select>
            @error('focus_area')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
        </div>
    </div>

    <!-- Timeline & Cost -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📅 Timeline & Budget
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <!-- Starting Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Starting Date *</label>
                <input type="date" name="starting_date" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="{{ $editing ? $activityPlan->starting_date->format('Y-m-d') : '' }}" required>
                @error('starting_date')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <!-- Ending Date -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ending Date *</label>
                <input type="date" name="ending_date" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" value="{{ $editing ? $activityPlan->ending_date->format('Y-m-d') : '' }}" required>
                @error('ending_date')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <!-- Cost -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Budget Cost *</label>
                <input type="number" name="cost" step="0.01" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="0.00" value="{{ $editing ? $activityPlan->cost : '' }}" required>
                @error('cost')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <!-- Financing Mechanism -->
            <div>
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Financing Mechanism *</label>
                <input type="text" name="financing_mechanism" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="e.g., Government Budget, Donor Funds, Self-funding" value="{{ $editing ? $activityPlan->financing_mechanism : '' }}" required>
                @error('financing_mechanism')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <!-- Status Remarks -->
    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-neutral-700">
            📝 Additional Remarks
        </h2>

        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status Remarks (Optional)</label>
            <textarea name="status_remarks" rows="3" class="w-full border rounded-lg px-3 py-2 dark:bg-neutral-800 dark:border-neutral-700" placeholder="Add any relevant notes about the plan's progress or challenges...">{{ $editing ? $activityPlan->status_remarks : '' }}</textarea>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-between items-center">
        <a href="{{ route('admin.activity-plans.index') }}" class="px-4 py-2 border rounded-lg text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-neutral-800 font-medium transition">
            ← Cancel
        </a>
        <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium transition">
            {{ $editing ? '💾 Update Plan' : '✅ Create Plan' }}
        </button>
    </div>
</form>
