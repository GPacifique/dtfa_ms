@php
    $title = __('app.coach_dashboard');
@endphp
@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-4xl font-bold text-slate-900 dark:text-white">🏆 {{ __('app.coach_dashboard') }}</h1>
            <p class="text-slate-600 dark:text-slate-400 mt-2">{{ __('app.welcome_back') }}, <span class="font-semibold">{{ Auth::user()->name }}</span></p>
        </div>
        <a href="{{ route('coach.sessions.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700 transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            {{ __('app.new_session') }}
        </a>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Students Stat -->
        <div class="bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-emerald-900/20 dark:to-emerald-800/20 rounded-xl p-6 border border-emerald-200 dark:border-emerald-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-600 dark:text-emerald-400 text-sm font-medium">{{ __('app.students') }}</p>
                    <p class="text-3xl font-bold text-emerald-900 dark:text-emerald-100 mt-1">{{ $activeStudents->count() ?? 0 }}</p>
                </div>
                <div class="text-4xl">🎓</div>
            </div>
        </div>

        <!-- Attendance Rate -->
        <div class="bg-gradient-to-br from-fuchsia-50 to-fuchsia-100 dark:from-fuchsia-900/20 dark:to-fuchsia-800/20 rounded-xl p-6 border border-fuchsia-200 dark:border-fuchsia-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-fuchsia-600 dark:text-fuchsia-400 text-sm font-medium">{{ __('app.attendance_rate') }}</p>
                    <p class="text-3xl font-bold text-fuchsia-900 dark:text-fuchsia-100 mt-1">{{ $attendanceRate ?? 0 }}%</p>
                </div>
                <div class="text-4xl">✅</div>
            </div>
        </div>

        <!-- Sessions Stat -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-xl p-6 border border-blue-200 dark:border-blue-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-600 dark:text-blue-400 text-sm font-medium">{{ __('app.sessions') }}</p>
                    <p class="text-3xl font-bold text-blue-900 dark:text-blue-100 mt-1">{{ $allSessions->count() ?? 0 }}</p>
                </div>
                <div class="text-4xl">🎯</div>
            </div>
        </div>

        <!-- Messages Stat -->
        <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 dark:from-indigo-900/20 dark:to-indigo-800/20 rounded-xl p-6 border border-indigo-200 dark:border-indigo-800">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-indigo-600 dark:text-indigo-400 text-sm font-medium">{{ __('app.messages') }}</p>
                    <p class="text-3xl font-bold text-indigo-900 dark:text-indigo-100 mt-1">{{ $recentCommunications->count() ?? 0 }}</p>
                </div>
                <div class="text-4xl">📨</div>
            </div>
        </div>
    </div>

    <!-- Main Grid: Students & Today -->
    <div class="grid lg:grid-cols-3 gap-6">
        <!-- Students Section -->
        <div class="lg:col-span-2 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white">👥 {{ __('app.my_students') }}</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                        @forelse($students->take(100) as $student)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/40 transition">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('students-modern.show', $student) }}">
                                            <img src="{{ $student->photo_url }}" class="w-10 h-10 rounded-full object-cover border border-slate-200 dark:border-slate-600 hover:border-blue-500 hover:scale-110 transition" alt="{{ $student->first_name }}" loading="lazy" onerror="this.style.display='none'">
                                        </a>
                                        <div>
                                            <a href="{{ route('students-modern.show', $student) }}" class="hover:text-blue-600">
                                                <p class="font-semibold text-slate-900 dark:text-white text-sm">{{ $student->first_name ?? 'N/A' }} {{ $student->second_name ?? '' }}</p>
                                            </a>
                                            <p class="text-xs text-slate-500">{{ $student->group->name ?? 'No group' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-right">
                                    <a href="{{ route('students-modern.show', $student) }}" class="inline-flex text-xs px-3 py-1.5 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 rounded-md hover:bg-indigo-200 transition">{{ __('app.view') }}</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="p-12 text-center">
                                    <p class="text-4xl mb-3">📭</p>
                                    <p class="text-slate-500 dark:text-slate-400 font-medium">{{ __('app.no_students_assigned') }}</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Today's Sessions -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 flex flex-col">
            <div class="p-6 border-b border-slate-200 dark:border-slate-700">
                <h2 class="text-lg font-bold text-slate-900 dark:text-white">📋 {{ __('app.today') }}</h2>
            </div>
            <div class="flex-1 overflow-y-auto p-4 space-y-3">
                @forelse($sessionsToday as $s)
                    <div class="p-4 rounded-xl bg-gradient-to-br from-indigo-50 to-blue-50 dark:from-indigo-900/20 dark:to-blue-900/20 border border-indigo-200 dark:border-indigo-800">
                        <div class="flex justify-between items-start mb-2">
                            <span class="text-sm font-bold text-indigo-900 dark:text-indigo-100">{{ $s->start_time ?? 'N/A' }} – {{ $s->end_time ?? 'N/A' }}</span>
                            <span class="text-xs bg-indigo-600 text-white px-2 py-1 rounded">{{ $s->location ?? 'TBA' }}</span>
                        </div>
                        <p class="text-xs text-slate-600 dark:text-slate-400 mb-3"><strong>{{ __('app.group') }}:</strong> {{ $s->group->name ?? 'All Groups' }}</p>
                        <div class="flex gap-2">
                            <a href="{{ route('coach.sessions.show', $s) }}" class="flex-1 text-center text-xs py-2 border border-slate-300 dark:border-slate-600 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition font-medium">{{ __('app.details') }}</a>
                            <a href="{{ route('coach.attendance.show', $s) }}" class="flex-1 text-center text-xs py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition font-medium">{{ __('app.attendance') }}</a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <p class="text-3xl mb-2">📭</p>
                        <p class="text-slate-500 dark:text-slate-400 text-sm">{{ __('app.no_sessions_today') }}</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Training Records -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700">
        <div class="p-6 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-900 dark:text-white">📊 {{ __('app.training_records') }}</h2>
            <a href="{{ route('admin.training_session_records.index') }}" class="text-sm text-indigo-600 dark:text-indigo-400 hover:underline font-medium">{{ __('app.view_all') }} →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                    @forelse($recentTrainingRecords->take(8) as $record)
                        <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/40 transition">
                            <td class="p-4">
                                <div>
                                    <p class="font-semibold text-slate-900 dark:text-white text-sm">{{ $record->main_topic ?? $record->training_objective ?? 'Training Session' }}</p>
                                    <p class="text-xs text-slate-500">{{ $record->date?->format('M d, Y') }} • {{ $record->branch }}</p>
                                </div>
                            </td>
                            <td class="p-4 text-right">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-semibold rounded-full bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400">
                                    {{ $record->sport_discipline ?? 'Sport' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="p-12 text-center">
                                <p class="text-slate-500 dark:text-slate-400 font-medium">{{ __('app.no_training_records') }}</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
