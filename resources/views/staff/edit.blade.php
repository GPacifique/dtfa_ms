@extends('layouts.app')

@section('content')
    <h2 class="text-xl font-semibold">Edit Staff Profile</h2>

    <div class="mt-6 bg-white dark:bg-slate-800 rounded shadow p-6">
        <form method="POST" action="{{ route('staff.update', $staff) }}">
            @csrf
            @method('PUT')

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
                    <label class="block text-sm">Role / Function</label>
                    <input name="role_function" value="{{ old('role_function', $staff->role_function) }}" class="w-full border rounded px-3 py-2" />
                    @error('role_function')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
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
                    <input name="academic_qualification" value="{{ old('academic_qualification', $staff->academic_qualification) }}" class="w-full border rounded px-3 py-2" />
                    @error('academic_qualification')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm">Major / Combination</label>
                    <input name="major" value="{{ old('major', $staff->major) }}" class="w-full border rounded px-3 py-2" />
                    @error('major')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm">Professional Certificates (one per line)</label>
                    <textarea name="professional_certificates" class="w-full border rounded px-3 py-2">{{ old('professional_certificates', $staff->professional_certificates) }}</textarea>
                    @error('professional_certificates')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm">Top T-Shirt Size</label>
                    <input name="tshirt_size" value="{{ old('tshirt_size', $staff->tshirt_size) }}" class="w-full border rounded px-3 py-2" />
                    @error('tshirt_size')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm">Short Size</label>
                    <input name="short_size" value="{{ old('short_size', $staff->short_size) }}" class="w-full border rounded px-3 py-2" />
                    @error('short_size')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm">Top Tracksuit Size</label>
                    <input name="top_tracksuit_size" value="{{ old('top_tracksuit_size', $staff->top_tracksuit_size) }}" class="w-full border rounded px-3 py-2" />
                    @error('top_tracksuit_size')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div>
                    <label class="block text-sm">Pant Tracksuit Size</label>
                    <input name="pant_tracksuit_size" value="{{ old('pant_tracksuit_size', $staff->pant_tracksuit_size) }}" class="w-full border rounded px-3 py-2" />
                    @error('pant_tracksuit_size')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm">Staff Personnel Email</label>
                    <input name="email" type="email" value="{{ old('email', $staff->email) }}" class="w-full border rounded px-3 py-2" />
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
