@extends('layouts.app')

@section('meta_title', 'Reports — '.config('app.name', 'App'))
@section('meta_description', 'Browse operational reports: workstreams, activities, statuses, and comments. Export PDFs or create new reports.')

@section('content')
<div class="container max-w-7xl mx-auto px-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">📊 Reports</h1>
        <div class="flex gap-2">
            <a href="{{ route('reports.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-semibold">➕ New Report</a>
            <a href="{{ route('reports.export.pdf') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">📥 Export All</a>
            @auth
                <a href="{{ route('reports.export.pdf.me') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition font-semibold">👤 My Reports</a>
            @endauth
        </div>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">{{ session('success') }}</div>
    @endif

    <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 mb-6">
        <form method="get" class="grid grid-cols-1 sm:grid-cols-4 gap-3 items-end">
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Search Workstream</label>
                <input type="text" name="workstream" value="{{ request('workstream') }}" placeholder="Filter..." class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    <option value="">All</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">🔍 Filter</button>
                <a href="{{ route('reports.index') }}" class="px-6 py-2 border border-slate-300 dark:border-slate-600 text-slate-700 dark:text-slate-300 rounded-lg hover:bg-slate-100 dark:hover:bg-slate-700 transition font-medium">Reset</a>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto bg-white dark:bg-slate-800 rounded-lg shadow">
    <table class="w-full text-sm border-collapse">
        <thead class="bg-slate-50 dark:bg-slate-700">
            <tr class="text-left text-slate-600 dark:text-slate-300">
                <th class="px-6 py-3 font-semibold">No</th>
                <th class="px-6 py-3 font-semibold">Workstream</th>
                <th class="px-6 py-3 font-semibold">Activity</th>
                <th class="px-6 py-3 font-semibold">Status</th>
                <th class="px-6 py-3 font-semibold">Comments</th>
                <th class="px-6 py-3 font-semibold">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
            @forelse($reports as $report)
            <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/40 transition">
                <td class="px-6 py-3 text-sm">{{ $report->no }}</td>
                <td class="px-6 py-3 text-sm">{{ $report->workstream }}</td>
                <td class="px-6 py-3 text-sm">{{ $report->activity }}</td>
                <td class="px-6 py-3 text-sm"><span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-400">{{ $report->status }}</span></td>
                <td class="px-6 py-3 text-sm text-slate-600 dark:text-slate-400">{{ Str::limit($report->comments, 50) }}</td>
                <td class="px-6 py-3 text-sm space-x-2 flex gap-2">
                    <a href="{{ route('reports.edit', $report->id) }}" class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded hover:bg-blue-200 dark:hover:bg-blue-900/50 transition font-medium">✏️ Edit</a>
                    <form action="{{ route('reports.destroy', $report->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-3 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 rounded hover:bg-red-200 dark:hover:bg-red-900/50 transition font-medium" onclick="return confirm('Are you sure?')">🗑️ Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                    No reports found. <a href="{{ route('reports.create') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline">Create one</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    </div>
</div>
@endsection
