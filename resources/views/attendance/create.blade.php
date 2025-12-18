@extends('layouts.app')

@section('title', 'Create Student Attendance')

@section('content')
<div class="container mx-auto py-8">
    <div class="mb-6 p-4 bg-yellow-50 border-l-4 border-yellow-400 text-yellow-800">
        <strong>Debug: Available Students ({{ $students->count() }})</strong>
        <ul class="list-disc pl-6">
            @foreach($students as $student)
                <li>ID: {{ $student->id }} - {{ $student->first_name }} {{ $student->second_name }}</li>
            @endforeach
        </ul>
    </div>
    <h1 class="text-2xl font-bold mb-6">Create Student Attendance for {{ $date }}</h1>
    <form method="POST" action="{{ route('admin.student-attendance.store') }}">
        @csrf
        <input type="hidden" name="date" value="{{ $date }}">
        <table class="min-w-full bg-white border border-slate-200">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Student</th>
                    <th class="px-4 py-2 border">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                <tr>
                    <td class="px-4 py-2 border">{{ $student->first_name }} {{ $student->second_name }}</td>
                    <td class="px-4 py-2 border">
                        <select name="attendance[{{ $student->id }}]" class="border rounded px-2 py-1">
                            <option value="present">Present</option>
                            <option value="absent">Absent</option>
                            <option value="late">Late</option>
                            <option value="excused">Excused</option>
                        </select>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-6">
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded hover:bg-indigo-700">Save Attendance</button>
        </div>
    </form>
</div>
@endsection
