@extends('layouts.app')

@section('hero')
    <x-hero title="Edit Staff Profile" subtitle="Update staff details and roles">
        <div class="mt-4 flex items-center gap-2">

        </div>
    </x-hero>
@endsection

@section('content')
    <div class="bg-white dark:bg-slate-800 rounded shadow p-6 mt-6">
        <form method="POST" action="{{ route('staff.update', $staff) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Photo Upload --}}
            <div class="mb-6 p-4 bg-slate-50 dark:bg-slate-900/30 rounded-lg border border-slate-200 dark:border-slate-700">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-3">Profile Photo</label>
                <div class="flex items-start gap-4 mb-3">
                    <img src="{{ $staff->photo_url }}" alt="{{ $staff->first_name }}" class="w-20 h-20 rounded-full object-cover ring-2 ring-slate-300 dark:ring-slate-600">
                    <div class="flex-1">
                        <input type="file" name="photo" accept="image/*" class="block w-full text-sm text-slate-600 dark:text-slate-400 file:mr-3 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 dark:file:bg-indigo-900/30 file:text-indigo-700 dark:file:text-indigo-400 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900/50 transition-colors cursor-pointer">
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Upload new photo to replace current • Supported: JPEG, PNG, GIF • Max: 2MB</p>
                    </div>
                </div>
                @error('photo')
                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm">First Name</label>
                    <input name="first_name" value="{{ old('first_name', $staff->first_name) }}" class="w-full border rounded px-3 py-2" required />
                    @error('first_name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-sm">Last Name</label>
                    <input name="last_name" value="{{ old('last_name', $staff->last_name) }}" class="w-full border rounded px-3 py-2" />
                    @error('last_name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm">Branch</label>
                    <select name="branch" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Branch --</option>
                        <option value="RWANDA" {{ old('branch', $staff->branch) == 'RWANDA' ? 'selected' : '' }}>Rwanda</option>
                        <option value="TANZANIA" {{ old('branch', $staff->branch) == 'TANZANIA' ? 'selected' : '' }}>Tanzania</option>
                    </select>
                    @error('branch')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm">Sport Discipline</label>
                    <select name="discipline" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select --</option>
                        <option value="Football" {{ old('discipline', $staff->discipline) == 'Football' ? 'selected' : '' }}>Football</option>
                        <option value="Basketball" {{ old('discipline', $staff->discipline) == 'Basketball' ? 'selected' : '' }}>Basketball</option>
                    </select>
                    @error('discipline')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm">Gender</label>
                    <select name="gender" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select --</option>
                        <option value="Male" {{ old('gender', $staff->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $staff->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                    @error('gender')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm">Date of Birth</label>
                    <input type="date" name="dob" value="{{ old('dob', $staff->dob?->format('Y-m-d')) }}" class="w-full border rounded px-3 py-2" />
                    @error('dob')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm">Role</label>
                    <select name="role_name" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Role --</option>
                        @foreach(($roles ?? []) as $r)
                            <option value="{{ $r->name }}" @selected(old('role_name',$staff->role_function)===$r->name)>{{ $r->name }}</option>
                        @endforeach
                    </select>
                    @error('role_name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-sm">Volunteer Role</label>
                    <input name="volunteer_role" value="{{ old('volunteer_role', $staff->volunteer_role) }}" class="w-full border rounded px-3 py-2" />
                    @error('volunteer_role')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm">Date of Entry</label>
                    <input type="date" name="date_entry" value="{{ old('date_entry', $staff->date_entry?->format('Y-m-d')) }}" class="w-full border rounded px-3 py-2" />
                    @error('date_entry')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm">Date of Exit</label>
                    <input type="date" name="date_exit" value="{{ old('date_exit', $staff->date_exit?->format('Y-m-d')) }}" class="w-full border rounded px-3 py-2" />
                    @error('date_exit')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm">Other organizations</label>
                    <textarea name="other_organizations" class="w-full border rounded px-3 py-2">{{ old('other_organizations', $staff->other_organizations) }}</textarea>
                    @error('other_organizations')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm">Academic Qualification</label>
                    <select name="academic_qualification" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Qualification --</option>
                        <option value="Primary" {{ old('academic_qualification', $staff->academic_qualification) == 'Primary' ? 'selected' : '' }}>Primary</option>
                        <option value="Secondary" {{ old('academic_qualification', $staff->academic_qualification) == 'Secondary' ? 'selected' : '' }}>Secondary</option>
                        <option value="University" {{ old('academic_qualification', $staff->academic_qualification) == 'University' ? 'selected' : '' }}>University</option>
                    </select>
                    @error('academic_qualification')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm">Major / Combination</label>
                    <input name="major" value="{{ old('major', $staff->major) }}" class="w-full border rounded px-3 py-2" />
                    @error('major')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm">Name of University</label>
                    <input name="university_name" value="{{ old('university_name', $staff->university_name) }}" class="w-full border rounded px-3 py-2" />
                    @error('university_name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm">Name of Qualification</label>
                    <input name="qualification_name" value="{{ old('qualification_name', $staff->qualification_name) }}" class="w-full border rounded px-3 py-2" />
                    @error('qualification_name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm">Professional Certificates (one per line)</label>
                    <textarea name="professional_certificates" class="w-full border rounded px-3 py-2">{{ old('professional_certificates', $staff->professional_certificates) }}</textarea>
                    @error('professional_certificates')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                @php($sizeOptions = ['Small'=>'Small','Medium'=>'Medium','Large'=>'Large','X Large'=>'X Large','XX Large'=>'XX Large','XXX Large'=>'XXX Large'])
                <div>
                    <label class="block text-sm">Top T-Shirt Size</label>
                    <select name="tshirt_size" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Size --</option>
                        @foreach($sizeOptions as $val => $label)
                            <option value="{{ $val }}" @selected(old('tshirt_size', $staff->tshirt_size)===$val)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('tshirt_size')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm">Short Size</label>
                    <select name="short_size" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Size --</option>
                        @foreach($sizeOptions as $val => $label)
                            <option value="{{ $val }}" @selected(old('short_size', $staff->short_size)===$val)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('short_size')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm">Top Tracksuit Size</label>
                    <select name="top_tracksuit_size" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Size --</option>
                        @foreach($sizeOptions as $val => $label)
                            <option value="{{ $val }}" @selected(old('top_tracksuit_size', $staff->top_tracksuit_size)===$val)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('top_tracksuit_size')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm">Pant Tracksuit Size</label>
                    <select name="pant_tracksuit_size" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Size --</option>
                        @foreach($sizeOptions as $val => $label)
                            <option value="{{ $val }}" @selected(old('pant_tracksuit_size', $staff->pant_tracksuit_size)===$val)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('pant_tracksuit_size')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm">Staff Personnel Email</label>
                    <select name="email" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select User Email --</option>
                        @foreach(($userEmails ?? []) as $email)
                            <option value="{{ $email }}" @selected(old('email', $staff->email)===$email)>{{ $email }}</option>
                        @endforeach
                    </select>
                    @error('email')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="mt-4">
                <button class="px-4 py-2 bg-green-600 text-white rounded">Update</button>
                <a href="{{ route('staff.index') }}" class="ml-2 px-4 py-2 border rounded">Cancel</a>
            </div>
        </form>
    </div>
@endsection
