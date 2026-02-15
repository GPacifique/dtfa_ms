@extends('layouts.app')

@section('hero')
<x-hero title="CEO Dashboard" subtitle="High-level overview of the academy's performance.">
    <!-- Filters & Export Section -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm p-6 mb-6">
        <form method="GET" action="{{ route('ceo.dashboard') }}" class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Date Range</label>
                <select name="date_range" class="form-select w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-700" onchange="this.form.submit()">
                    <option value="today" {{ $dateRange === 'today' ? 'selected' : '' }}>Today</option>
                    <option value="this_week" {{ $dateRange === 'this_week' ? 'selected' : '' }}>This Week</option>
                    <option value="this_month" {{ $dateRange === 'this_month' ? 'selected' : '' }}>This Month</option>
                    <option value="last_month" {{ $dateRange === 'last_month' ? 'selected' : '' }}>Last Month</option>
                    <option value="this_quarter" {{ $dateRange === 'this_quarter' ? 'selected' : '' }}>This Quarter</option>
                    <option value="this_year" {{ $dateRange === 'this_year' ? 'selected' : '' }}>This Year</option>
                    <option value="last_year" {{ $dateRange === 'last_year' ? 'selected' : '' }}>Last Year</option>
                </select>
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">Branch Filter</label>
                <select name="branch_id" class="form-select w-full rounded-lg border-slate-300 dark:border-slate-600 dark:bg-slate-700" onchange="this.form.submit()">
                    <option value="">All Branches</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{ $selectedBranch == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('ceo.dashboard.export-pdf', request()->query()) }}" class="btn btn-secondary flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    PDF
                </a>
                <a href="{{ route('ceo.dashboard.export-csv', request()->query()) }}" class="btn btn-secondary flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    CSV
                </a>
            </div>
        </form>
    </div>

    <!-- Main KPI Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="card hover:shadow-lg transition-shadow duration-300">
            <div class="card-body">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Revenue (Period)</p>
                        <p class="text-3xl font-bold text-emerald-600">{{ number_format($metrics['revenueThisMonth'] ?? 0) }} RWF</p>
                        <p class="text-xs text-slate-500 mt-2">
                            <span class="{{ ($revenueChangeDirection ?? 'up') === 'up' ? 'text-green-600' : 'text-red-600' }}">
                                {{ ($revenueChangeDirection ?? 'up') === 'up' ? '↑' : '↓' }} {{ abs($revenueChange ?? 0) }}%
                            </span> vs last period
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow text-2xl">
                        💰
                    </div>
                </div>
            </div>
        </div>
        <div class="card hover:shadow-lg transition-shadow duration-300">
            <div class="card-body">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Net Profit</p>
                        <p class="text-3xl font-bold {{ ($netProfitThisMonth ?? 0) >= 0 ? 'text-green-600' : 'text-rose-600' }}">{{ number_format($netProfitThisMonth ?? 0) }} RWF</p>
                        <p class="text-xs text-slate-500 mt-2">Income - Expenses</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow text-2xl">
                        📊
                    </div>
                </div>
            </div>
        </div>
        <div class="card hover:shadow-lg transition-shadow duration-300">
            <div class="card-body">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Active Students</p>
                        <p class="text-3xl font-bold text-indigo-600">{{ $orgStats['activeStudents'] ?? 0 }}</p>
                        <p class="text-xs text-slate-500 mt-2">Total: {{ $orgStats['totalStudents'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl flex items-center justify-center shadow text-2xl">
                        👥
                    </div>
                </div>
            </div>
        </div>
        <div class="card hover:shadow-lg transition-shadow duration-300">
            <div class="card-body">
                <div class="flex items-start justify-between">
                    <div>
                        <p class="text-sm text-slate-600 dark:text-slate-400">Branches / Groups</p>
                        <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $orgStats['totalBranches'] ?? 0 }} / {{ $orgStats['totalGroups'] ?? 0 }}</p>
                        <p class="text-xs text-slate-500 mt-2">Coaches: {{ $orgStats['totalCoaches'] ?? 0 }}</p>
                    </div>
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow text-2xl">
                        🏢
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- New Performance Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="card hover:shadow-lg transition-shadow duration-300">
            <div class="card-body">
                <p class="text-sm text-slate-600 dark:text-slate-400">Attendance Rate</p>
                <p class="text-3xl font-bold text-teal-600">{{ $newMetrics['attendanceRate'] ?? 0 }}%</p>
                <div class="mt-2 w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2">
                    <div class="bg-teal-600 h-2 rounded-full" style="width: {{ $newMetrics['attendanceRate'] ?? 0 }}%"></div>
                </div>
            </div>
        </div>
        <div class="card hover:shadow-lg transition-shadow duration-300">
            <div class="card-body">
                <p class="text-sm text-slate-600 dark:text-slate-400">Retention Rate</p>
                <p class="text-3xl font-bold text-blue-600">{{ $newMetrics['retentionRate'] ?? 0 }}%</p>
                <div class="mt-2 w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $newMetrics['retentionRate'] ?? 0 }}%"></div>
                </div>
            </div>
        </div>
        <div class="card hover:shadow-lg transition-shadow duration-300">
            <div class="card-body">
                <p class="text-sm text-slate-600 dark:text-slate-400">Avg Revenue / Student</p>
                <p class="text-2xl font-bold text-orange-600">{{ number_format($newMetrics['avgRevenuePerStudent'] ?? 0) }} RWF</p>
                <p class="text-xs text-slate-500 mt-2">Per active student</p>
            </div>
        </div>
        <div class="card hover:shadow-lg transition-shadow duration-300">
            <div class="card-body">
                <p class="text-sm text-slate-600 dark:text-slate-400">Growth Rate (30d)</p>
                <p class="text-3xl font-bold text-green-600">+{{ $newMetrics['growthRate'] ?? 0 }}%</p>
                <p class="text-xs text-slate-500 mt-2">{{ $newMetrics['newStudents'] ?? 0 }} new students</p>
            </div>
        </div>
    </div>
</x-hero>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-emerald-50 to-teal-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
    <div class="container mx-auto px-6 mt-8 relative z-20">

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <!-- Revenue Trend Chart -->
            <div class="card">
                <div class="card-body">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Revenue Trend (Last 6 Months)</h3>
                    <div class="h-64">
                        <canvas id="revenueTrendChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Student Growth Chart -->
            <div class="card">
                <div class="card-body">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Student Growth (Last 6 Months)</h3>
                    <div class="h-64">
                        <canvas id="studentGrowthChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Expense Breakdown Chart -->
            <div class="card">
                <div class="card-body">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Expense Breakdown</h3>
                    <div class="h-64 flex items-center justify-center">
                        @if(count($expenseBreakdown['labels'] ?? []) > 0)
                            <canvas id="expenseBreakdownChart"></canvas>
                        @else
                            <p class="text-slate-600 dark:text-slate-400">No expense data available</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Top Branches -->
            <div class="card">
                <div class="card-body">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Top Branches by Revenue</h3>
                    @if(($topBranches ?? collect())->isEmpty())
                        <div class="text-sm text-slate-600 dark:text-slate-400">No revenue recorded yet.</div>
                    @else
                        <div class="space-y-3">
                            @foreach($topBranches as $index => $row)
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center text-white font-bold text-sm">
                                        {{ $index + 1 }}
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex justify-between items-center mb-1">
                                            <span class="font-medium text-slate-800 dark:text-slate-200">{{ $row['branch'] }}</span>
                                            <span class="text-slate-700 dark:text-slate-300 font-semibold">{{ number_format($row['total'] ?? 0) }} RWF</span>
                                        </div>
                                        <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2">
                                            @php
                                                $maxRevenue = $topBranches->max('total');
                                                $percentage = $maxRevenue > 0 ? ($row['total'] / $maxRevenue) * 100 : 0;
                                            @endphp
                                            <div class="bg-gradient-to-r from-emerald-500 to-teal-500 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Upcoming Sessions -->
        <div class="card mb-8">
            <div class="card-body">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Upcoming Training Sessions</h3>
                @if(($upcomingSessions ?? collect())->isEmpty())
                    <div class="text-sm text-slate-600 dark:text-slate-400">No upcoming sessions scheduled.</div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($upcomingSessions as $s)
                            <div class="p-4 bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-700 dark:to-slate-800 rounded-lg border border-slate-300 dark:border-slate-600 hover:shadow-md transition-shadow">
                                <div class="flex items-start gap-3">
                                    <div class="w-12 h-12 bg-indigo-500 rounded-lg flex flex-col items-center justify-center text-white">
                                        <span class="text-xs font-semibold">{{ $s->date->format('M') }}</span>
                                        <span class="text-lg font-bold">{{ $s->date->format('d') }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="font-semibold text-slate-900 dark:text-white">{{ $s->start_time }} - {{ $s->end_time }}</div>
                                        <div class="text-sm text-slate-600 dark:text-slate-400 mt-1">
                                            <div>🏢 {{ optional($s->branch)->name ?? 'No branch' }}</div>
                                            <div>👥 {{ optional($s->group)->name ?? 'No group' }}</div>
                                            <div>👤 {{ optional($s->coach)->name ?? 'No coach' }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="card bg-gradient-to-br from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 border-blue-200 dark:border-blue-700">
                <div class="card-body">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-blue-500 rounded-lg flex items-center justify-center text-white text-2xl">📅</div>
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Sessions This Week</p>
                            <p class="text-3xl font-bold text-blue-600 dark:text-blue-400">{{ $orgStats['sessionsThisWeek'] ?? 0 }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-gradient-to-br from-emerald-50 to-emerald-100 dark:from-emerald-900/20 dark:to-emerald-800/20 border-emerald-200 dark:border-emerald-700">
                <div class="card-body">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-emerald-500 rounded-lg flex items-center justify-center text-white text-2xl">💵</div>
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Total Revenue</p>
                            <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ number_format($metrics['totalRevenue'] ?? 0) }} RWF</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card bg-gradient-to-br from-rose-50 to-rose-100 dark:from-rose-900/20 dark:to-rose-800/20 border-rose-200 dark:border-rose-700">
                <div class="card-body">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-rose-500 rounded-lg flex items-center justify-center text-white text-2xl">💸</div>
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Total Expenses</p>
                            <p class="text-2xl font-bold text-rose-600 dark:text-rose-400">{{ number_format($metrics['totalExpenses'] ?? 0) }} RWF</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics by Sport -->
        <div class="card mb-8">
            <div class="card-body">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="text-2xl">⚽</span> Statistics by Sport
                </h3>
                @if($statsBySport->isEmpty())
                    <p class="text-slate-600 dark:text-slate-400">No sport data available</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-slate-200 dark:border-slate-700">
                                    <th class="text-left py-3 px-4 font-semibold text-slate-700 dark:text-slate-300">Sport</th>
                                    <th class="text-center py-3 px-4 font-semibold text-slate-700 dark:text-slate-300">Total Students</th>
                                    <th class="text-center py-3 px-4 font-semibold text-slate-700 dark:text-slate-300">Active</th>
                                    <th class="text-right py-3 px-4 font-semibold text-slate-700 dark:text-slate-300">Active Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($statsBySport as $stat)
                                <tr class="border-b border-slate-100 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800/50">
                                    <td class="py-3 px-4 font-medium text-slate-900 dark:text-white">{{ $stat['sport'] }}</td>
                                    <td class="py-3 px-4 text-center text-slate-700 dark:text-slate-300">{{ $stat['total'] }}</td>
                                    <td class="py-3 px-4 text-center">
                                        <span class="px-3 py-1 bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-400 rounded-full text-sm font-semibold">
                                            {{ $stat['active'] }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-right text-slate-700 dark:text-slate-300">
                                        {{ $stat['total'] > 0 ? round(($stat['active'] / $stat['total']) * 100, 1) : 0 }}%
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Statistics by Branch -->
        <div class="card mb-8">
            <div class="card-body">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="text-2xl">🏢</span> Statistics by Branch
                </h3>
                @if($statsByBranch->isEmpty())
                    <p class="text-slate-600 dark:text-slate-400">No branch data available</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-slate-200 dark:border-slate-700">
                                    <th class="text-left py-3 px-4 font-semibold text-slate-700 dark:text-slate-300">Branch</th>
                                    <th class="text-center py-3 px-4 font-semibold text-slate-700 dark:text-slate-300">Total Students</th>
                                    <th class="text-center py-3 px-4 font-semibold text-slate-700 dark:text-slate-300">Active</th>
                                    <th class="text-center py-3 px-4 font-semibold text-slate-700 dark:text-slate-300">Groups</th>
                                    <th class="text-right py-3 px-4 font-semibold text-slate-700 dark:text-slate-300">Revenue (Period)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($statsByBranch as $stat)
                                <tr class="border-b border-slate-100 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800/50">
                                    <td class="py-3 px-4 font-medium text-slate-900 dark:text-white">{{ $stat['name'] }}</td>
                                    <td class="py-3 px-4 text-center text-slate-700 dark:text-slate-300">{{ $stat['total_students'] }}</td>
                                    <td class="py-3 px-4 text-center">
                                        <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-sm font-semibold">
                                            {{ $stat['active_students'] }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-center text-slate-700 dark:text-slate-300">{{ $stat['groups'] }}</td>
                                    <td class="py-3 px-4 text-right font-semibold text-emerald-600 dark:text-emerald-400">
                                        {{ number_format($stat['revenue']) }} RWF
                                    </td>
                                </tr>
                                @endforeach
                                <tr class="bg-slate-100 dark:bg-slate-800 font-bold">
                                    <td class="py-3 px-4">TOTAL</td>
                                    <td class="py-3 px-4 text-center">{{ $statsByBranch->sum('total_students') }}</td>
                                    <td class="py-3 px-4 text-center">{{ $statsByBranch->sum('active_students') }}</td>
                                    <td class="py-3 px-4 text-center">{{ $statsByBranch->sum('groups') }}</td>
                                    <td class="py-3 px-4 text-right text-emerald-600 dark:text-emerald-400">
                                        {{ number_format($statsByBranch->sum('revenue')) }} RWF
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Statistics by Gender -->
        <div class="card mb-8">
            <div class="card-body">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="text-2xl">👥</span> Statistics by Gender
                </h3>
                @if($statsByGender->isEmpty())
                    <p class="text-slate-600 dark:text-slate-400">No gender data available</p>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($statsByGender as $stat)
                        <div class="p-6 bg-gradient-to-br from-slate-50 to-slate-100 dark:from-slate-700 dark:to-slate-800 rounded-xl border border-slate-200 dark:border-slate-600">
                            <div class="flex items-center justify-between mb-4">
                                <h4 class="text-lg font-bold text-slate-900 dark:text-white">
                                    {{ ucfirst($stat['gender']) }}
                                </h4>
                                <span class="text-3xl">
                                    @if(strtolower($stat['gender']) === 'male')
                                        👨
                                    @elseif(strtolower($stat['gender']) === 'female')
                                        👩
                                    @else
                                        👤
                                    @endif
                                </span>
                            </div>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">Total Students</p>
                                    <p class="text-3xl font-bold text-slate-900 dark:text-white">{{ $stat['total'] }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-600 dark:text-slate-400">Active Students</p>
                                    <p class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $stat['active'] }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-slate-600 dark:text-slate-400 mb-2">Distribution</p>
                                    <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-3">
                                        <div class="bg-gradient-to-r from-purple-500 to-pink-500 h-3 rounded-full transition-all duration-500"
                                             style="width: {{ $stat['percentage'] }}%"></div>
                                    </div>
                                    <p class="text-right text-sm font-semibold text-slate-700 dark:text-slate-300 mt-1">{{ $stat['percentage'] }}%</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        <!-- Statistics by Group -->
        <div class="card mb-8">
            <div class="card-body">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                    <span class="text-2xl">👥</span> Statistics by Group
                </h3>
                @if($statsByGroup->isEmpty())
                    <p class="text-slate-600 dark:text-slate-400">No group data available</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-slate-200 dark:border-slate-700">
                                    <th class="text-left py-3 px-4 font-semibold text-slate-700 dark:text-slate-300">Group</th>
                                    <th class="text-left py-3 px-4 font-semibold text-slate-700 dark:text-slate-300">Branch</th>
                                    <th class="text-center py-3 px-4 font-semibold text-slate-700 dark:text-slate-300">Total Students</th>
                                    <th class="text-center py-3 px-4 font-semibold text-slate-700 dark:text-slate-300">Active</th>
                                    <th class="text-right py-3 px-4 font-semibold text-slate-700 dark:text-slate-300">Revenue (Period)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($statsByGroup as $stat)
                                <tr class="border-b border-slate-100 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-800/50">
                                    <td class="py-3 px-4 font-medium text-slate-900 dark:text-white">{{ $stat['name'] }}</td>
                                    <td class="py-3 px-4 text-slate-600 dark:text-slate-400">{{ $stat['branch'] }}</td>
                                    <td class="py-3 px-4 text-center text-slate-700 dark:text-slate-300">{{ $stat['total_students'] }}</td>
                                    <td class="py-3 px-4 text-center">
                                        <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 rounded-full text-sm font-semibold">
                                            {{ $stat['active_students'] }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-4 text-right font-semibold text-emerald-600 dark:text-emerald-400">
                                        {{ number_format($stat['revenue']) }} RWF
                                    </td>
                                </tr>
                                @endforeach
                                <tr class="bg-slate-100 dark:bg-slate-800 font-bold">
                                    <td class="py-3 px-4" colspan="2">TOTAL</td>
                                    <td class="py-3 px-4 text-center">{{ $statsByGroup->sum('total_students') }}</td>
                                    <td class="py-3 px-4 text-center">{{ $statsByGroup->sum('active_students') }}</td>
                                    <td class="py-3 px-4 text-right text-emerald-600 dark:text-emerald-400">
                                        {{ number_format($statsByGroup->sum('revenue')) }} RWF
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check if Chart.js is loaded
    if (typeof Chart === 'undefined') {
        console.error('Chart.js is not loaded');
        return;
    }

    // Common chart options
    const commonOptions = {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'bottom'
            }
        }
    };

    // Revenue Trend Chart
    const revenueTrendCtx = document.getElementById('revenueTrendChart');
    if (revenueTrendCtx) {
        new Chart(revenueTrendCtx, {
            type: 'line',
            data: {
                labels: @json($revenueTrend['labels'] ?? []),
                datasets: [{
                    label: 'Revenue (RWF)',
                    data: @json($revenueTrend['data'] ?? []),
                    borderColor: 'rgb(16, 185, 129)',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: 'rgb(16, 185, 129)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                ...commonOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString() + ' RWF';
                            }
                        }
                    }
                }
            }
        });
    }

    // Student Growth Chart
    const studentGrowthCtx = document.getElementById('studentGrowthChart');
    if (studentGrowthCtx) {
        new Chart(studentGrowthCtx, {
            type: 'line',
            data: {
                labels: @json($studentGrowth['labels'] ?? []),
                datasets: [{
                    label: 'Total Students',
                    data: @json($studentGrowth['data'] ?? []),
                    borderColor: 'rgb(99, 102, 241)',
                    backgroundColor: 'rgba(99, 102, 241, 0.1)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointBackgroundColor: 'rgb(99, 102, 241)',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                ...commonOptions,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }

    // Expense Breakdown Chart
    const expenseBreakdownCtx = document.getElementById('expenseBreakdownChart');
    if (expenseBreakdownCtx) {
        const expenseLabels = @json($expenseBreakdown['labels'] ?? []);
        const expenseData = @json($expenseBreakdown['data'] ?? []);

        if (expenseLabels.length > 0) {
            new Chart(expenseBreakdownCtx, {
                type: 'doughnut',
                data: {
                    labels: expenseLabels,
                    datasets: [{
                        data: expenseData,
                        backgroundColor: [
                            'rgb(239, 68, 68)',
                            'rgb(59, 130, 246)',
                            'rgb(16, 185, 129)',
                            'rgb(245, 158, 11)',
                            'rgb(139, 92, 246)',
                            'rgb(236, 72, 153)',
                            'rgb(20, 184, 166)',
                        ],
                        borderWidth: 2,
                        borderColor: '#fff'
                    }]
                },
                options: {
                    ...commonOptions,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'right'
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return context.label + ': ' + context.parsed.toLocaleString() + ' RWF';
                                }
                            }
                        }
                    }
                }
            });
        }
    }
});
</script>
@endpush
@endsection
