@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-8 rounded shadow">
    <h1 class="text-2xl font-bold mb-6">Add Student</h1>
    <form method="POST" action="{{ route('coach.students.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-4">
            <label class="block font-semibold mb-1">First Name</label>
            <input type="text" name="first_name" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Last Name</label>
            <input type="text" name="last_name" class="w-full border rounded px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Date of Birth</label>
            <input type="date" name="dob" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Gender</label>
            <select name="gender" class="w-full border rounded px-3 py-2">
                <option value="">Select</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Phone</label>
            <input type="text" name="phone" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <div class="mb-4">
            <label class="block font-semibold mb-1">Profile Image</label>
            <input type="file" name="image" accept="image/*" class="w-full border rounded px-3 py-2">
        </div>
        <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded font-semibold">Save Student</button>
        <a href="{{ route('coach.students.index') }}" class="ml-4 text-slate-600 underline">Cancel</a>
    </form>
</div>
@endsection
