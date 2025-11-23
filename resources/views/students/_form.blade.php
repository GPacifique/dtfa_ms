@csrf
<div class="mb-4">
    <label class="block font-semibold mb-1">First Name</label>
    <input type="text" name="first_name" class="w-full border rounded px-3 py-2" value="{{ old('first_name', $student->first_name ?? '') }}" required>
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Last Name</label>
    <input type="text" name="second_name" class="w-full border rounded px-3 py-2" value="{{ old('second_name', $student->second_name ?? '') }}" required>
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Date of Birth</label>
    <input type="date" name="dob" class="w-full border rounded px-3 py-2" value="{{ old('dob', isset($student) && $student->dob ? $student->dob->format('Y-m-d') : '') }}">
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Gender</label>
    <select name="gender" class="w-full border rounded px-3 py-2">
        <option value="">Select</option>
        <option value="male" @if(old('gender', $student->gender ?? '')==='male') selected @endif>Male</option>
        <option value="female" @if(old('gender', $student->gender ?? '')==='female') selected @endif>Female</option>
    </select>
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Phone</label>
    <input type="text" name="phone" class="w-full border rounded px-3 py-2" value="{{ old('phone', $student->phone ?? '') }}">
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Status</label>
    <select name="status" class="w-full border rounded px-3 py-2">
        <option value="active" @if(old('status', $student->status ?? '')==='active') selected @endif>Active</option>
        <option value="inactive" @if(old('status', $student->status ?? '')==='inactive') selected @endif>Inactive</option>
    </select>
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Coach</label>
    @if(isset($coaches) && $coaches->isNotEmpty())
        <select name="coach" class="w-full border rounded px-3 py-2">
            <option value="">—</option>
            @foreach($coaches as $c)
                <option value="{{ $c->name }}" @if(old('coach', $student->coach ?? '')===$c->name) selected @endif>{{ $c->name }} ({{ $c->email }})</option>
            @endforeach
        </select>
    @else
        <input type="text" name="coach" class="w-full border rounded px-3 py-2" value="{{ old('coach', $student->coach ?? '') }}">
    @endif
</div>
<div class="mb-4">
    <label class="block font-semibold mb-1">Profile Image</label>
    <input type="file" name="photo" accept="image/*" class="w-full border rounded px-3 py-2">
    @if(!empty($student->photo_path ?? null))
        <div class="mt-2">
            <img src="{{ $student->photo_url }}" alt="Profile Image" class="h-20 rounded object-cover">
        </div>
    @endif
</div>

<div class="flex items-center">
    <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded font-semibold">{{ $buttonText ?? 'Save' }}</button>
    <a href="{{ $cancelRoute ?? url()->previous() }}" class="ml-4 text-slate-600 underline">Cancel</a>
</div>
