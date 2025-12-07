@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-6 py-8">
        <div class="flex items-center justify-between mb-8">
            <h1 class="text-4xl font-bold text-slate-900 dark:text-white">New Staff Profile</h1>
            <a href="{{ route('staff.index') }}" class="px-4 py-2 border border-slate-300 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800 font-semibold transition">← Back</a>
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 p-8">
            <form method="POST" action="{{ route('staff.store') }}" enctype="multipart/form-data">
                @csrf

                {{-- Photo Upload --}}
                <div class="mb-8 p-6 bg-blue-50 dark:bg-blue-900/20 rounded-lg border border-blue-200 dark:border-blue-800">
                    <label class="block text-sm font-bold text-blue-900 dark:text-blue-300 mb-3">📸 Profile Photo</label>
                    <input type="file" name="photo" accept="image/*" class="block w-full text-sm text-slate-600 dark:text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-100 dark:file:bg-blue-900/50 file:text-blue-700 dark:file:text-blue-300 hover:file:bg-blue-200 dark:hover:file:bg-blue-900/70 transition-colors cursor-pointer">
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-2">Supported: JPEG, PNG, GIF • Max size: 2MB</p>
                    @error('photo')
                        <p class="text-sm text-red-600 dark:text-red-400 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Basic Information Section --}}
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">👤 Basic Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">First Name *</label>
                            <input name="first_name" value="{{ old('first_name') }}" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" required />
                            @error('first_name')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Last Name *</label>
                            <input name="last_name" value="{{ old('last_name') }}" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" required />
                            @error('last_name')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">🏢 Branch</label>
                            <select name="branch" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Select Branch --</option>
                                <option value="RWANDA" {{ old('branch') == 'RWANDA' ? 'selected' : '' }}>🇷🇼 Rwanda</option>
                                <option value="TANZANIA" {{ old('branch') == 'TANZANIA' ? 'selected' : '' }}>🇹🇿 Tanzania</option>
                            </select>
                            @error('branch')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">⚽ Sport Discipline</label>
                            <select name="discipline" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Select --</option>
                                <option value="Football" {{ old('discipline') == 'Football' ? 'selected' : '' }}>⚽ Football</option>
                                <option value="Basketball" {{ old('discipline') == 'Basketball' ? 'selected' : '' }}>🏀 Basketball</option>
                            </select>
                            @error('discipline')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">👥 Gender</label>
                            <select name="gender" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Select --</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>👨 Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>👩 Female</option>
                            </select>
                            @error('gender')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">📅 Date of Birth</label>
                            <input type="date" name="dob" value="{{ old('dob') }}" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                            @error('dob')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Role and Position Section --}}
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">💼 Role & Position</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Role *</label>
                            <select name="role_name" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                                <option value="">-- Select Role --</option>
                                @foreach(($roles ?? []) as $r)
                                    <option value="{{ $r->name }}" @selected(old('role_name')===$r->name)>{{ $r->name }}</option>
                                @endforeach
                            </select>
                            @error('role_name')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Volunteer Role</label>
                            <input name="volunteer_role" value="{{ old('volunteer_role') }}" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="e.g., Senior Coach" />
                            @error('volunteer_role')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">📌 Date of Entry</label>
                            <input type="date" name="date_entry" value="{{ old('date_entry') }}" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                            @error('date_entry')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">📌 Date of Exit</label>
                            <input type="date" name="date_exit" value="{{ old('date_exit') }}" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
                            @error('date_exit')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Qualifications Section --}}
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">🎓 Qualifications & Experience</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Academic Qualification</label>
                            <select name="academic_qualification" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Select Qualification --</option>
                                <option value="Primary" {{ old('academic_qualification') == 'Primary' ? 'selected' : '' }}>Primary</option>
                                <option value="Secondary" {{ old('academic_qualification') == 'Secondary' ? 'selected' : '' }}>Secondary</option>
                                <option value="University" {{ old('academic_qualification') == 'University' ? 'selected' : '' }}>University</option>
                            </select>
                            @error('academic_qualification')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Major / Specialization</label>
                            <input name="major" value="{{ old('major') }}" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="e.g., Sports Science" />
                            @error('major')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Name of University</label>
                            <input name="university_name" value="{{ old('university_name') }}" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="e.g., University of Rwanda" />
                            @error('university_name')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Name of Qualification</label>
                            <input name="qualification_name" value="{{ old('qualification_name') }}" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="e.g., Bachelor of Science" />
                            @error('qualification_name')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Professional Certificates</label>
                            <textarea name="professional_certificates" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="3" placeholder="One certificate per line">{{ old('professional_certificates') }}</textarea>
                            @error('professional_certificates')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Other Organizations</label>
                            <textarea name="other_organizations" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent" rows="3" placeholder="Organizations worked with or affiliated">{{ old('other_organizations') }}</textarea>
                            @error('other_organizations')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Uniform Sizes Section --}}
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">👕 Uniform Sizes</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @php($sizeOptions = ['Small'=>'Small','Medium'=>'Medium','Large'=>'Large','X Large'=>'X Large','XX Large'=>'XX Large','XXX Large'=>'XXX Large'])

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">T-Shirt Size</label>
                            <select name="tshirt_size" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Select --</option>
                                @foreach($sizeOptions as $val => $label)
                                    <option value="{{ $val }}" @selected(old('tshirt_size')===$val)>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('tshirt_size')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Shorts Size</label>
                            <select name="short_size" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Select --</option>
                                @foreach($sizeOptions as $val => $label)
                                    <option value="{{ $val }}" @selected(old('short_size')===$val)>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('short_size')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tracksuit Top</label>
                            <select name="top_tracksuit_size" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Select --</option>
                                @foreach($sizeOptions as $val => $label)
                                    <option value="{{ $val }}" @selected(old('top_tracksuit_size')===$val)>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('top_tracksuit_size')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Tracksuit Pants</label>
                            <select name="pant_tracksuit_size" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="">-- Select --</option>
                                @foreach($sizeOptions as $val => $label)
                                    <option value="{{ $val }}" @selected(old('pant_tracksuit_size')===$val)>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('pant_tracksuit_size')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                        </div>
                    </div>
                </div>

                {{-- Contact Section --}}
                <div class="mb-8">
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white mb-6">📧 Personnel Email</h2>
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">Staff Email Account</label>
                        <select name="email" class="w-full border border-slate-300 dark:border-slate-600 rounded-lg px-3 py-2 dark:bg-slate-700 dark:text-white focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">-- Select User Email --</option>
                            @foreach(($userEmails ?? []) as $email)
                                <option value="{{ $email }}" @selected(old('email')===$email)>{{ $email }}</option>
                            @endforeach
                        </select>
                        @error('email')<p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center gap-4 pt-6 border-t border-slate-200 dark:border-slate-700">
                    <button type="submit" class="px-6 py-2 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg transition">
                        ✓ Save Staff
                    </button>
                    <a href="{{ route('staff.index') }}" class="px-6 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 font-semibold rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 transition">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
