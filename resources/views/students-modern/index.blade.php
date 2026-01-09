@extends('layouts.app')

@section('content')
@section('hide-back')@endsection

<div class="min-h-screen bg-gradient-to-br from-violet-50 via-pink-50 to-cyan-50 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">
    {{-- Hero Section --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-violet-600 via-fuchsia-600 to-pink-600 dark:from-violet-900 dark:via-fuchsia-900 dark:to-pink-900">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2230%22 height=%2230%22 viewBox=%220 0 30 30%22 fill=%22none%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z%22 fill=%22rgba(255,255,255,0.07)%22/%3E%3C/svg%3E')] opacity-50"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-gradient-to-br from-yellow-400/30 to-orange-500/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-gradient-to-br from-cyan-400/30 to-blue-500/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-gradient-to-br from-white/5 to-transparent rounded-full blur-3xl"></div>

        <div class="relative container mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <h1 class="text-3xl lg:text-4xl font-bold text-white tracking-tight">
                        Students Management
                    </h1>
                    <p class="mt-2 text-indigo-100 text-sm lg:text-base">
                        Manage student profiles, track attendance, and monitor progress
                    </p>
                    <div class="mt-4 flex flex-wrap items-center gap-2 sm:gap-4 text-sm">
                        <div class="flex items-center gap-2 bg-gradient-to-r from-cyan-500/30 to-blue-500/30 backdrop-blur-sm rounded-full px-3 sm:px-4 py-1.5 sm:py-2 border border-white/20">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-cyan-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-semibold text-white text-xs sm:text-sm">{{ $students->total() ?? $students->count() }} Students</span>
                        </div>
                        <div class="flex items-center gap-2 bg-gradient-to-r from-emerald-500/30 to-green-500/30 backdrop-blur-sm rounded-full px-3 sm:px-4 py-1.5 sm:py-2 border border-white/20">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 text-emerald-300" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                            </svg>
                            <span class="font-semibold text-white text-xs sm:text-sm">{{ $students->where('status', 'active')->count() }} Active</span>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap items-center gap-2 sm:gap-3">
                    <a href="{{ route('admin.student-attendance.create') }}"
                       class="inline-flex items-center gap-1.5 sm:gap-2 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-400 hover:to-teal-400 text-white font-semibold px-3 sm:px-5 py-2 sm:py-2.5 text-sm sm:text-base rounded-xl shadow-lg shadow-emerald-500/30 transition-all duration-200 hover:shadow-emerald-500/50 hover:-translate-y-0.5 hover:scale-105">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                        </svg>
                        <span class="hidden xs:inline">Bulk </span>Attendance
                    </a>
                    <a href="{{ route('students-modern.create') }}"
                       class="inline-flex items-center gap-1.5 sm:gap-2 bg-white hover:bg-gradient-to-r hover:from-violet-50 hover:to-pink-50 text-fuchsia-700 font-semibold px-3 sm:px-5 py-2 sm:py-2.5 text-sm sm:text-base rounded-xl shadow-lg transition-all duration-200 hover:-translate-y-0.5 hover:scale-105 border border-white/50">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        <span class="hidden xs:inline">Add </span>Student
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6 -mt-6 relative z-10">
        {{-- Alert Messages --}}
        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl flex items-center gap-3">
                <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <p class="text-emerald-800 dark:text-emerald-200 font-medium">{{ session('success') }}</p>
            </div>
        @endif

        @if(session('status'))
            <div class="mb-6 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-xl flex items-center gap-3">
                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <p class="text-blue-800 dark:text-blue-200 font-medium">{{ session('status') }}</p>
            </div>
        @endif

        {{-- Filters Card --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 p-4 sm:p-6 mb-6">
            <form method="get" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                    {{-- Search --}}
                    <div class="lg:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Search Students</label>
                        <div class="relative">
                            <input type="text" name="q" value="{{ request('q') }}"
                                   placeholder="Search by name, email, phone..."
                                   class="w-full pl-10 pr-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                            <svg class="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                    </div>

                    {{-- Status Filter --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Status</label>
                        <select name="status" class="w-full py-2.5 px-4 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    {{-- Branch Filter --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Branch</label>
                        <select name="branch_id" class="w-full py-2.5 px-4 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                            <option value="">All Branches</option>
                            @foreach($branches as $branch)
                                <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Group Filter --}}
                    <div>
                        <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Group</label>
                        <select name="group_id" class="w-full py-2.5 px-4 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                            <option value="">All Groups</option>
                            @foreach($groups as $group)
                                <option value="{{ $group->id }}" {{ request('group_id') == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 sm:gap-4 pt-4 border-t border-slate-200 dark:border-slate-700">
                    {{-- View Toggle --}}
                    <div class="flex items-center gap-1 sm:gap-2 bg-slate-100 dark:bg-slate-800 p-1 rounded-xl w-full sm:w-auto justify-center sm:justify-start">
                        <a href="{{ request()->fullUrlWithQuery(['view' => 'cards']) }}"
                           class="flex-1 sm:flex-initial flex items-center justify-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium transition {{ request('view') === 'cards' ? 'bg-white dark:bg-slate-700 text-indigo-600 dark:text-indigo-400 shadow-sm' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
                            </svg>
                            Cards
                        </a>
                        <a href="{{ request()->fullUrlWithQuery(['view' => 'table']) }}"
                           class="flex-1 sm:flex-initial flex items-center justify-center gap-1.5 sm:gap-2 px-3 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium transition {{ request('view') !== 'cards' ? 'bg-white dark:bg-slate-700 text-indigo-600 dark:text-indigo-400 shadow-sm' : 'text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white' }}">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                            </svg>
                            Table
                        </a>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex items-center justify-center sm:justify-end gap-2">
                        <button type="submit" class="inline-flex items-center gap-1.5 sm:gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-3 sm:px-4 py-2 sm:py-2.5 text-sm rounded-xl transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                            </svg>
                            <span class="hidden xs:inline">Apply </span>Filter
                        </button>
                        <a href="{{ route('students-modern.index') }}" class="inline-flex items-center gap-1.5 sm:gap-2 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-medium px-3 sm:px-4 py-2 sm:py-2.5 text-sm rounded-xl transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Reset
                        </a>
                    </div>
                </div>
            </form>

            {{-- Recently Recorded Attendance --}}
            <div id="recentlyRecorded" class="mt-4"></div>
        </div>

        {{-- Cards View --}}
        @if(request('view') === 'cards')
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse($students as $student)
                <div class="group relative bg-white dark:bg-slate-900 rounded-2xl shadow-sm overflow-hidden hover:shadow-2xl transition-all duration-300 hover:-translate-y-1">
                    {{-- Gradient border effect --}}
                    <div class="absolute inset-0 bg-gradient-to-br from-violet-500 via-fuchsia-500 to-pink-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
                    <div class="absolute inset-[2px] bg-white dark:bg-slate-900 rounded-2xl"></div>

                    {{-- Card content --}}
                    <div class="relative">
                    {{-- Photo Section --}}
                    @php
                        $initials = strtoupper(substr($student->first_name, 0, 1) . substr($student->second_name ?? '', 0, 1));
                        $colors = ['from-violet-400 to-purple-600', 'from-pink-400 to-rose-600', 'from-cyan-400 to-blue-600', 'from-emerald-400 to-teal-600', 'from-amber-400 to-orange-600', 'from-fuchsia-400 to-pink-600'];
                        $colorClass = $colors[$student->id % count($colors)];
                    @endphp
                    <div class="relative aspect-square bg-gradient-to-br {{ $colorClass }} overflow-hidden">
                        <a href="{{ route('students-modern.show', $student) }}" class="block w-full h-full">
                            <img src="{{ $student->photo_url }}"
                                 alt="{{ $student->first_name }} {{ $student->second_name }}"
                                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                                 loading="lazy"
                                 onerror="this.onerror=null; this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect fill=%22%236366f1%22 width=%22100%22 height=%22100%22/><text x=%2250%22 y=%2255%22 font-size=%2240%22 fill=%22white%22 text-anchor=%22middle%22 dominant-baseline=%22middle%22>{{ $initials }}</text></svg>';">
                        </a>

                        {{-- Status Badge --}}
                        <div class="absolute top-3 right-3">
                            @if($student->status === 'active')
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-emerald-500/90 backdrop-blur-sm text-white text-xs font-semibold rounded-full shadow-lg">
                                    <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 bg-slate-500/90 backdrop-blur-sm text-white text-xs font-semibold rounded-full shadow-lg">
                                    Inactive
                                </span>
                            @endif
                        </div>

                        {{-- Jersey Number --}}
                        @if($student->jersey_number)
                            <div class="absolute top-3 left-3 w-10 h-10 bg-indigo-600/90 backdrop-blur-sm text-white font-bold rounded-xl flex items-center justify-center shadow-lg">
                                {{ $student->jersey_number }}
                            </div>
                        @endif
                    </div>

                    {{-- Info Section --}}
                    <div class="p-4">
                        <a href="{{ route('students-modern.show', $student) }}" class="block group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition">
                            <h3 class="font-bold text-lg text-slate-900 dark:text-white truncate">
                                {{ $student->first_name }} {{ $student->second_name }}
                            </h3>
                        </a>

                        <p class="text-sm text-slate-500 dark:text-slate-400 truncate mt-0.5">
                            {{ $student->player_email ?? 'No email' }}
                        </p>

                        @if($student->jersey_name || $student->position)
                            <p class="text-xs text-slate-600 dark:text-slate-400 mt-1.5 flex items-center gap-1">
                                <span>🏆</span>
                                <span class="truncate">{{ $student->jersey_name ?? '' }} {{ $student->position ? '· ' . $student->position : '' }}</span>
                            </p>
                        @endif

                        {{-- Tags --}}
                        <div class="flex flex-wrap gap-1.5 mt-3">
                            @if($student->branch)
                                <span class="px-2 py-0.5 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs font-medium rounded-md">
                                    {{ $student->branch->name }}
                                </span>
                            @endif
                            @if($student->group)
                                <span class="px-2 py-0.5 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 text-xs font-medium rounded-md">
                                    {{ $student->group->name }}
                                </span>
                            @endif
                        </div>

                        {{-- Quick Attendance Section --}}
                        <div class="mt-4 pt-4 border-t border-slate-100 dark:border-slate-800">
                            <p class="text-xs font-medium text-slate-500 dark:text-slate-400 mb-2 text-center">Quick Attendance</p>
                            <div class="grid grid-cols-4 gap-1.5">
                                <button type="button"
                                        onclick="recordStudentAttendance({{ $student->id }}, '{{ addslashes($student->first_name . ' ' . $student->second_name) }}', 'present')"
                                        class="flex flex-col items-center gap-1 p-2 rounded-xl bg-emerald-50 hover:bg-emerald-500 text-emerald-600 hover:text-white dark:bg-emerald-900/20 dark:hover:bg-emerald-600 dark:text-emerald-400 dark:hover:text-white transition-all duration-200 group/btn"
                                        title="Mark Present">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="text-[10px] font-semibold">Present</span>
                                </button>
                                <button type="button"
                                        onclick="recordStudentAttendance({{ $student->id }}, '{{ addslashes($student->first_name . ' ' . $student->second_name) }}', 'absent')"
                                        class="flex flex-col items-center gap-1 p-2 rounded-xl bg-red-50 hover:bg-red-500 text-red-600 hover:text-white dark:bg-red-900/20 dark:hover:bg-red-600 dark:text-red-400 dark:hover:text-white transition-all duration-200"
                                        title="Mark Absent">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    <span class="text-[10px] font-semibold">Absent</span>
                                </button>
                                <button type="button"
                                        onclick="recordStudentAttendance({{ $student->id }}, '{{ addslashes($student->first_name . ' ' . $student->second_name) }}', 'late')"
                                        class="flex flex-col items-center gap-1 p-2 rounded-xl bg-amber-50 hover:bg-amber-500 text-amber-600 hover:text-white dark:bg-amber-900/20 dark:hover:bg-amber-600 dark:text-amber-400 dark:hover:text-white transition-all duration-200"
                                        title="Mark Late">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="text-[10px] font-semibold">Late</span>
                                </button>
                                <button type="button"
                                        onclick="recordStudentAttendance({{ $student->id }}, '{{ addslashes($student->first_name . ' ' . $student->second_name) }}', 'excused')"
                                        class="flex flex-col items-center gap-1 p-2 rounded-xl bg-purple-50 hover:bg-purple-500 text-purple-600 hover:text-white dark:bg-purple-900/20 dark:hover:bg-purple-600 dark:text-purple-400 dark:hover:text-white transition-all duration-200"
                                        title="Mark Excused">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                    <span class="text-[10px] font-semibold">Excused</span>
                                </button>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex items-center justify-between mt-3 pt-3 border-t border-slate-100 dark:border-slate-800">
                            <a href="{{ route('students-modern.edit', $student) }}"
                               class="inline-flex items-center gap-1.5 text-sm text-slate-600 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-400 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </a>
                            <button type="button"
                                    onclick="deleteStudent({{ $student->id }}, '{{ addslashes($student->first_name . ' ' . $student->second_name) }}')"
                                    class="inline-flex items-center gap-1.5 text-sm text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete
                            </button>
                        </div>
                    </div>
                    </div>{{-- End card content --}}
                </div>
            @empty
                <div class="col-span-full">
                    <div class="text-center py-16 bg-white dark:bg-slate-900 rounded-2xl border border-slate-200 dark:border-slate-800">
                        <svg class="w-16 h-16 mx-auto text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                        <h3 class="mt-4 text-lg font-semibold text-slate-900 dark:text-white">No students found</h3>
                        <p class="mt-2 text-slate-500 dark:text-slate-400">Try adjusting your search or filter criteria</p>
                        <a href="{{ route('students-modern.create') }}" class="mt-6 inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-6 py-2.5 rounded-xl transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                            Add First Student
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
        @else
        {{-- Table View --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
                            <th class="text-left px-6 py-4 text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Student</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Group</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Branch</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Status</th>
                            <th class="text-left px-6 py-4 text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Joined</th>
                            <th class="text-center px-6 py-4 text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Quick Attendance</th>
                            <th class="text-right px-6 py-4 text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                        @forelse($students as $student)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                {{-- Student Info --}}
                                <td class="px-6 py-4">
                                    @php
                                        $tableInitials = strtoupper(substr($student->first_name, 0, 1) . substr($student->second_name ?? '', 0, 1));
                                    @endphp
                                    <a href="{{ route('students-modern.show', $student) }}" class="flex items-center gap-4 group">
                                        <div class="relative flex-shrink-0">
                                            <img src="{{ $student->photo_url }}"
                                                 alt="{{ $student->first_name }}"
                                                 class="w-12 h-12 rounded-xl object-cover ring-2 ring-slate-200 dark:ring-slate-700 group-hover:ring-indigo-400 transition"
                                                 loading="lazy"
                                                 onerror="this.onerror=null; this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><rect fill=%22%236366f1%22 width=%22100%22 height=%22100%22/><text x=%2250%22 y=%2255%22 font-size=%2240%22 fill=%22white%22 text-anchor=%22middle%22 dominant-baseline=%22middle%22>{{ $tableInitials }}</text></svg>';">
                                            @if($student->jersey_number)
                                                <span class="absolute -top-1 -right-1 w-5 h-5 bg-indigo-600 text-white text-[10px] font-bold rounded-md flex items-center justify-center">
                                                    {{ $student->jersey_number }}
                                                </span>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-semibold text-slate-900 dark:text-white group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition">
                                                {{ $student->first_name }} {{ $student->second_name }}
                                            </p>
                                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $student->player_email ?? '—' }}</p>
                                            @if($student->jersey_name || $student->position)
                                                <p class="text-xs text-slate-400 dark:text-slate-500 mt-0.5">
                                                    🏆 {{ $student->jersey_name ?? '' }} {{ $student->position ? '· ' . $student->position : '' }}
                                                </p>
                                            @endif
                                        </div>
                                    </a>
                                </td>

                                {{-- Group --}}
                                <td class="px-6 py-4">
                                    @if($student->group)
                                        <span class="inline-flex px-2.5 py-1 bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 text-xs font-medium rounded-lg">
                                            {{ $student->group->name }}
                                        </span>
                                    @else
                                        <span class="text-slate-400">—</span>
                                    @endif
                                </td>

                                {{-- Branch --}}
                                <td class="px-6 py-4">
                                    @if($student->branch)
                                        <span class="inline-flex px-2.5 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300 text-xs font-medium rounded-lg">
                                            {{ $student->branch->name }}
                                        </span>
                                    @else
                                        <span class="text-slate-400">—</span>
                                    @endif
                                </td>

                                {{-- Status --}}
                                <td class="px-6 py-4">
                                    @if($student->status === 'active')
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300 text-xs font-medium rounded-lg">
                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 text-xs font-medium rounded-lg">
                                            <span class="w-1.5 h-1.5 bg-slate-400 rounded-full"></span>
                                            Inactive
                                        </span>
                                    @endif
                                </td>

                                {{-- Joined Date --}}
                                <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">
                                    {{ $student->joined_at?->format('M d, Y') ?? '—' }}
                                </td>

                                {{-- Quick Attendance Buttons --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-1">
                                        <button type="button"
                                                onclick="recordStudentAttendance({{ $student->id }}, '{{ addslashes($student->first_name . ' ' . $student->second_name) }}', 'present')"
                                                class="p-2 rounded-lg bg-emerald-50 hover:bg-emerald-500 text-emerald-600 hover:text-white dark:bg-emerald-900/20 dark:hover:bg-emerald-600 dark:text-emerald-400 dark:hover:text-white transition-all duration-200"
                                                title="Mark Present">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                            </svg>
                                        </button>
                                        <button type="button"
                                                onclick="recordStudentAttendance({{ $student->id }}, '{{ addslashes($student->first_name . ' ' . $student->second_name) }}', 'absent')"
                                                class="p-2 rounded-lg bg-red-50 hover:bg-red-500 text-red-600 hover:text-white dark:bg-red-900/20 dark:hover:bg-red-600 dark:text-red-400 dark:hover:text-white transition-all duration-200"
                                                title="Mark Absent">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>
                                        <button type="button"
                                                onclick="recordStudentAttendance({{ $student->id }}, '{{ addslashes($student->first_name . ' ' . $student->second_name) }}', 'late')"
                                                class="p-2 rounded-lg bg-amber-50 hover:bg-amber-500 text-amber-600 hover:text-white dark:bg-amber-900/20 dark:hover:bg-amber-600 dark:text-amber-400 dark:hover:text-white transition-all duration-200"
                                                title="Mark Late">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                        </button>
                                        <button type="button"
                                                onclick="recordStudentAttendance({{ $student->id }}, '{{ addslashes($student->first_name . ' ' . $student->second_name) }}', 'excused')"
                                                class="p-2 rounded-lg bg-purple-50 hover:bg-purple-500 text-purple-600 hover:text-white dark:bg-purple-900/20 dark:hover:bg-purple-600 dark:text-purple-400 dark:hover:text-white transition-all duration-200"
                                                title="Mark Excused">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>

                                {{-- Actions --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('students-modern.show', $student) }}"
                                           class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 hover:text-indigo-600 dark:text-slate-400 dark:hover:text-indigo-400 transition"
                                           title="View Profile">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('students-modern.edit', $student) }}"
                                           class="p-2 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-800 text-slate-500 hover:text-blue-600 dark:text-slate-400 dark:hover:text-blue-400 transition"
                                           title="Edit Student">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        <button type="button"
                                                onclick="deleteStudent({{ $student->id }}, '{{ addslashes($student->first_name . ' ' . $student->second_name) }}')"
                                                class="p-2 rounded-lg hover:bg-red-50 dark:hover:bg-red-900/20 text-slate-500 hover:text-red-600 dark:text-slate-400 dark:hover:text-red-400 transition"
                                                title="Delete Student">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">
                                    <svg class="w-12 h-12 mx-auto text-slate-300 dark:text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                    <h3 class="mt-4 text-lg font-semibold text-slate-900 dark:text-white">No students found</h3>
                                    <p class="mt-2 text-slate-500 dark:text-slate-400">Try adjusting your search or filter criteria</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($students->hasPages())
                <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800">
                    {{ $students->links() }}
                </div>
            @endif
        </div>
        @endif

        {{-- Pagination for Cards View --}}
        @if(request('view') === 'cards' && $students->hasPages())
            <div class="mt-6">
                {{ $students->links() }}
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('Students management loaded');
});

const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
let recentlyRecorded = [];

// Record student attendance
function recordStudentAttendance(studentId, studentName, status) {
    const today = new Date().toISOString().split('T')[0];
    const url = '{{ route("admin.student-attendance.quick-record") }}';
    const parsedStudentId = parseInt(studentId);

    if (!csrfToken) {
        showNotification('Error: CSRF token not found. Please refresh the page.', 'error');
        return;
    }

    // Show loading state
    showNotification(`Recording ${studentName} as ${status}...`, 'info');

    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            student_id: parsedStudentId,
            attendance_date: today,
            status: status
        })
    })
    .then(response => response.json().then(data => ({ ok: response.ok, data })))
    .then(({ ok, data }) => {
        if (ok && data.success) {
            // Add to recently recorded
            recentlyRecorded.unshift({ id: parsedStudentId, name: studentName, status: status, time: new Date() });
            if (recentlyRecorded.length > 10) recentlyRecorded.pop();
            updateRecentlyRecorded();

            showNotification(`✓ ${studentName} marked as ${status}`, 'success');
        } else {
            showNotification('Error: ' + (data.message || 'Unknown error'), 'error');
        }
    })
    .catch(error => {
        console.error('Fetch error:', error);
        showNotification('Error: ' + error.message, 'error');
    });
}

