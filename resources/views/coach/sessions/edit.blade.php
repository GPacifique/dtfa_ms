@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">✏️ Edit Session</h1>
    <a href="{{ url()->previous() }}" class="text-sm underline text-indigo-600 hover:text-indigo-800">← Back</a>
    </div>
    <form method="POST" action="{{ route('coach.sessions.update', $session) }}" class="bg-white dark:bg-neutral-900 shadow rounded-lg p-6 space-y-5">
        @csrf
        @method('PUT')
        <div>
            <label class="block text-sm font-medium mb-2">Date <span class="text-red-500">*</span></label>
            <input type="date" name="date" value="{{ old('date', $session->date->format('Y-m-d')) }}" class="w-full border rounded px-3 py-2 dark:bg-neutral-900 dark:border-neutral-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
            @error('date')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium mb-2">Start Time <span class="text-red-500">*</span></label>
                <input type="time" name="start_time" value="{{ old('start_time', $session->start_time) }}" class="w-full border rounded px-3 py-2 dark:bg-neutral-900 dark:border-neutral-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('start_time')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">End Time <span class="text-red-500">*</span></label>
                <input type="time" name="end_time" value="{{ old('end_time', $session->end_time) }}" class="w-full border rounded px-3 py-2 dark:bg-neutral-900 dark:border-neutral-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                @error('end_time')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium mb-2">Location <span class="text-red-500">*</span></label>
            <input type="text" name="location" value="{{ old('location', $session->location) }}" class="w-full border rounded px-3 py-2 dark:bg-neutral-900 dark:border-neutral-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
            @error('location')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-2">Select Group <span class="text-red-500">*</span></label>
            <select name="group_id" class="w-full border rounded px-3 py-2 dark:bg-neutral-900 dark:border-neutral-700 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" required>
                <option value="">-- Choose a group --</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}" @selected(old('group_id', $session->group_id) == $group->id)>
                        {{ $group->name }}
                    </option>
                @endforeach
            </select>
            @error('group_id')<p class="text-sm text-red-600 mt-1">{{ $message }}</p>@enderror
        </div>
        <div class="flex items-center justify-end gap-2 pt-4 border-t dark:border-neutral-700">
            <a href="{{ route('coach.sessions.show', $session) }}" class="px-4 py-2 border rounded hover:bg-slate-50 dark:hover:bg-neutral-800">
                Cancel
            </a>
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition font-semibold">
                ✓ Update Session
            </button>
        </div>
    </form>
</div>
@endsection
