@extends('layouts.app-sidebar')

@section('content')
    <h2 class="text-xl font-semibold">New Staff Profile</h2>

    <div class="mt-6 bg-white dark:bg-slate-800 rounded shadow p-6">
        <form method="POST" action="{{ route('staff.store') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm">First Name</label>
                    <input name="first_name" value="{{ old('first_name') }}" class="w-full border rounded px-3 py-2" required />
                </div>
                <div>
                    <label class="block text-sm">Last Name</label>
                    <input name="last_name" value="{{ old('last_name') }}" class="w-full border rounded px-3 py-2" />
                </div>

                <div>
                    <label class="block text-sm">Branch</label>
                    <select name="branch" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Branch --</option>
                        <option value="RWANDA" {{ old('branch') == 'RWANDA' ? 'selected' : '' }}>Rwanda</option>
                        <option value="TANZANIA" {{ old('branch') == 'TANZANIA' ? 'selected' : '' }}>Tanzania</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm">Sport Discipline</label>
                    <select name="discipline" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select --</option>
                        <option value="Football" {{ old('discipline') == 'Football' ? 'selected' : '' }}>Football</option>
                        <option value="Basketball" {{ old('discipline') == 'Basketball' ? 'selected' : '' }}>Basketball</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm">Gender</label>
                    <select name="gender" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select --</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm">Date of Birth</label>
                    <input type="date" name="dob" value="{{ old('dob') }}" class="w-full border rounded px-3 py-2" />
                </div>

                <div>
                    <label class="block text-sm">Role / Function</label>
                    <input name="role_function" value="{{ old('role_function') }}" class="w-full border rounded px-3 py-2" />
                </div>

                <div>
                    <label class="block text-sm">Date of Entry</label>
                    <input type="date" name="date_entry" value="{{ old('date_entry') }}" class="w-full border rounded px-3 py-2" />
                </div>

                <div>
                    <label class="block text-sm">Date of Exit</label>
                    <input type="date" name="date_exit" value="{{ old('date_exit') }}" class="w-full border rounded px-3 py-2" />
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm">Other organizations</label>
                    <textarea name="other_organizations" class="w-full border rounded px-3 py-2">{{ old('other_organizations') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm">Academic Qualification</label>
                    <input name="academic_qualification" value="{{ old('academic_qualification') }}" class="w-full border rounded px-3 py-2" />
                </div>

                <div>
                    <label class="block text-sm">Major / Combination</label>
                    <input name="major" value="{{ old('major') }}" class="w-full border rounded px-3 py-2" />
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm">Professional Certificates (one per line)</label>
                    <textarea name="professional_certificates" class="w-full border rounded px-3 py-2">{{ old('professional_certificates') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm">Top T-Shirt Size</label>
                    <input name="tshirt_size" value="{{ old('tshirt_size') }}" class="w-full border rounded px-3 py-2" />
                </div>

                <div>
                    <label class="block text-sm">Short Size</label>
                    <input name="short_size" value="{{ old('short_size') }}" class="w-full border rounded px-3 py-2" />
                </div>

                <div>
                    <label class="block text-sm">Top Tracksuit Size</label>
                    <input name="top_tracksuit_size" value="{{ old('top_tracksuit_size') }}" class="w-full border rounded px-3 py-2" />
                </div>

                <div>
                    <label class="block text-sm">Pant Tracksuit Size</label>
                    <input name="pant_tracksuit_size" value="{{ old('pant_tracksuit_size') }}" class="w-full border rounded px-3 py-2" />
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm">Staff Personnel Email</label>
                    <input name="email" type="email" value="{{ old('email') }}" class="w-full border rounded px-3 py-2" />
                </div>
            </div>

            <div class="mt-4">
                <button class="px-4 py-2 bg-green-600 text-white rounded">Save</button>
                <a href="{{ route('staff.index') }}" class="ml-2 px-4 py-2 border rounded">Cancel</a>
            </div>
        </form>
    </div>
@endsection
