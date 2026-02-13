@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Create Communication</h1>
            <a href="{{ route('staff.communications.index') }}" class="inline-flex items-center gap-2 px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition">
                ← Back
            </a>
        </div>

        <form action="{{ route('staff.communications.store') }}" method="POST" class="bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-lg p-6 space-y-6">
            @csrf

            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Title <span class="text-red-500">*</span></label>
                <input type="text" id="title" name="title" required placeholder="Communication title" value="{{ old('title') }}" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                @error('title')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Body -->
            <div>
                <label for="body" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Message <span class="text-red-500">*</span></label>
                <textarea id="body" name="body" required rows="6" placeholder="Write your communication message..." class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-vertical font-mono text-sm">{{ old('body') }}</textarea>
                @error('body')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Minutes -->
            <div>
                <label for="minutes" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Meeting Minutes (Optional)</label>
                <textarea id="minutes" name="minutes" rows="4" placeholder="Add meeting minutes if applicable..." class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none resize-vertical font-mono text-sm">{{ old('minutes') }}</textarea>
                @error('minutes')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Activity Type -->
            <div>
                <label for="activity_type" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1">Activity Type (Optional)</label>
                <select id="activity_type" name="activity_type" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-900 text-slate-900 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none">
                    <option value="">Select activity type</option>
                    <option value="training">Training</option>
                    <option value="meeting">Meeting</option>
                    <option value="announcement">Announcement</option>
                    <option value="update">Update</option>
                    <option value="other">Other</option>
                </select>
                @error('activity_type')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Audience -->
            <div>
                <label for="audience" class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Send To <span class="text-red-500">*</span></label>
                <div class="space-y-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="audience" value="staff" checked class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-slate-700 dark:text-slate-300">Staff Only</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="audience" value="all" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                        <span class="text-slate-700 dark:text-slate-300">All Users & Staff</span>
                    </label>
                </div>
                @error('audience')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <!-- Options -->
            <div class="flex items-center gap-2">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="send_now" value="1" class="rounded border-slate-300 text-blue-600 focus:ring-blue-500">
                    <span class="text-slate-700 dark:text-slate-300">Send immediately</span>
                </label>
            </div>

            <!-- Actions -->
            <div class="flex gap-2 pt-2">
                <button type="submit" class="inline-flex items-center gap-2 px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
                    📤 Send
                </button>
                <a href="{{ route('staff.communications.index') }}" class="inline-flex items-center gap-2 px-6 py-2 border border-slate-300 dark:border-slate-600 rounded-lg text-slate-700 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-slate-700 transition font-semibold">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection
