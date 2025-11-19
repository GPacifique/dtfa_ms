@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Student Self Check-in</h1>

    @if(session('success'))
        <div class="mb-4 p-3 rounded bg-green-100 text-green-800">{{ session('success') }}</div>
    @endif

    @if($children->isEmpty())
        <div class="p-4 bg-yellow-50 rounded">No children found for your account. Contact an admin to link your child.</div>
    @else
        <form method="POST" action="{{ route('student.checkin.store') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold">Select Child</label>
                <select name="student_id" required class="w-full border rounded px-3 py-2">
                    @foreach($children as $child)
                        <option value="{{ $child->id }}">{{ $child->first_name }} {{ $child->second_name }} ({{ optional($child->group)->name ?? $child->group_name }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold">Select Upcoming Session (next 7 days)</label>
                <select name="training_session_id" required class="w-full border rounded px-3 py-2">
                    @forelse($upcoming as $s)
                        <option value="{{ $s->id }}">{{ $s->date->format('M d, Y') }} — {{ $s->start_time }} • {{ optional($s->group)->name ?? $s->group_name }} • {{ optional($s->branch)->name }}</option>
                    @empty
                        <option disabled>No upcoming sessions available</option>
                    @endforelse
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded">Check In</button>
            </div>
        </form>
    @endif
</div>
@endsection
