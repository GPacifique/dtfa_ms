@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold text-slate-900 mb-6">Coach Attendance Sessions</h1>

    <div class="mb-6 flex justify-end">
        <a href="{{ route('coach.attendance.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition">Refresh</a>
    </div>

    @if($sessions->count())
        <div class="bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-600 dark:text-slate-300">
                    <tr>
                        <th class="px-4 py-3 text-left">Date</th>
                        <th class="px-4 py-3 text-left">Time</th>
                        <th class="px-4 py-3 text-left">Location</th>
                        <th class="px-4 py-3 text-left">Group</th>
                        <th class="px-4 py-3 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                    @foreach($sessions as $session)
                        <tr>
                            <td class="px-4 py-3">{{ $session->date ? $session->date->format('M d, Y') : '-' }}</td>
                            <td class="px-4 py-3">{{ $session->start_time }} - {{ $session->end_time }}</td>
                            <td class="px-4 py-3">{{ $session->location ?? '-' }}</td>
                            <td class="px-4 py-3">{{ optional($session->group)->name ?? $session->group_name ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <a href="{{ route('coach.attendance.show', $session) }}" class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-semibold text-xs transition">Record Attendance</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-6">
            {{ $sessions->links() }}
        </div>
    @else
        <div class="text-center text-slate-500 py-16">
            <p>No sessions found.</p>
        </div>
    @endif
</div>
@endsection