// Delete student
function deleteStudent(studentId, studentName) {
    if (!confirm(`Are you sure you want to delete ${studentName}? This action cannot be undone.`)) {
        return;
    }

    const url = `{{ url('students-modern') }}/${studentId}`;
    const formData = new FormData();
    formData.append('_method', 'DELETE');
    formData.append('_token', csrfToken);

    fetch(url, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'text/html,application/json'
        },
        body: formData
    })
    .then(response => {
        if (response.ok || response.redirected) {
            showNotification(`✓ ${studentName} has been deleted`, 'success');
            setTimeout(() => window.location.reload(), 1000);
        } else {
            throw new Error('Failed to delete student');
        }
    })
    .catch(error => {
        console.error('Delete error:', error);
        showNotification('Error: ' + error.message, 'error');
    });
}

// Show notification
function showNotification(message, type) {
    // Remove existing notifications
    document.querySelectorAll('.notification-toast').forEach(el => el.remove());

    const colors = {
        success: 'bg-emerald-500',
        error: 'bg-red-500',
        info: 'bg-blue-500',
        warning: 'bg-amber-500'
    };

    const icons = {
        success: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>',
        error: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>',
        info: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>',
        warning: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>'
    };

    const toast = document.createElement('div');
    toast.className = `notification-toast fixed top-4 right-4 z-50 flex items-center gap-3 ${colors[type]} text-white px-5 py-3 rounded-xl shadow-2xl transform translate-x-full transition-transform duration-300`;
    toast.innerHTML = `${icons[type]}<span class="font-medium">${message}</span>`;

    document.body.appendChild(toast);

    // Animate in
    requestAnimationFrame(() => {
        toast.classList.remove('translate-x-full');
    });

    // Remove after delay
    setTimeout(() => {
        toast.classList.add('translate-x-full');
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}

// Update recently recorded section
function updateRecentlyRecorded() {
    const container = document.getElementById('recentlyRecorded');
    if (!container || recentlyRecorded.length === 0) return;

    const statusColors = {
        present: 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300',
        absent: 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300',
        late: 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300',
        excused: 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300'
    };

    container.innerHTML = `
        <div class="mt-4 p-4 bg-slate-50 dark:bg-slate-800/50 rounded-xl border border-slate-200 dark:border-slate-700">
            <div class="flex items-center justify-between mb-3">
                <h4 class="font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/>
                    </svg>
                    Recently Recorded (${recentlyRecorded.length})
                </h4>
                <button onclick="recentlyRecorded = []; updateRecentlyRecorded(); document.getElementById('recentlyRecorded').innerHTML = '';"
                        class="text-xs text-slate-500 hover:text-slate-700 dark:text-slate-400 dark:hover:text-slate-200">
                    Clear
                </button>
            </div>
            <div class="flex flex-wrap gap-2">
                ${recentlyRecorded.map(r => `
                    <span class="inline-flex items-center gap-2 px-3 py-1.5 ${statusColors[r.status]} text-sm font-medium rounded-lg">
                        ${r.name}
                        <span class="text-xs opacity-75">• ${r.status}</span>
                    </span>
                `).join('')}
            </div>
        </div>
    `;
}
</script>
@endpush
@endsection



