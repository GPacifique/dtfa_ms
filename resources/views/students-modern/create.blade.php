@extends('layouts.app')

@section('content')
@section('hide-back')@endsection

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-100 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">
    {{-- Hero Section --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 dark:from-emerald-900 dark:via-teal-900 dark:to-emerald-900">
        <div class="absolute inset-0 bg-grid-white/10 [mask-image:linear-gradient(0deg,transparent,rgba(255,255,255,0.6))]"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-teal-500/20 rounded-full blur-3xl"></div>

        <div class="relative container mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-emerald-200 mb-6">
                <a href="{{ route('students-modern.index') }}" class="hover:text-white transition">Students</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white font-medium">Add New Student</span>
            </nav>

            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div>
                    <h1 class="text-3xl lg:text-4xl font-bold text-white tracking-tight flex items-center gap-3">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Add New Student
                    </h1>
                    <p class="mt-2 text-emerald-100 text-sm lg:text-base">
                        Register a new student to the academy
                    </p>
                </div>
                <a href="{{ route('students-modern.index') }}"
                   class="inline-flex items-center gap-2 bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-semibold px-5 py-2.5 rounded-xl transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to List
                </a>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-6 relative z-10">
        {{-- Form Card --}}
        <div class="bg-white dark:bg-slate-900 rounded-2xl shadow-xl border border-slate-200 dark:border-slate-800 overflow-hidden">
            <form action="{{ route('students-modern.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                {{-- Progress Steps --}}
                <div class="bg-slate-50 dark:bg-slate-800/50 p-4 border-b border-slate-200 dark:border-slate-700">
                    <div class="flex items-center justify-center gap-4 text-sm">
                        <span class="flex items-center gap-2 text-emerald-600 dark:text-emerald-400 font-medium">
                            <span class="w-6 h-6 bg-emerald-600 dark:bg-emerald-500 text-white rounded-full flex items-center justify-center text-xs font-bold">1</span>
                            Basic Info
                        </span>
                        <span class="w-8 h-px bg-slate-300 dark:bg-slate-600"></span>
                        <span class="flex items-center gap-2 text-slate-400">
                            <span class="w-6 h-6 bg-slate-200 dark:bg-slate-700 text-slate-500 rounded-full flex items-center justify-center text-xs font-bold">2</span>
                            Contact
                        </span>
                        <span class="w-8 h-px bg-slate-300 dark:bg-slate-600"></span>
                        <span class="flex items-center gap-2 text-slate-400">
                            <span class="w-6 h-6 bg-slate-200 dark:bg-slate-700 text-slate-500 rounded-full flex items-center justify-center text-xs font-bold">3</span>
                            Sports
                        </span>
                        <span class="w-8 h-px bg-slate-300 dark:bg-slate-600"></span>
                        <span class="flex items-center gap-2 text-slate-400">
                            <span class="w-6 h-6 bg-slate-200 dark:bg-slate-700 text-slate-500 rounded-full flex items-center justify-center text-xs font-bold">4</span>
                            Photo
                        </span>
                    </div>
                </div>

                <div class="p-6 lg:p-8 space-y-8">
                    {{-- Basic Information --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-slate-700">
                            <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-slate-900 dark:text-white">Basic Information</h2>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Personal details and identity</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">First Name <span class="text-red-500">*</span></label>
                                <input type="text" name="first_name" value="{{ old('first_name') }}" required
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="Enter first name">
                                @error('first_name')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Second Name <span class="text-red-500">*</span></label>
                                <input type="text" name="second_name" value="{{ old('second_name') }}" required
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="Enter second name">
                                @error('second_name')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Date of Birth</label>
                                <input type="date" name="dob" value="{{ old('dob') }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                @error('dob')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Gender</label>
                                <select name="gender" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    <option value="">Select gender</option>
                                    <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Status</label>
                                <select name="status" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    <option value="active" {{ old('status', 'active') === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Joined At</label>
                                <input type="datetime-local" name="joined_at" value="{{ old('joined_at') }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Branch</label>
                                <select name="branch_id" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    <option value="">Select branch</option>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ old('branch_id') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Group</label>
                                <select name="group_id" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    <option value="">Select group</option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group->id }}" {{ old('group_id') == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Contact Information --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-slate-700">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-slate-900 dark:text-white">Contact Information</h2>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Email addresses and phone numbers</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Player Email</label>
                                <input type="email" name="player_email" value="{{ old('player_email') }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="player@example.com">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Parent Email</label>
                                <input type="email" name="parent_email" value="{{ old('parent_email') }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="parent@example.com">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Player Phone</label>
                                <input type="text" name="player_phone" value="{{ old('player_phone') }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="+250 7XX XXX XXX">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Emergency Phone</label>
                                <input type="text" name="emergency_phone" value="{{ old('emergency_phone') }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="+250 7XX XXX XXX">
                            </div>
                        </div>
                    </div>

                    {{-- Family Information --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-slate-700">
                            <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-slate-900 dark:text-white">Family Information</h2>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Parents and school details</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Father's Name</label>
                                <input type="text" name="father_name" value="{{ old('father_name') }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="Enter father's name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Mother's Name</label>
                                <input type="text" name="mother_name" value="{{ old('mother_name') }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="Enter mother's name">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">School Name</label>
                                <input type="text" name="school_name" value="{{ old('school_name') }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="Enter school name">
                            </div>
                        </div>
                    </div>

                    {{-- Sports & Program --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-slate-700">
                            <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900/30 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-slate-900 dark:text-white">Sports & Program</h2>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Athletic details and training schedule</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Sport Discipline</label>
                                <select name="sport_discipline" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    <option value="">Select sport</option>
                                    @foreach($sportDisciplines ?? [] as $discipline)
                                        <option value="{{ $discipline }}" {{ old('sport_discipline') === $discipline ? 'selected' : '' }}>{{ $discipline }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Position</label>
                                <select name="position" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    <option value="">Select position</option>
                                    @foreach(['GK', 'Left back', 'Right Back', 'Central Defender', 'Full Back Defender', 'Midfield Defender', 'Rightwing', 'Midfield offensive', 'Striker', 'DD', 'Leftwing'] as $pos)
                                        <option value="{{ $pos }}" {{ old('position') === $pos ? 'selected' : '' }}>{{ $pos }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Coach</label>
                                <select name="coach" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    <option value="">Select coach</option>
                                    @foreach($coaches ?? [] as $coach)
                                        <option value="{{ $coach->name }}" {{ old('coach') === $coach->name ? 'selected' : '' }}>{{ $coach->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Jersey Number</label>
                                <input type="text" name="jersey_number" value="{{ old('jersey_number') }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="e.g., 10">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Jersey Name</label>
                                <input type="text" name="jersey_name" value="{{ old('jersey_name') }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="Name on jersey">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Program</label>
                                <select name="program"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    <option value="">Select Program</option>
                                    <option value="Self Sponsored" {{ old('program') == 'Self Sponsored' ? 'selected' : '' }}>Self Sponsored</option>
                                    <option value="DTFA Sponsored" {{ old('program') == 'DTFA Sponsored' ? 'selected' : '' }}>DTFA Sponsored</option>
                                </select>
                            </div>
                        </div>

                        {{-- Training Days --}}
                        <div class="p-4 bg-indigo-50 dark:bg-indigo-900/20 border border-indigo-200 dark:border-indigo-800 rounded-xl">
                            <label class="block text-sm font-bold text-indigo-900 dark:text-indigo-300 mb-3">Training Days</label>
                            <div class="grid grid-cols-4 md:grid-cols-7 gap-2">
                                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                    <label class="flex flex-col items-center gap-2 cursor-pointer p-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:border-indigo-400 dark:hover:border-indigo-600 transition">
                                        <input type="checkbox" name="training_days[]" value="{{ $day }}"
                                               {{ in_array($day, old('training_days', [])) ? 'checked' : '' }}
                                               class="w-4 h-4 rounded border-slate-300 dark:border-slate-600 text-indigo-600 focus:ring-indigo-500">
                                        <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">{{ substr($day, 0, 3) }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Photo Upload --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-slate-200 dark:border-slate-700">
                            <div class="w-10 h-10 bg-pink-100 dark:bg-pink-900/30 rounded-xl flex items-center justify-center">
                                <svg class="w-5 h-5 text-pink-600 dark:text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-slate-900 dark:text-white">Profile Photo</h2>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Upload a photo for the student</p>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row gap-6 items-start">
                            <div class="flex-1">
                                <div class="p-6 bg-slate-50 dark:bg-slate-800 border-2 border-dashed border-slate-300 dark:border-slate-600 rounded-xl hover:border-indigo-400 dark:hover:border-indigo-600 transition">
                                    <input type="file" name="photo" id="photoInput" accept="image/*"
                                           class="w-full cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:file:bg-indigo-900/30 dark:file:text-indigo-300"
                                           onchange="previewImage(event)">
                                    <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Supported: JPEG, PNG, GIF • Max: 2MB</p>
                                </div>
                            </div>
                            <div id="imagePreviewContainer" class="hidden">
                                <div class="relative">
                                    <img id="imagePreview" src="" class="w-32 h-32 rounded-xl object-cover border-4 border-indigo-200 dark:border-indigo-800 shadow-lg">
                                    <button type="button" onclick="clearImage()"
                                            class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 hover:bg-red-600 text-white rounded-full flex items-center justify-center text-sm font-bold shadow-lg transition">
                                        ×
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Submit Buttons --}}
                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-200 dark:border-slate-700">
                        <a href="{{ route('students-modern.index') }}"
                           class="px-6 py-3 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-semibold rounded-xl transition">
                            Cancel
                        </a>
                        <button type="submit"
                                class="px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl shadow-lg shadow-emerald-500/25 transition-all duration-200 hover:shadow-emerald-500/40 flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Save Student
                        </button>
                    </div>
                </div>
            </form>
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
@endsection
