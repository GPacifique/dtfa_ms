@extends('layouts.app')

@section('content')
@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Create New Session</h1>
        <a href="{{ route('coach.sessions.index') }}" class="px-4 py-2 border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 font-semibold transition">
            ← Back
        </a>
    </div>

    <form method="POST" action="{{ route('coach.sessions.store') }}" class="space-y-6">
        @csrf

        <!-- Date -->
        <div>
            <label for="date" class="block text-sm font-medium text-slate-700">Date</label>
            <input type="date" name="date" id="date" value="{{ old('date', now()->format('Y-m-d')) }}" required
                   class="mt-1 block w-full border-slate-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('date')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Start and End Time -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="start_time" class="block text-sm font-medium text-slate-700">Start Time</label>
                <input type="time" name="start_time" id="start_time" value="{{ old('start_time') }}" required
                       class="mt-1 block w-full border-slate-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('start_time')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="end_time" class="block text-sm font-medium text-slate-700">End Time</label>
                <input type="time" name="end_time" id="end_time" value="{{ old('end_time') }}" required
                       class="mt-1 block w-full border-slate-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('end_time')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Location -->
        <div>
            <label for="location" class="block text-sm font-medium text-slate-700">Location</label>
            <input type="text" name="location" id="location" value="{{ old('location', $branch->name ?? '') }}" required
                   class="mt-1 block w-full border-slate-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
            @error('location')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Group -->
        <div>
            <label for="group_id" class="block text-sm font-medium text-slate-700">Group</label>
            <select name="group_id" id="group_id" required
                    class="mt-1 block w-full border-slate-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                <option value="">Select a group</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
            @error('group_id')
                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold transition">
                Create Session
            </button>
        </div>
    </form>
</div>
@endsection

@endsection
