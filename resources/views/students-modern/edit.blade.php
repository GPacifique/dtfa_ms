@extends('layouts.app')

@section('content')
@section('hide-back')@endsection

<div class="min-h-screen bg-gradient-to-br from-violet-50 via-pink-50 to-cyan-50 dark:from-slate-950 dark:via-slate-900 dark:to-slate-950">
    {{-- Hero Section --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-violet-600 via-fuchsia-600 to-pink-600 dark:from-violet-900 dark:via-fuchsia-900 dark:to-pink-900">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2230%22 height=%2230%22 viewBox=%220 0 30 30%22 fill=%22none%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z%22 fill=%22rgba(255,255,255,0.07)%22/%3E%3C/svg%3E')] opacity-50"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-gradient-to-br from-yellow-400/30 to-orange-500/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-gradient-to-br from-cyan-400/30 to-blue-500/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>

        <div class="relative container mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-indigo-200 mb-6">
                <a href="{{ route('students-modern.index') }}" class="hover:text-white transition">Students</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <a href="{{ route('students-modern.show', $student) }}" class="hover:text-white transition">{{ $student->full_name }}</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
                <span class="text-white font-medium">Edit</span>
            </nav>

            <div class="flex flex-col gap-4 sm:gap-6">
                <div class="flex items-center gap-3 sm:gap-5">
                    {{-- Student Photo --}}
                    <div class="relative flex-shrink-0">
                        <img src="{{ $student->photo_url }}"
                             alt="{{ $student->full_name }}"
                             class="w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 rounded-2xl object-cover border-4 border-white/30 shadow-2xl"
                             onerror="this.src='data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; class=&quot;w-full h-full text-gray-400&quot; viewBox=&quot;0 0 24 24&quot; fill=&quot;%236b7280&quot;><path d=&quot;M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z&quot;/></svg>'">
                        <span class="absolute -bottom-2 -right-2 px-1.5 sm:px-2 py-0.5 sm:py-1 text-[10px] sm:text-xs font-bold rounded-lg shadow-lg
                            {{ $student->status === 'active' ? 'bg-emerald-500 text-white' : 'bg-red-500 text-white' }}">
                            {{ ucfirst($student->status ?? 'Active') }}
                        </span>
                    </div>
                    <div class="min-w-0">
                        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white tracking-tight flex items-center gap-2 sm:gap-3">
                            <svg class="w-6 h-6 sm:w-8 sm:h-8 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            <span class="truncate">Edit Student</span>
                        </h1>
                        <p class="mt-1 text-indigo-100 text-xs sm:text-sm lg:text-base truncate">
                            {{ $student->full_name }} • ID: #{{ $student->id }}
                        </p>
                    </div>
                </div>
                <div class="flex flex-wrap gap-2 sm:gap-3">
                    <a href="{{ route('students-modern.show', $student) }}"
                       class="inline-flex items-center gap-1.5 sm:gap-2 bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-semibold px-3 sm:px-5 py-2 sm:py-2.5 text-sm rounded-xl transition-all duration-200">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                        <span class="hidden xs:inline">View </span>Profile
                    </a>
                    <a href="{{ route('students-modern.index') }}"
                       class="inline-flex items-center gap-1.5 sm:gap-2 bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-semibold px-3 sm:px-5 py-2 sm:py-2.5 text-sm rounded-xl transition-all duration-200">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span class="hidden xs:inline">Back to </span>List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8 -mt-6 relative z-10">
        {{-- Form Card with Gradient Border --}}
        <div class="p-[2px] bg-gradient-to-r from-violet-500 via-fuchsia-500 to-pink-500 rounded-2xl shadow-xl">
            <div class="bg-white dark:bg-slate-900 rounded-2xl overflow-hidden">
            <form action="{{ route('students-modern.update', $student) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Current Photo Display --}}
                <div class="bg-gradient-to-r from-violet-50 via-fuchsia-50 to-pink-50 dark:bg-slate-800/50 p-4 border-b border-violet-100 dark:border-slate-700">
                    <div class="flex items-center justify-center gap-4">
                        <div class="p-1 bg-gradient-to-r from-violet-500 via-fuchsia-500 to-pink-500 rounded-xl">
                            <img src="{{ $student->photo_url }}"
                                 alt="{{ $student->full_name }}"
                                 class="w-16 h-16 rounded-lg object-cover bg-white"
                                 onerror="this.src='data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 24 24&quot; fill=&quot;%236b7280&quot;><path d=&quot;M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z&quot;/></svg>'">
                        </div>
                        <div>
                            <h3 class="font-bold text-transparent bg-clip-text bg-gradient-to-r from-violet-600 via-fuchsia-600 to-pink-600">{{ $student->full_name }}</h3>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Editing student profile</p>
                        </div>
                    </div>
                </div>

                <div class="p-4 sm:p-6 lg:p-8 space-y-6 sm:space-y-8">
                    {{-- Basic Information --}}
                    <div class="space-y-4 sm:space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-violet-100 dark:border-slate-700">
                            <div class="w-10 h-10 bg-gradient-to-br from-violet-500 to-fuchsia-500 rounded-xl flex items-center justify-center shadow-lg shadow-violet-500/25">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-violet-600 to-fuchsia-600">Basic Information</h2>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Personal details and identity</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">First Name <span class="text-red-500">*</span></label>
                                <input type="text" name="first_name" value="{{ old('first_name', $student->first_name) }}" required
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="Enter first name">
                                @error('first_name')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Second Name <span class="text-red-500">*</span></label>
                                <input type="text" name="second_name" value="{{ old('second_name', $student->second_name) }}" required
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="Enter second name">
                                @error('second_name')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Date of Birth</label>
                                <input type="date" name="dob" value="{{ old('dob', $student->dob ? $student->dob->format('Y-m-d') : '') }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                @error('dob')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Gender</label>
                                <select name="gender" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    <option value="">Select gender</option>
                                    <option value="male" {{ old('gender', $student->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $student->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')<p class="mt-1 text-sm text-red-500">{{ $message }}</p>@enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Status</label>
                                <select name="status" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    <option value="active" {{ old('status', $student->status) === 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $student->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Joined At</label>
                                <input type="datetime-local" name="joined_at" value="{{ old('joined_at', $student->joined_at ? $student->joined_at->format('Y-m-d\TH:i') : '') }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Branch</label>
                                <select name="branch_id" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    <option value="">Select branch</option>
                                    @foreach($branches as $branch)
                                        <option value="{{ $branch->id }}" {{ old('branch_id', $student->branch_id) == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Group</label>
                                <select name="group_id" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    <option value="">Select group</option>
                                    @foreach($groups as $group)
                                        <option value="{{ $group->id }}" {{ old('group_id', $student->group_id) == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- Contact Information --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-cyan-100 dark:border-slate-700">
                            <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-500 rounded-xl flex items-center justify-center shadow-lg shadow-cyan-500/25">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-blue-600">Contact Information</h2>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Email addresses and phone numbers</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Player Email</label>
                                <input type="email" name="player_email" value="{{ old('player_email', $student->player_email) }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="player@example.com">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Parent Email</label>
                                <input type="email" name="parent_email" value="{{ old('parent_email', $student->parent_email) }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="parent@example.com">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Player Phone</label>
                                <input type="text" name="player_phone" value="{{ old('player_phone', $student->player_phone) }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="+250 7XX XXX XXX">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Emergency Phone</label>
                                <input type="text" name="emergency_phone" value="{{ old('emergency_phone', $student->emergency_phone) }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="+250 7XX XXX XXX">
                            </div>
                        </div>
                    </div>

                    {{-- Family Information --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-emerald-100 dark:border-slate-700">
                            <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center shadow-lg shadow-emerald-500/25">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600">Family Information</h2>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Parents and school details</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Father's Name</label>
                                <input type="text" name="father_name" value="{{ old('father_name', $student->father_name) }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="Enter father's name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Mother's Name</label>
                                <input type="text" name="mother_name" value="{{ old('mother_name', $student->mother_name) }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="Enter mother's name">
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">School Name</label>
                                <input type="text" name="school_name" value="{{ old('school_name', $student->school_name) }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="Enter school name">
                            </div>
                        </div>
                    </div>

                    {{-- Sports & Program --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-orange-100 dark:border-slate-700">
                            <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-amber-500 rounded-xl flex items-center justify-center shadow-lg shadow-orange-500/25">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-amber-600">Sports & Program</h2>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Athletic details and training schedule</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Sport Discipline</label>
                                <select name="sport_discipline" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    <option value="">Select sport</option>
                                    @foreach($sportDisciplines ?? [] as $discipline)
                                        <option value="{{ $discipline }}" {{ old('sport_discipline', $student->sport_discipline) === $discipline ? 'selected' : '' }}>{{ $discipline }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Position</label>
                                <select name="position" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    <option value="">Select position</option>
                                    @foreach(['GK', 'Left back', 'Right Back', 'Central Defender', 'Full Back Defender', 'Midfield Defender', 'Rightwing', 'Midfield offensive', 'Striker', 'DD', 'Leftwing'] as $pos)
                                        <option value="{{ $pos }}" {{ old('position', $student->position) === $pos ? 'selected' : '' }}>{{ $pos }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Coach</label>
                                <select name="coach" class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition">
                                    <option value="">Select coach</option>
                                    @foreach($coaches ?? [] as $coach)
                                        <option value="{{ $coach->name }}" {{ old('coach', $student->coach) === $coach->name ? 'selected' : '' }}>{{ $coach->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Jersey Number</label>
                                <input type="text" name="jersey_number" value="{{ old('jersey_number', $student->jersey_number) }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="e.g., 10">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Jersey Name</label>
                                <input type="text" name="jersey_name" value="{{ old('jersey_name', $student->jersey_name) }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="Name on jersey">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-1.5">Program</label>
                                <input type="text" name="program" value="{{ old('program', $student->program) }}"
                                       class="w-full px-4 py-2.5 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-900 dark:text-white placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition"
                                       placeholder="Training program">
                            </div>
                        </div>

                        {{-- Training Days --}}
                        @php
                            $studentTrainingDays = is_array($student->training_days)
                                ? $student->training_days
                                : (json_decode($student->training_days, true) ?? []);
                        @endphp
                        <div class="p-4 bg-gradient-to-r from-orange-50 via-amber-50 to-yellow-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-800 rounded-xl">
                            <label class="block text-sm font-bold text-transparent bg-clip-text bg-gradient-to-r from-orange-600 to-amber-600 dark:text-orange-300 mb-3">Training Days</label>
                            <div class="grid grid-cols-4 md:grid-cols-7 gap-2">
                                @foreach(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                    <label class="flex flex-col items-center gap-2 cursor-pointer p-3 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl hover:border-indigo-400 dark:hover:border-indigo-600 transition">
                                        <input type="checkbox" name="training_days[]" value="{{ $day }}"
                                               {{ in_array($day, old('training_days', $studentTrainingDays)) ? 'checked' : '' }}
                                               class="w-4 h-4 rounded border-slate-300 dark:border-slate-600 text-indigo-600 focus:ring-indigo-500">
                                        <span class="text-xs font-semibold text-slate-700 dark:text-slate-300">{{ substr($day, 0, 3) }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Photo Upload --}}
                    <div class="space-y-6">
                        <div class="flex items-center gap-3 pb-4 border-b border-pink-100 dark:border-slate-700">
                            <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-rose-500 rounded-xl flex items-center justify-center shadow-lg shadow-pink-500/25">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-transparent bg-clip-text bg-gradient-to-r from-pink-600 to-rose-600">Profile Photo</h2>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Update the student's photo</p>
                            </div>
                        </div>

                        <div class="flex flex-col md:flex-row gap-6 items-start">
                            {{-- Current Photo --}}
                            <div class="flex flex-col items-center gap-2">
                                <span class="text-sm font-medium text-slate-600 dark:text-slate-400">Current Photo</span>
                                <div class="p-1 bg-gradient-to-r from-pink-500 via-rose-500 to-red-500 rounded-xl">
                                    <img src="{{ $student->photo_url }}"
                                         alt="{{ $student->full_name }}"
                                         class="w-32 h-32 rounded-lg object-cover bg-white"
                                         onerror="this.src='data:image/svg+xml,<svg xmlns=&quot;http://www.w3.org/2000/svg&quot; viewBox=&quot;0 0 24 24&quot; fill=&quot;%236b7280&quot;><path d=&quot;M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z&quot;/></svg>'">
                                </div>
                            </div>

                            {{-- Upload New --}}
                            <div class="flex-1">
                                <span class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-2 block">Upload New Photo</span>
                                <div class="p-6 bg-gradient-to-r from-pink-50 via-rose-50 to-red-50 dark:bg-slate-800 border-2 border-dashed border-pink-300 dark:border-slate-600 rounded-xl hover:border-pink-500 dark:hover:border-pink-600 transition">
                                    <input type="file" name="photo" id="photoInput" accept="image/*"
                                           class="w-full cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-pink-100 file:text-pink-700 hover:file:bg-pink-200 dark:file:bg-pink-900/30 dark:file:text-pink-300"
                                           onchange="previewImage(event)">
                                    <p class="mt-2 text-xs text-slate-500 dark:text-slate-400">Leave empty to keep current photo • Supported: JPEG, PNG, GIF • Max: 2MB</p>
                                </div>
                            </div>

                            {{-- Preview New --}}
                            <div id="imagePreviewContainer" class="hidden">
                                <span class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-2 block">New Photo Preview</span>
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
                    <div class="flex items-center justify-between pt-6 border-t border-slate-200 dark:border-slate-700">
                        <form action="{{ route('students-modern.destroy', $student) }}" method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this student? This action cannot be undone.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="px-6 py-3 bg-red-50 hover:bg-red-100 dark:bg-red-900/20 dark:hover:bg-red-900/30 text-red-600 dark:text-red-400 font-semibold rounded-xl transition flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                                Delete Student
                            </button>
                        </form>

                        <div class="flex gap-3">
                            <a href="{{ route('students-modern.show', $student) }}"
                               class="px-6 py-3 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-semibold rounded-xl transition">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-8 py-3 bg-gradient-to-r from-violet-600 via-fuchsia-600 to-pink-600 hover:from-violet-700 hover:via-fuchsia-700 hover:to-pink-700 text-white font-semibold rounded-xl shadow-lg shadow-fuchsia-500/25 transition-all duration-200 hover:shadow-fuchsia-500/40 hover:scale-105 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Update Student
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
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
