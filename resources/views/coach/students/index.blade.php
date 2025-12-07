@extends('layouts.app')

@push('hero')
    <x-hero title="My Students" subtitle="Manage student profiles and attendance records">
        <div class="mt-4 flex items-center gap-2">
            <form method="GET" class="flex items-center gap-2">
                <input type="text" name="q" value="{{ $q }}" placeholder="Search by name or phone…" class="input" />
                <button class="btn-secondary">🔍 Search</button>
                @if($q)
                    <a href="{{ route('coach.students.index') }}" class="btn-outline">Clear</a>
                @endif
            </form>
            <a href="{{ route('coach.dashboard') }}" class="btn-outline">← Back</a>
        </div>
    </x-hero>
@endpush

@section('content')
<div class="max-w-6xl mx-auto p-6">

    @if($students->isEmpty())
        <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20h12a6 6 0 00-6-6 6 6 0 00-6 6z"/>
            </svg>
            <p class="text-slate-500 font-medium text-lg mb-2">
                @if($q)
                    No students found matching "{{ $q }}"
                @else
                    No students in your group yet
                @endif
            </p>
            <p class="text-slate-600 text-sm">Students will appear here once they are assigned to your group</p>
        </div>
    @else
        <!-- Photo Grid View -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-slate-900 mb-4">📸 Student Photos</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                @foreach ($students as $student)
                    <div class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300">
                        <a href="{{ route('coach.students.show', $student) }}" class="block transform hover:scale-105 transition-all duration-300">
                            <!-- Photo Container -->
                            <div class="aspect-square bg-slate-100 relative">
                                <img src="{{ $student->photo_url }}" alt="{{ $student->first_name }} {{ $student->second_name }}" class="w-full h-full object-cover group-hover:brightness-75 transition-all">
                                <!-- Overlay on Hover -->
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-all flex items-end opacity-0 group-hover:opacity-100">
                                    <div class="w-full p-2 bg-gradient-to-t from-black/80 to-transparent text-white">
                                        <p class="text-xs font-semibold truncate">{{ $student->first_name }} {{ $student->second_name }}</p>
                                        @if($student->jersey_number)
                                            <p class="text-xs text-yellow-300">Jersey #{{ $student->jersey_number }}</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </a>
                        <!-- Jersey Badge -->
                        @if($student->jersey_number)
                            <div class="absolute top-2 right-2 bg-blue-600 text-white text-xs font-bold rounded-full w-8 h-8 flex items-center justify-center shadow-lg group-hover:bg-blue-700 z-10">
                                #{{ $student->jersey_number }}
                            </div>
                        @endif
                        <!-- Status Badge -->
                        @if($student->status === 'active')
                            <div class="absolute top-2 left-2 bg-emerald-500 text-white text-xs font-bold rounded-full w-6 h-6 flex items-center justify-center shadow-lg z-10">✓</div>
                        @endif
                        <!-- Action Buttons on Bottom -->
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-slate-900 to-transparent p-3 translate-y-full group-hover:translate-y-0 transition-transform duration-300 z-20">
                            <div class="flex gap-2 mt-4">
                                <a href="{{ route('coach.students.show', $student) }}" class="flex-1 text-center px-2 py-1 bg-slate-700 hover:bg-slate-600 text-white text-xs rounded font-semibold transition">
                                    👁️ View
                                </a>
                                <a href="{{ route('coach.students.attendance', $student) }}" class="flex-1 text-center px-2 py-1 bg-green-600 hover:bg-green-700 text-white text-xs rounded font-semibold transition">
                                    📋 Attend
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Students Grid - Detailed View -->
        <div class="mb-8">
            <h2 class="text-xl font-bold text-slate-900 mb-4">📋 Detailed View</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($students as $student)
                <div class="bg-white dark:bg-neutral-900 border border-slate-200 dark:border-neutral-700 rounded-lg shadow-sm hover:shadow-md transition overflow-hidden">
                    <!-- Card Header with Image -->
                    <div class="bg-gradient-to-r from-indigo-50 to-blue-50 dark:from-neutral-800 dark:to-neutral-700 px-4 py-3 border-b border-slate-200 dark:border-neutral-700 flex flex-col items-center">
                        <img src="{{ $student->photo_url }}" alt="Profile Image" class="h-16 w-16 rounded-full object-cover border-2 border-slate-200 shadow mb-2">
                        <h3 class="font-bold text-lg text-slate-900 dark:text-white">{{ $student->first_name }} {{ $student->second_name }}</h3>
                        @if($student->jersey_number || $student->jersey_name)
                            <div class="flex items-center gap-2 mt-2">
                                @if($student->jersey_number)
                                    <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs font-bold rounded">Jersey #{{ $student->jersey_number }}</span>
                                @endif
                                @if($student->jersey_name)
                                    <span class="inline-block px-2 py-1 bg-purple-100 text-purple-800 text-xs font-semibold rounded">{{ $student->jersey_name }}</span>
                                @endif
                            </div>
                        @endif
                    </div>

                    <!-- Card Body -->
                    <div class="p-4">
                        <!-- Student Info -->
                        <div class="space-y-2 mb-4 pb-4 border-b border-slate-100 dark:border-neutral-700">
                            @if($student->group)
                                <p class="text-sm text-slate-600 dark:text-slate-400">
                                    <span class="font-semibold">👥 Group:</span> {{ $student->group->name }}
                                </p>
                            @endif
                            @if($student->phone)
                                <p class="text-sm text-slate-600 dark:text-slate-400">
                                    <span class="font-semibold">📱 Phone:</span> {{ $student->phone }}
                                </p>
                            @endif
                            @if($student->parent)
                                <p class="text-sm text-slate-600 dark:text-slate-400">
                                    <span class="font-semibold">👤 Parent:</span> {{ $student->parent->name }}
                                </p>
                            @endif
                        </div>

                        <!-- Attendance Action Button -->
                        <div class="mb-4 flex gap-2">
                            <a href="{{ route('coach.students.attendance', $student) }}" class="px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-800 rounded-lg font-semibold transition">📋 Attendance</a>
                        </div>

                        <!-- Status Badge -->
                        <div class="mb-4">
                            @if($student->status === 'active')
                                <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-800 text-xs font-bold rounded-full">✓ Active</span>
                            @elseif($student->status === 'inactive')
                                <span class="inline-block px-3 py-1 bg-slate-100 text-slate-800 text-xs font-bold rounded-full">○ Inactive</span>
                            @else
                                <span class="inline-block px-3 py-1 bg-amber-100 text-amber-800 text-xs font-bold rounded-full">⟳ {{ ucfirst($student->status) }}</span>
                            @endif
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col gap-2">
                            <a href="{{ route('coach.students.show', $student) }}" class="text-center px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 dark:bg-neutral-800 dark:hover:bg-neutral-700 dark:text-slate-300 rounded-lg font-semibold transition text-sm">
                                👁️ View Profile
                            </a>
                            <a href="{{ route('coach.students.attendance', $student) }}" class="text-center px-3 py-2 bg-gradient-to-r from-indigo-600 to-blue-600 hover:shadow-lg text-white rounded-lg font-semibold transition text-sm">
                                📋 Attendance
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>
        </div>

        <!-- Pagination -->
        @if($students->hasPages())
            <div class="mt-6">
                {{ $students->links() }}
            </div>
        @endif
    @endif
</div>
@endsection
