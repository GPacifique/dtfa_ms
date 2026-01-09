@extends('layouts.app')

@section('content')
@section('hide-back')@endsection

<div class="min-h-screen bg-gradient-to-br from-violet-50 via-pink-50 to-cyan-50 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">
    {{-- Hero Header with Photo --}}
    <div class="relative overflow-hidden">
        {{-- Background Gradient --}}
        <div class="absolute inset-0 bg-gradient-to-r from-violet-600 via-fuchsia-600 to-pink-600 dark:from-violet-900 dark:via-fuchsia-900 dark:to-pink-900"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2230%22 height=%2230%22 viewBox=%220 0 30 30%22 fill=%22none%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z%22 fill=%22rgba(255,255,255,0.07)%22/%3E%3C/svg%3E')] opacity-50"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-gradient-to-br from-yellow-400/30 to-orange-500/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-gradient-to-br from-cyan-400/30 to-blue-500/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>
        <div class="absolute top-1/2 right-0 w-[400px] h-[400px] bg-gradient-to-br from-white/10 to-transparent rounded-full blur-3xl"></div>

        <div class="relative container mx-auto px-4 sm:px-6 lg:px-8 py-8">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-indigo-200 mb-6">
                <a href="{{ route('students-modern.index') }}" class="hover:text-white transition">Students</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white font-medium">{{ $student->first_name }} {{ $student->second_name }}</span>
            </nav>

            {{-- Profile Header --}}
            <div class="flex flex-col lg:flex-row lg:items-end gap-6">
                {{-- Photo --}}
                @php
                    $initials = strtoupper(substr($student->first_name, 0, 1) . substr($student->second_name ?? '', 0, 1));
                @endphp
                <div class="relative">
                    <div class="w-32 h-32 lg:w-40 lg:h-40 rounded-2xl overflow-hidden ring-4 ring-white/30 shadow-2xl">
                        <img src="{{ $student->photo_url }}"
                             alt="{{ $student->first_name }} {{ $student->second_name }}"
                             class="w-full h-full object-cover"
                             onerror="this.onerror=null; this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect fill=%22%236366f1%22 width=%22100%22 height=%22100%22/><text x=%2250%22 y=%2255%22 font-size=%2240%22 fill=%22white%22 text-anchor=%22middle%22 dominant-baseline=%22middle%22>{{ $initials }}</text></svg>';">
                    </div>
                    @if($student->status === 'active')
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center ring-4 ring-white shadow-lg">
                            <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                    @endif
                    @if($student->jersey_number)
                        <div class="absolute -top-2 -left-2 w-10 h-10 bg-indigo-500 rounded-xl flex items-center justify-center ring-4 ring-white shadow-lg font-bold text-white">
                            {{ $student->jersey_number }}
                        </div>
                    @endif
                </div>

                {{-- Info --}}
                <div class="flex-1">
                    <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white">
                            {{ $student->first_name }} {{ $student->second_name }}
                        </h1>
                        <span class="px-2 sm:px-3 py-1 rounded-full text-xs font-semibold {{ $student->status === 'active' ? 'bg-emerald-500/20 text-emerald-200 ring-1 ring-emerald-500/30' : 'bg-slate-500/20 text-slate-200 ring-1 ring-slate-500/30' }}">
                            {{ ucfirst($student->status ?? 'active') }}
                        </span>
                    </div>

                    <div class="mt-2 sm:mt-3 flex flex-wrap items-center gap-2 sm:gap-4 text-indigo-100 text-sm">
                        @if($student->sport_discipline)
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/>
                                </svg>
                                {{ $student->sport_discipline }}
                            </span>
                        @endif
                        @if($student->position)
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                {{ $student->position }}
                            </span>
                        @endif
                        @if($student->jersey_name)
                            <span class="flex items-center gap-1.5">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                {{ $student->jersey_name }}
                            </span>
                        @endif
                    </div>

                    {{-- Quick Stats --}}
                    <div class="mt-4 flex flex-wrap gap-3">
                        @if($student->branch)
                            <span class="px-3 py-1.5 bg-white/20 backdrop-blur-sm rounded-lg text-sm text-white font-medium">
                                📍 {{ $student->branch->name }}
                            </span>
                        @endif
                        @if($student->group)
                            <span class="px-3 py-1.5 bg-white/20 backdrop-blur-sm rounded-lg text-sm text-white font-medium">
                                👥 {{ $student->group->name }}
                            </span>
                        @endif
                        @if($student->age)
                            <span class="px-3 py-1.5 bg-white/20 backdrop-blur-sm rounded-lg text-sm text-white font-medium">
                                🎂 {{ $student->age }} years old
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('students-modern.edit', $student) }}"
                       class="inline-flex items-center gap-1.5 sm:gap-2 bg-white hover:bg-slate-50 text-indigo-700 font-semibold px-3 sm:px-5 py-2 sm:py-2.5 text-sm rounded-xl shadow-lg transition-all duration-200 hover:-translate-y-0.5">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        <span class="hidden xs:inline">Edit </span>Profile
                    </a>
                    <a href="{{ route('students-modern.index') }}"
                       class="inline-flex items-center gap-1.5 sm:gap-2 bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-semibold px-3 sm:px-5 py-2 sm:py-2.5 text-sm rounded-xl transition-all duration-200">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-6 relative z-10">
        {{-- Success Messages --}}
        @if(session('status') || session('attendance_success'))
            <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-emerald-800 dark:text-emerald-200 font-medium">{{ session('status') ?? session('attendance_success') }}</p>
            </div>
        @endif

        {{-- Quick Attendance Section --}}
        <div class="p-[2px] bg-gradient-to-r from-violet-500 via-fuchsia-500 to-pink-500 rounded-2xl mb-6">
            <div class="bg-white dark:bg-slate-900 rounded-2xl p-4 sm:p-6">
            <div class="flex flex-col gap-4">
                <div>
                    <h3 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-violet-600 via-fuchsia-600 to-pink-600 flex items-center gap-2">
                        <div class="w-8 h-8 bg-gradient-to-br from-violet-500 to-fuchsia-500 rounded-lg flex items-center justify-center shadow-lg shadow-violet-500/25">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                            </svg>
                        </div>
                        Quick Attendance
                    </h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Record today's attendance with one click</p>
                </div>
                <div class="grid grid-cols-2 sm:flex sm:flex-wrap items-center gap-2">
                    <button type="button"
                            onclick="recordAttendance('present')"
                            class="inline-flex items-center justify-center gap-1.5 sm:gap-2 px-3 sm:px-5 py-2.5 sm:py-3 rounded-xl bg-emerald-50 hover:bg-emerald-500 text-emerald-700 hover:text-white dark:bg-emerald-900/20 dark:hover:bg-emerald-600 dark:text-emerald-400 dark:hover:text-white font-semibold text-sm transition-all duration-200 shadow-sm">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Present
                    </button>
                    <button type="button"
                            onclick="recordAttendance('absent')"
                            class="inline-flex items-center justify-center gap-1.5 sm:gap-2 px-3 sm:px-5 py-2.5 sm:py-3 rounded-xl bg-red-50 hover:bg-red-500 text-red-700 hover:text-white dark:bg-red-900/20 dark:hover:bg-red-600 dark:text-red-400 dark:hover:text-white font-semibold text-sm transition-all duration-200 shadow-sm">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Absent
                    </button>
                    <button type="button"
                            onclick="recordAttendance('late')"
                            class="inline-flex items-center justify-center gap-1.5 sm:gap-2 px-3 sm:px-5 py-2.5 sm:py-3 rounded-xl bg-amber-50 hover:bg-amber-500 text-amber-700 hover:text-white dark:bg-amber-900/20 dark:hover:bg-amber-600 dark:text-amber-400 dark:hover:text-white font-semibold text-sm transition-all duration-200 shadow-sm">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Late
                    </button>
                    <button type="button"
                            onclick="recordAttendance('excused')"
                            class="inline-flex items-center justify-center gap-1.5 sm:gap-2 px-3 sm:px-5 py-2.5 sm:py-3 rounded-xl bg-purple-50 hover:bg-purple-500 text-purple-700 hover:text-white dark:bg-purple-900/20 dark:hover:bg-purple-600 dark:text-purple-400 dark:hover:text-white font-semibold text-sm transition-all duration-200 shadow-sm">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Excused
                    </button>
                </div>
            </div>
            <div id="attendanceResult" class="mt-4 hidden"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Left Column --}}
            <div class="lg:col-span-1 space-y-6">
                {{-- Contact Information --}}
                <div class="group bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden hover:shadow-lg hover:shadow-cyan-500/10 transition-all duration-300">
                    <div class="p-6 border-b border-cyan-100 dark:border-slate-700 bg-gradient-to-r from-cyan-50 via-blue-50 to-indigo-50 dark:from-slate-800 dark:to-slate-800">
                        <h3 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-blue-600 flex items-center gap-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-lg flex items-center justify-center shadow-lg shadow-cyan-500/25">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Contact Information
                        </h3>
                    </div>
                    <div class="p-4 sm:p-6 space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">
                            <span class="text-sm text-slate-500 dark:text-slate-400">Player Email</span>
                            @if($student->player_email)
                                <a href="mailto:{{ $student->player_email }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 truncate max-w-full sm:max-w-[180px]">{{ $student->player_email }}</a>
                            @else
                                <span class="text-sm text-slate-400">—</span>
                            @endif
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">
                            <span class="text-sm text-slate-500 dark:text-slate-400">Parent Email</span>
                            @if($student->parent_email)
                                <a href="mailto:{{ $student->parent_email }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500 truncate max-w-full sm:max-w-[180px]">{{ $student->parent_email }}</a>
                            @else
                                <span class="text-sm text-slate-400">—</span>
                            @endif
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">
                            <span class="text-sm text-slate-500 dark:text-slate-400">Player Phone</span>
                            @if($student->player_phone)
                                <a href="tel:{{ $student->player_phone }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">{{ $student->player_phone }}</a>
                            @else
                                <span class="text-sm text-slate-400">—</span>
                            @endif
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-1">
                            <span class="text-sm text-slate-500 dark:text-slate-400">Emergency Phone</span>
                            @if($student->emergency_phone)
                                <a href="tel:{{ $student->emergency_phone }}" class="text-sm font-medium text-red-600 hover:text-red-500">{{ $student->emergency_phone }}</a>
                            @else
                                <span class="text-sm text-slate-400">—</span>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Program & Training --}}
                <div class="group bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden hover:shadow-lg hover:shadow-purple-500/10 transition-all duration-300">
                    <div class="p-6 border-b border-purple-100 dark:border-slate-700 bg-gradient-to-r from-purple-50 via-violet-50 to-indigo-50 dark:from-slate-800 dark:to-slate-800">
                        <h3 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-600 to-violet-600 flex items-center gap-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-violet-500 rounded-lg flex items-center justify-center shadow-lg shadow-purple-500/25">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                            Program & Training
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">Program</p>
                                <p class="mt-1 text-sm font-medium text-slate-900 dark:text-white">{{ $student->program ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">School</p>
                                <p class="mt-1 text-sm font-medium text-slate-900 dark:text-white">{{ $student->school_name ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">Coach</p>
                                <p class="mt-1 text-sm font-medium text-slate-900 dark:text-white">{{ $student->coach ?? '—' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider">Joined</p>
                                <p class="mt-1 text-sm font-medium text-slate-900 dark:text-white">{{ $student->joined_at?->format('M d, Y') ?? '—' }}</p>
                            </div>
                        </div>
                        @if($student->training_days && is_array($student->training_days) && count($student->training_days) > 0)
                            <div class="pt-4 border-t border-slate-200 dark:border-slate-700">
                                <p class="text-xs text-slate-500 dark:text-slate-400 uppercase tracking-wider mb-2">Training Days</p>
                                <div class="flex flex-wrap gap-1.5">
                                    @foreach($student->training_days as $day)
                                        <span class="px-2.5 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-300 text-xs font-medium rounded-lg">
                                            {{ $day }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Family Information --}}
                <div class="group bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden hover:shadow-lg hover:shadow-emerald-500/10 transition-all duration-300">
                    <div class="p-6 border-b border-emerald-100 dark:border-slate-700 bg-gradient-to-r from-emerald-50 via-teal-50 to-cyan-50 dark:from-slate-800 dark:to-slate-800">
                        <h3 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600 flex items-center gap-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-lg flex items-center justify-center shadow-lg shadow-emerald-500/25">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                            </div>
                            Family Information
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-500 dark:text-slate-400">Father's Name</span>
                            <span class="text-sm font-medium text-slate-900 dark:text-white">{{ $student->father_name ?? '—' }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-500 dark:text-slate-400">Mother's Name</span>
                            <span class="text-sm font-medium text-slate-900 dark:text-white">{{ $student->mother_name ?? '—' }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-500 dark:text-slate-400">Date of Birth</span>
                            <span class="text-sm font-medium text-slate-900 dark:text-white">{{ $student->dob?->format('M d, Y') ?? '—' }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-slate-500 dark:text-slate-400">Gender</span>
                            <span class="text-sm font-medium text-slate-900 dark:text-white capitalize">{{ $student->gender ?? '—' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column --}}
            <div class="lg:col-span-2 space-y-6">
                {{-- Subscriptions --}}
                <div class="group bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden hover:shadow-lg hover:shadow-amber-500/10 transition-all duration-300">
                    <div class="p-6 border-b border-amber-100 dark:border-slate-700 bg-gradient-to-r from-amber-50 via-orange-50 to-yellow-50 dark:from-slate-800 dark:to-slate-800 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-amber-600 to-orange-600 flex items-center gap-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-amber-500 to-orange-500 rounded-lg flex items-center justify-center shadow-lg shadow-amber-500/25">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                                </svg>
                            </div>
                            Subscriptions
                        </h3>
                        @if(Route::has('accountant.subscriptions.index'))
                            <a href="{{ route('accountant.subscriptions.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all →</a>
                        @endif
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-slate-50 dark:bg-slate-800/50">
                                    <th class="text-left px-6 py-3 text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase">Plan</th>
                                    <th class="text-left px-6 py-3 text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase">Start</th>
                                    <th class="text-left px-6 py-3 text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase">End</th>
                                    <th class="text-left px-6 py-3 text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                                @forelse($student->subscriptions as $sub)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                        <td class="px-6 py-4 text-sm font-medium text-slate-900 dark:text-white">{{ optional($sub->plan)->name ?? '—' }}</td>
                                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">{{ $sub->start_date?->format('M d, Y') ?? $sub->start_date }}</td>
                                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">{{ $sub->end_date?->format('M d, Y') ?? '—' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-medium
                                                @if($sub->status === 'active') bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300
                                                @elseif($sub->status === 'expired') bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300
                                                @elseif($sub->status === 'paused') bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300
                                                @else bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300 @endif">
                                                {{ ucfirst($sub->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                                            No subscriptions found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Recent Payments --}}
                <div class="group bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden hover:shadow-lg hover:shadow-green-500/10 transition-all duration-300">
                    <div class="p-6 border-b border-green-100 dark:border-slate-700 bg-gradient-to-r from-green-50 via-emerald-50 to-teal-50 dark:from-slate-800 dark:to-slate-800 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-emerald-600 flex items-center gap-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-500 rounded-lg flex items-center justify-center shadow-lg shadow-green-500/25">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            Recent Payments
                        </h3>
                        @if(Route::has('accountant.payments.index'))
                            <a href="{{ route('accountant.payments.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all →</a>
                        @endif
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-slate-50 dark:bg-slate-800/50">
                                    <th class="text-left px-6 py-3 text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase">Amount</th>
                                    <th class="text-left px-6 py-3 text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase">Method</th>
                                    <th class="text-left px-6 py-3 text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase">Status</th>
                                    <th class="text-left px-6 py-3 text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                                @forelse($student->payments()->latest('paid_at')->limit(5)->get() as $pay)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                        <td class="px-6 py-4 text-sm font-semibold text-slate-900 dark:text-white">{{ number_format((int) $pay->amount_cents) }} RWF</td>
                                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400 capitalize">{{ str_replace('_', ' ', $pay->method) }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex px-2.5 py-1 rounded-lg text-xs font-medium
                                                @if($pay->status === 'succeeded') bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300
                                                @elseif($pay->status === 'pending') bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300
                                                @else bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300 @endif">
                                                {{ ucfirst($pay->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">{{ $pay->paid_at?->format('M d, Y') ?? '—' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                                            No payments found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Attendance Timeline --}}
                <div class="group bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden hover:shadow-lg hover:shadow-indigo-500/10 transition-all duration-300">
                    <div class="p-6 border-b border-indigo-100 dark:border-slate-700 bg-gradient-to-r from-indigo-50 via-violet-50 to-purple-50 dark:from-slate-800 dark:to-slate-800 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-violet-600 flex items-center gap-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-indigo-500 to-violet-500 rounded-lg flex items-center justify-center shadow-lg shadow-indigo-500/25">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                                </svg>
                            </div>
                            Attendance History
                        </h3>
                        @if(Route::has('admin.student-attendance.index'))
                            <a href="{{ route('admin.student-attendance.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-500">View all →</a>
                        @endif
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @forelse($student->attendances()->latest()->limit(10)->get() as $att)
                                <div class="flex items-start gap-4">
                                    <div class="flex-shrink-0 mt-1">
                                        <span class="w-3 h-3 rounded-full inline-block
                                            @if($att->status === 'present') bg-emerald-500
                                            @elseif($att->status === 'absent') bg-red-500
                                            @elseif($att->status === 'late') bg-amber-500
                                            @else bg-purple-500 @endif">
                                        </span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-slate-900 dark:text-white capitalize">{{ $att->status }}</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                            {{ $att->attendance_date?->format('M d, Y') ?? $att->created_at?->format('M d, Y H:i') }}
                                            @if($att->training_session_id)
                                                · Session #{{ $att->training_session_id }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-center text-slate-500 dark:text-slate-400 py-4">No attendance records found</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
const studentId = {{ $student->id }};
const studentName = '{{ addslashes($student->first_name . " " . $student->second_name) }}';

function recordAttendance(status) {
    const today = new Date().toISOString().split('T')[0];
    const url = '{{ route("admin.student-attendance.quick-record") }}';
    const resultDiv = document.getElementById('attendanceResult');

    // Show loading
    resultDiv.innerHTML = `
        <div class="flex items-center gap-2 text-blue-600 dark:text-blue-400">
            <svg class="w-5 h-5 animate-spin" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Recording attendance...
        </div>
    `;
    resultDiv.classList.remove('hidden');

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            student_id: studentId,
            attendance_date: today,
            status: status
        })
    })
    .then(response => response.json().then(data => ({ ok: response.ok, data })))
    .then(({ ok, data }) => {
        if (ok && data.success) {
            resultDiv.innerHTML = `
                <div class="flex items-center gap-2 p-3 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl text-emerald-700 dark:text-emerald-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span class="font-medium">✓ ${studentName} marked as ${status} for today</span>
                </div>
            `;
        } else {
            resultDiv.innerHTML = `
                <div class="flex items-center gap-2 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl text-red-700 dark:text-red-300">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    <span class="font-medium">Error: ${data.message || 'Unknown error'}</span>
                </div>
            `;
        }

        // Hide after 5 seconds
        setTimeout(() => {
            resultDiv.classList.add('hidden');
        }, 5000);
    })
    .catch(error => {
        resultDiv.innerHTML = `
            <div class="flex items-center gap-2 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-xl text-red-700 dark:text-red-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                <span class="font-medium">Error: ${error.message}</span>
            </div>
        `;
    });
}
</script>
@endpush
@endsection
