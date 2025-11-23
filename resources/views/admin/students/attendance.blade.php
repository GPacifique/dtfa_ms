@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Attendance History — {{ $student->first_name }} {{ $student->second_name }}</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.students.attendance.export', $student) }}" class="px-3 py-2 bg-emerald-500 text-white rounded">Export CSV</a>
            <a href="{{ route('admin.students.index') }}" class="px-3 py-2 bg-gray-200 rounded">Back</a>
        </div>
    </div>

    <div class="bg-white shadow rounded p-4">
        <table class="w-full table-auto">
            <thead>
                <tr>
                    <th class="text-left">Date</th>
                    <th class="text-left">Time</th>
                    <th class="text-left">Group</th>
                    <th class="text-left">Location</th>
                    <th class="text-left">Status</th>
                    <th class="text-left">Notes</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $r)
                    <tr class="border-t">
                        <td class="py-2">{{ optional($r->session_date)->format('M d, Y') }}</td>
                        <td class="py-2">{{ $r->session_start }}–{{ $r->session_end }}</td>
                        <td class="py-2">{{ $r->session_group }}</td>
                        <td class="py-2">{{ $r->session_location }}</td>
                        <td class="py-2">{{ ucfirst($r->status) }}</td>
                        <td class="py-2">{{ $r->notes }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">{{ $records->links() }}</div>
    </div>
</div>
@endsection
