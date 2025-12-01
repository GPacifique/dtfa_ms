@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-emerald-50 to-teal-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">
    <div class="footer-like-hero relative overflow-hidden">
        <div class="hero-blob-layer">
            <div class="hero-blob blob-1"></div>
            <div class="hero-blob blob-2"></div>
            <div class="hero-blob blob-3"></div>
        </div>
        <div class="relative z-10 container mx-auto px-6 py-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">CEO Dashboard</h1>
            <p class="text-emerald-100">High-level overview of performance and growth</p>
        </div>
    </div>

    <div class="container mx-auto px-6 mt-8 relative z-20">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Revenue (This Month)</p>
                            <p class="text-3xl font-bold text-emerald-600">{{ number_format(($metrics['revenueThisMonth'] ?? 0) / 100, 0) }} RWF</p>
                            <p class="text-xs text-slate-500 mt-2">
                                <span class="{{ ($revenueChangeDirection ?? 'up') === 'up' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ ($revenueChangeDirection ?? 'up') === 'up' ? '↑' : '↓' }} {{ abs($revenueChange ?? 0) }}%
                                </span> vs last month
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow">
                            💰
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <p class="text-sm text-slate-600 dark:text-slate-400">Net Profit (This Month)</p>
                    <p class="text-3xl font-bold {{ ($netProfitThisMonth ?? 0) >= 0 ? 'text-green-600' : 'text-rose-600' }}">{{ number_format(($netProfitThisMonth ?? 0) / 100, 0) }} RWF</p>
                    <p class="text-xs text-slate-500 mt-2">Revenue + Income - Expenses</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <p class="text-sm text-slate-600 dark:text-slate-400">Active Students</p>
                    <p class="text-3xl font-bold text-indigo-600">{{ $orgStats['activeStudents'] ?? 0 }}</p>
                    <p class="text-xs text-slate-500 mt-2">Total: {{ $orgStats['totalStudents'] ?? 0 }}</p>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <p class="text-sm text-slate-600 dark:text-slate-400">Branches / Groups</p>
                    <p class="text-3xl font-bold text-slate-900">{{ $orgStats['totalBranches'] ?? 0 }} / {{ $orgStats['totalGroups'] ?? 0 }}</p>
                    <p class="text-xs text-slate-500 mt-2">Coaches: {{ $orgStats['totalCoaches'] ?? 0 }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-lg font-semibold text-slate-900 mb-3">Top Branches by Revenue (This Month)</h3>
                    @if(($topBranches ?? collect())->isEmpty())
                        <div class="text-sm text-slate-600">No revenue recorded yet.</div>
                    @else
                        <ul class="divide-y divide-slate-200">
                            @foreach($topBranches as $row)
                                <li class="py-2 flex items-center justify-between">
                                    <span class="font-medium text-slate-800">{{ $row['branch'] }}</span>
                                    <span class="text-slate-700">{{ number_format(($row['total'] ?? 0)/100, 0) }} RWF</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h3 class="text-lg font-semibold text-slate-900 mb-3">Upcoming Sessions</h3>
                    @if(($upcomingSessions ?? collect())->isEmpty())
                        <div class="text-sm text-slate-600">No upcoming sessions scheduled.</div>
                    @else
                        <ul class="space-y-2">
                            @foreach($upcomingSessions as $s)
                                <li class="p-3 bg-slate-50 rounded-lg border border-slate-200">
                                    <div class="font-medium text-slate-900">{{ $s->date->format('M d, Y') }} • {{ $s->start_time }}–{{ $s->end_time }}</div>
                                    <div class="text-xs text-slate-600 mt-1">{{ optional($s->branch)->name ?? '—' }} • {{ optional($s->group)->name ?? '—' }} • {{ optional($s->coach)->name ?? '—' }}</div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="card"><div class="card-body"><p class="text-sm text-slate-600">Sessions This Week</p><p class="text-3xl font-bold">{{ $orgStats['sessionsThisWeek'] ?? 0 }}</p></div></div>
            <div class="card"><div class="card-body"><p class="text-sm text-slate-600">Total Revenue</p><p class="text-3xl font-bold">{{ number_format(($metrics['totalRevenue'] ?? 0 + ($metrics['totalOtherIncome'] ?? 0))/100, 0) }} RWF</p></div></div>
            <div class="card"><div class="card-body"><p class="text-sm text-slate-600">Total Expenses</p><p class="text-3xl font-bold">{{ number_format(($metrics['totalExpenses'] ?? 0)/100, 0) }} RWF</p></div></div>
        </div>
    </div>
</div>
@endsection
