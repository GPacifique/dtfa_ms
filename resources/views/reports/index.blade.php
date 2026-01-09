@extends('layouts.app')

@section('meta_title', 'Reports — '.config('app.name', 'App'))
@section('meta_description', 'Browse operational reports: workstreams, activities, statuses, and comments. Export PDFs or create new reports.')

@section('content')
<div class="container max-w-7xl mx-auto px-4">
    {{-- Hero Section --}}
    <div class="relative overflow-hidden bg-gradient-to-r from-rose-600 via-pink-600 to-fuchsia-600 rounded-2xl shadow-2xl mb-6">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2230%22 height=%2230%22 viewBox=%220 0 30 30%22 fill=%22none%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z%22 fill=%22rgba(255,255,255,0.07)%22/%3E%3C/svg%3E')] opacity-50"></div>
        <div class="absolute -top-24 -right-24 w-96 h-96 bg-gradient-to-br from-orange-400/30 to-yellow-500/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-gradient-to-br from-purple-400/30 to-violet-500/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>

        <div class="relative z-10 px-6 py-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-white drop-shadow-lg">📊 Reports</h1>
                <p class="text-white/90 mt-1">Browse and export operational reports</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('reports.create') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white hover:bg-slate-50 text-pink-700 font-semibold rounded-xl shadow-lg transition-all duration-200 hover:-translate-y-0.5">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    New Report
                </a>
                <a href="{{ route('reports.export.pdf') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-semibold rounded-xl transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                    Export All
                </a>
                @auth
                <a href="{{ route('reports.export.pdf.me') }}" class="inline-flex items-center gap-2 px-4 py-2.5 bg-white/20 hover:bg-white/30 backdrop-blur-sm text-white font-semibold rounded-xl transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    My Reports
                </a>
                @endauth
            </div>
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
