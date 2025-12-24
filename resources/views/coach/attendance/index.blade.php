@extends('layouts.app')

@section('content')
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">📋 Attendance Sessions</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.student-attendance.create') }}" class="px-4 py-2 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition">➕ New Attendance</a>
            <a href="{{ route('coach.attendance.index') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg font-semibold hover:bg-indigo-700 transition">🔄 Refresh</a>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 mb-6">
        <form method="get" class="flex flex-col sm:flex-row gap-3 items-end">
            <div class="flex-1">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Search</label>
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by location, group..." class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Date From</label>
                <input type="date" name="from_date" value="{{ request('from_date') }}" class="px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">🔍 Search</button>
                <a href="{{ route('coach.attendance.index') }}" class="px-6 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition font-medium">Reset</a>
            </div>
        </form>
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
