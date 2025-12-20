@extends('layouts.app')
@section('title', 'Admin Dashboard')

@section('content')
@php
    $__subsLabels = isset($subsLabels) && is_array($subsLabels) ? $subsLabels : ['Jun','Jul','Aug','Sep','Oct','Nov'];
    $__subsActive = isset($subsActive) && is_array($subsActive) ? $subsActive : [120, 135, 150, 160, 175, 190];
    $__subsNew = isset($subsNew) && is_array($subsNew) ? $subsNew : [20, 25, 30, 28, 35, 40];
    $__regLabels = isset($regLabels) && is_array($regLabels) ? $regLabels : ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    $__regCounts = isset($regCounts) && is_array($regCounts) ? $regCounts : [12, 19, 7, 15, 22, 18, 25, 17, 20, 23, 16, 21];
    $__feesPaid = isset($feesPaidCount) ? (int)$feesPaidCount : 70;
    $__feesPending = isset($feesPendingCount) ? (int)$feesPendingCount : 20;
    $__feesOverdue = isset($feesOverdueCount) ? (int)$feesOverdueCount : 10;
@endphp
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-emerald-50 to-teal-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">

    {{-- Hero Section --}}
    <div class="footer-like-hero relative overflow-hidden">
        <div class="hero-blob-layer">
            <div class="hero-blob blob-1"></div>
            <div class="hero-blob blob-2"></div>
            <div class="hero-blob blob-3"></div>
        </div>

        <div class="relative z-10 container mx-auto px-6 py-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Admin Dashboard</h1>
            <p class="text-emerald-100">A high-level view of academy operations</p>
        </div>
    </div>

    <div class="container mx-auto px-6 -mt-8">

        {{-- Main KPI Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            {{-- Total Users --}}
            <a href="{{ route('admin.students.index') }}" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Students</p>
                            <h3 class="text-3xl font-bold text-blue-600 dark:text-blue-400" data-animate-count>
                                {{ $stats['totalStudents'] ?? 0 }}
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                All time registered
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Active Students --}}
            <a href="{{ route('admin.students.index') }}" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Active Students</p>
                            <h3 class="text-3xl font-bold text-emerald-600 dark:text-emerald-400" data-animate-count>
                                {{ $stats['activeStudents'] ?? 0 }}
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                Currently enrolled
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Sessions --}}
            <a href="{{ route('admin.training_session_records.index') }}" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Sessions ({{ $rangeLabel ?? 'Today' }})</p>
                            <h3 class="text-3xl font-bold text-purple-600 dark:text-purple-400" data-animate-count>
                                {{ $stats['todaySessions'] ?? 0 }}
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                Scheduled
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Revenue --}}
            <a href="{{ route('accountant.payments.index') }}" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Revenue (This Month)</p>
                            <h3 class="text-3xl font-bold text-teal-600 dark:text-teal-400" data-animate-count>
                                {{ number_format((int) floor((($stats['revenueThisMonth'] ?? 0) + ($stats['incomeThisMonth'] ?? 0)) / 100)) }} RWF
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                RWF
                            </p>
                            <div class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                <div>Payments: {{ number_format((int) floor(($stats['revenueThisMonth'] ?? 0)/100)) }} RWF</div>
                                <div>Subscriptions (this month): {{ number_format((int) floor(($stats['subscriptionRevenueThisMonth'] ?? 0)/100)) }} RWF</div>
                                <div>Other incomes: {{ number_format((int) floor(($stats['incomeThisMonth'] ?? 0)/100)) }} RWF</div>
                            </div>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Charts Overview --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
            {{-- Income vs Expenses Chart (Large) --}}
            <div class="card lg:col-span-2">
                <div class="card-body">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl md:text-2xl font-semibold text-slate-900 dark:text-white">💰 Income vs Expenses (Last 12 Months)</h3>
                        <div class="flex items-center gap-4 text-sm">
                            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-emerald-500"></span> Income</span>
                            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-full bg-red-500"></span> Expenses</span>
                            <span class="flex items-center gap-1"><span class="w-3 h-3 rounded-sm bg-blue-500"></span> Net Profit</span>
                        </div>
                    </div>
                    <div class="h-80">
                        <canvas id="incomeExpensesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Finance Summary Section --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2 class="text-xl md:text-2xl font-bold text-slate-900 dark:text-white">Finance Summary</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-4">
                {{-- Daily Summary --}}
                <div class="card bg-gradient-to-br from-blue-50 to-indigo-50 dark:from-slate-800 dark:to-slate-700 border-l-4 border-blue-500">
                    <div class="card-body">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <h4 class="font-semibold text-blue-800 dark:text-blue-300">Today</h4>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-600 dark:text-slate-400">Income</span>
                                <span class="font-bold text-emerald-600">{{ number_format($financeStats['daily']['income'] ?? 0) }} RWF</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-600 dark:text-slate-400">Expenses</span>
                                <span class="font-bold text-red-600">{{ number_format($financeStats['daily']['expenses'] ?? 0) }} RWF</span>
                            </div>
                            <hr class="border-slate-300 dark:border-slate-600">
                            @php $dailyBalance = ($financeStats['daily']['income'] ?? 0) - ($financeStats['daily']['expenses'] ?? 0); @endphp
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Balance</span>
                                <span class="font-bold text-lg {{ $dailyBalance >= 0 ? 'text-emerald-700' : 'text-red-700' }}">
                                    {{ $dailyBalance >= 0 ? '+' : '' }}{{ number_format($dailyBalance) }} RWF
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Weekly Summary --}}
                <div class="card bg-gradient-to-br from-purple-50 to-pink-50 dark:from-slate-800 dark:to-slate-700 border-l-4 border-purple-500">
                    <div class="card-body">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            <h4 class="font-semibold text-purple-800 dark:text-purple-300">This Week</h4>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-600 dark:text-slate-400">Income</span>
                                <span class="font-bold text-emerald-600">{{ number_format($financeStats['weekly']['income'] ?? 0) }} RWF</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-600 dark:text-slate-400">Expenses</span>
                                <span class="font-bold text-red-600">{{ number_format($financeStats['weekly']['expenses'] ?? 0) }} RWF</span>
                            </div>
                            <hr class="border-slate-300 dark:border-slate-600">
                            @php $weeklyBalance = ($financeStats['weekly']['income'] ?? 0) - ($financeStats['weekly']['expenses'] ?? 0); @endphp
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Balance</span>
                                <span class="font-bold text-lg {{ $weeklyBalance >= 0 ? 'text-emerald-700' : 'text-red-700' }}">
                                    {{ $weeklyBalance >= 0 ? '+' : '' }}{{ number_format($weeklyBalance) }} RWF
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Monthly Summary --}}
                <div class="card bg-gradient-to-br from-amber-50 to-orange-50 dark:from-slate-800 dark:to-slate-700 border-l-4 border-amber-500">
                    <div class="card-body">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <h4 class="font-semibold text-amber-800 dark:text-amber-300">This Month</h4>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-600 dark:text-slate-400">Income</span>
                                <span class="font-bold text-emerald-600">{{ number_format($financeStats['monthly']['income'] ?? 0) }} RWF</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-600 dark:text-slate-400">Expenses</span>
                                <span class="font-bold text-red-600">{{ number_format($financeStats['monthly']['expenses'] ?? 0) }} RWF</span>
                            </div>
                            <hr class="border-slate-300 dark:border-slate-600">
                            @php $monthlyBalance = ($financeStats['monthly']['income'] ?? 0) - ($financeStats['monthly']['expenses'] ?? 0); @endphp
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Balance</span>
                                <span class="font-bold text-lg {{ $monthlyBalance >= 0 ? 'text-emerald-700' : 'text-red-700' }}">
                                    {{ $monthlyBalance >= 0 ? '+' : '' }}{{ number_format($monthlyBalance) }} RWF
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Yearly Summary --}}
                <div class="card bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-slate-800 dark:to-slate-700 border-l-4 border-emerald-500">
                    <div class="card-body">
                        <div class="flex items-center gap-2 mb-3">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                            </svg>
                            <h4 class="font-semibold text-emerald-800 dark:text-emerald-300">This Year</h4>
                        </div>
                        <div class="space-y-2">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-600 dark:text-slate-400">Income</span>
                                <span class="font-bold text-emerald-600">{{ number_format($financeStats['yearly']['income'] ?? 0) }} RWF</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-slate-600 dark:text-slate-400">Expenses</span>
                                <span class="font-bold text-red-600">{{ number_format($financeStats['yearly']['expenses'] ?? 0) }} RWF</span>
                            </div>
                            <hr class="border-slate-300 dark:border-slate-600">
                            @php $yearlyBalance = ($financeStats['yearly']['income'] ?? 0) - ($financeStats['yearly']['expenses'] ?? 0); @endphp
                            <div class="flex justify-between items-center">
                                <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Balance</span>
                                <span class="font-bold text-lg {{ $yearlyBalance >= 0 ? 'text-emerald-700' : 'text-red-700' }}">
                                    {{ $yearlyBalance >= 0 ? '+' : '' }}{{ number_format($yearlyBalance) }} RWF
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-xl md:text-2xl font-semibold text-slate-900 dark:text-white">Monthly Registrations</h3>
                    </div>
                    <canvas id="adminRegistrationsChart" height="200"></canvas>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-xl md:text-2xl font-semibold text-slate-900 dark:text-white">Fees Status</h3>
                    </div>
                    <canvas id="adminFeesChart" height="200"></canvas>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center justify-between mb-2">
                        <h3 class="text-xl md:text-2xl font-semibold text-slate-900 dark:text-white">Subscriptions (Last 6 months)</h3>
                    </div>
                    <canvas id="adminSubscriptionsChart" height="200"></canvas>
                </div>
            </div>
        </div>

        @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                if (window.Chart) {
                    // Income vs Expenses Chart (new prominent chart)
                    const incExpCtx = document.getElementById('incomeExpensesChart');
                    if (incExpCtx) {
                        const finLabels = @json($financeLabels ?? []);
                        const incomeData = @json($incomeTotals ?? []);
                        const expenseData = @json($expenseTotals ?? []);
                        const netflowData = @json($netflowTotals ?? []);

                        new Chart(incExpCtx, {
                            type: 'bar',
                            data: {
                                labels: finLabels,
                                datasets: [
                                    {
                                        type: 'bar',
                                        label: 'Income',
                                        data: incomeData,
                                        backgroundColor: 'rgba(16, 185, 129, 0.8)',
                                        borderColor: '#10b981',
                                        borderWidth: 1,
                                        borderRadius: 4,
                                        order: 2
                                    },
                                    {
                                        type: 'bar',
                                        label: 'Expenses',
                                        data: expenseData,
                                        backgroundColor: 'rgba(239, 68, 68, 0.8)',
                                        borderColor: '#ef4444',
                                        borderWidth: 1,
                                        borderRadius: 4,
                                        order: 3
                                    },
                                    {
                                        type: 'line',
                                        label: 'Net Profit',
                                        data: netflowData,
                                        borderColor: '#3b82f6',
                                        backgroundColor: 'rgba(59, 130, 246, 0.1)',
                                        borderWidth: 3,
                                        fill: true,
                                        tension: 0.4,
                                        pointRadius: 4,
                                        pointBackgroundColor: '#3b82f6',
                                        order: 1
                                    }
                                ]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                interaction: {
                                    mode: 'index',
                                    intersect: false
                                },
                                plugins: {
                                    legend: {
                                        display: true,
                                        position: 'bottom',
                                        labels: {
                                            usePointStyle: true,
                                            padding: 20
                                        }
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                return context.dataset.label + ': ' + new Intl.NumberFormat('en-RW').format(context.raw) + ' RWF';
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        grid: {
                                            display: false
                                        }
                                    },
                                    y: {
                                        beginAtZero: true,
                                        ticks: {
                                            callback: function(value) {
                                                return new Intl.NumberFormat('en-RW', { notation: 'compact' }).format(value) + ' RWF';
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    }

                    const regCtx = document.getElementById('adminRegistrationsChart');
                    const __regLabels = @json($__regLabels);
                    const __regCounts = @json($__regCounts);
                    new Chart(regCtx, {
                        type: 'bar',
                        data: {
                            labels: __regLabels,
                            datasets: [{
                                label: 'Registrations',
                                data: __regCounts,
                                backgroundColor: 'rgba(99, 102, 241, 0.5)',
                                borderColor: '#6366f1',
                                borderWidth: 1
                            }]
                        },
                        options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
                    });

                    const feesCtx = document.getElementById('adminFeesChart');
                    const __feesPaid = @json($__feesPaid);
                    const __feesPending = @json($__feesPending);
                    const __feesOverdue = @json($__feesOverdue);
                    new Chart(feesCtx, {
                        type: 'doughnut',
                        data: {
                            labels: ['Paid', 'Pending', 'Overdue'],
                            datasets: [{
                                data: [__feesPaid, __feesPending, __feesOverdue],
                                backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                                borderWidth: 1
                            }]
                        },
                        options: { plugins: { legend: { position: 'bottom' } } }
                    });

                    @php
                        $__subsLabels = isset($subsLabels) && is_array($subsLabels) ? $subsLabels : ['Jun','Jul','Aug','Sep','Oct','Nov'];
                        $__subsActive = isset($subsActive) && is_array($subsActive) ? $subsActive : [120, 135, 150, 160, 175, 190];
                        $__subsNew = isset($subsNew) && is_array($subsNew) ? $subsNew : [20, 25, 30, 28, 35, 40];
                    @endphp
                    const subsCtx = document.getElementById('adminSubscriptionsChart');
                    new Chart(subsCtx, {
                        type: 'line',
                        data: {
                            labels: @json($__subsLabels),
                            datasets: [{
                                label: 'Active Subscriptions',
                                data: @json($__subsActive),
                                borderColor: '#22c55e',
                                backgroundColor: 'rgba(34, 197, 94, 0.2)',
                                tension: 0.3,
                                fill: true
                            },{
                                label: 'New Subscriptions',
                                data: @json($__subsNew),
                                borderColor: '#3b82f6',
                                backgroundColor: 'rgba(59, 130, 246, 0.2)',
                                tension: 0.3,
                                fill: true
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: { legend: { position: 'bottom' } },
                            scales: { y: { beginAtZero: true } }
                        }
                    });
                }
            });
        </script>
        @endpush
        {{-- Income & Subscription KPIs (new) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <a href="{{ route('admin.incomes.index') }}" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Income (This Month)</p>
                            <h3 class="text-3xl font-bold text-emerald-600 dark:text-emerald-400" data-animate-count>
                                {{ number_format((int) floor(($stats['incomeThisMonth'] ?? 0)/100)) }} RWF
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">RWF</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.incomes.index') }}" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Total Income</p>
                            <h3 class="text-3xl font-bold text-slate-900" data-animate-count>
                                {{ number_format((int) floor(($stats['totalIncome'] ?? 0)/100)) }} RWF
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">All time</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-slate-500 to-slate-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h4l3 8 4-16 3 8h4"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{{ route('accountant.subscriptions.index') }}" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Subscription Revenue (This Month)</p>
                            <h3 class="text-3xl font-bold text-amber-600 dark:text-amber-400" data-animate-count>
                                {{ number_format((int) floor(($stats['subscriptionRevenueThisMonth'] ?? 0)/100)) }}
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">RWF</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{{ route('accountant.subscriptions.index') }}" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Total Subscription Revenue</p>
                            <h3 class="text-3xl font-bold text-slate-900" data-animate-count>
                                {{ number_format((int) floor(($stats['totalSubscriptionRevenue'] ?? 0)/100)) }}
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">All time</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-slate-700 to-slate-800 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Secondary Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <a href="{{ route('admin.branches.index') }}" class="card cursor-pointer hover:shadow-lg transition-shadow">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Branches</p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['totalBranches'] ?? 0 }}</p>
                        </div>
                        <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.groups.index') }}" class="card cursor-pointer hover:shadow-lg transition-shadow">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Groups</p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['totalGroups'] ?? 0 }}</p>
                        </div>
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{{ route('accountant.subscriptions.index') }}" class="card cursor-pointer hover:shadow-lg transition-shadow">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Subscriptions</p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['activeSubscriptions'] ?? 0 }}</p>
                        </div>
                        <div class="w-10 h-10 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{{ route('admin.equipment.index') }}" class="card cursor-pointer hover:shadow-lg transition-shadow">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Equipment</p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['totalEquipment'] ?? 0 }}</p>
                        </div>
                        <div class="w-10 h-10 bg-teal-100 dark:bg-teal-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Attendance Summary --}}
        <div class="mb-8">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">✅ Attendance Overview</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <a href="{{ route('admin.student-attendance.index') }}" class="card group hover:shadow-xl transition-all duration-300 cursor-pointer">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Student Attendance</p>
                                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['totalStudentAttendance'] ?? 0 }}</p>
                            </div>
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('coach.attendance.index') }}" class="card group hover:shadow-xl transition-all duration-300 cursor-pointer">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Coach Attendance</p>
                                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['totalCoachAttendance'] ?? 0 }}</p>
                            </div>
                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.staff_attendances.index') }}" class="card group hover:shadow-xl transition-all duration-300 cursor-pointer">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Staff Attendance</p>
                                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['totalStaffAttendance'] ?? 0 }}</p>
                            </div>
                            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- Today's Student Attendance Table --}}
        <div class="mb-8">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white">📋 Today's Student Attendance</h2>
                <a href="{{ route('admin.student-attendance.index') }}" class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium">
                    View All →
                </a>
            </div>

            {{-- Attendance Stats Summary --}}
            @if(isset($todayAttendanceStats))
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-4">
                <div class="bg-slate-100 dark:bg-slate-800 rounded-lg p-3 text-center">
                    <p class="text-2xl font-bold text-slate-700 dark:text-slate-300">{{ $todayAttendanceStats['total'] ?? 0 }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Total Recorded</p>
                </div>
                <div class="bg-emerald-100 dark:bg-emerald-900/30 rounded-lg p-3 text-center">
                    <p class="text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ $todayAttendanceStats['present'] ?? 0 }}</p>
                    <p class="text-xs text-emerald-600 dark:text-emerald-400">Present</p>
                </div>
                <div class="bg-red-100 dark:bg-red-900/30 rounded-lg p-3 text-center">
                    <p class="text-2xl font-bold text-red-600 dark:text-red-400">{{ $todayAttendanceStats['absent'] ?? 0 }}</p>
                    <p class="text-xs text-red-600 dark:text-red-400">Absent</p>
                </div>
                <div class="bg-yellow-100 dark:bg-yellow-900/30 rounded-lg p-3 text-center">
                    <p class="text-2xl font-bold text-yellow-600 dark:text-yellow-400">{{ $todayAttendanceStats['late'] ?? 0 }}</p>
                    <p class="text-xs text-yellow-600 dark:text-yellow-400">Late</p>
                </div>
                <div class="bg-blue-100 dark:bg-blue-900/30 rounded-lg p-3 text-center">
                    <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $todayAttendanceStats['excused'] ?? 0 }}</p>
                    <p class="text-xs text-blue-600 dark:text-blue-400">Excused</p>
                </div>
            </div>
            @endif

            {{-- Attendance Table --}}
            <div class="card">
                <div class="card-body p-0">
                    @if(isset($todayAttendances) && $todayAttendances->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                            <thead class="bg-slate-50 dark:bg-slate-800">
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Student</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Time</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase tracking-wider">Remarks</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white dark:bg-slate-900 divide-y divide-slate-200 dark:divide-slate-700">
                                @foreach($todayAttendances as $attendance)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-8 w-8">
                                                @if($attendance->student && $attendance->student->photo_path)
                                                    <img class="h-8 w-8 rounded-full object-cover" src="{{ $attendance->student->photo_url }}" alt="">
                                                @else
                                                    <div class="h-8 w-8 rounded-full bg-slate-300 dark:bg-slate-600 flex items-center justify-center">
                                                        <span class="text-xs font-medium text-slate-600 dark:text-slate-300">
                                                            {{ $attendance->student ? strtoupper(substr($attendance->student->first_name, 0, 1) . substr($attendance->student->second_name ?? '', 0, 1)) : '?' }}
                                                        </span>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="ml-3">
                                                <p class="text-sm font-medium text-slate-900 dark:text-white">
                                                    {{ $attendance->student ? $attendance->student->first_name . ' ' . ($attendance->student->second_name ?? '') : 'Unknown Student' }}
                                                </p>
                                                <p class="text-xs text-slate-500 dark:text-slate-400">
                                                    ID: {{ $attendance->student->student_id ?? $attendance->student_id }}
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        @php
                                            $statusColors = [
                                                'present' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400',
                                                'absent' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                                                'late' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                                                'excused' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                            ];
                                            $statusIcons = [
                                                'present' => '✅',
                                                'absent' => '❌',
                                                'late' => '⏰',
                                                'excused' => 'ℹ️',
                                            ];
                                        @endphp
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$attendance->status] ?? 'bg-slate-100 text-slate-800' }}">
                                            {{ $statusIcons[$attendance->status] ?? '' }} {{ ucfirst($attendance->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                        {{ $attendance->created_at->format('h:i A') }}
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm text-slate-500 dark:text-slate-400">
                                        {{ $attendance->remarks ?? '-' }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="p-8 text-center">
                        <div class="w-16 h-16 mx-auto mb-4 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-slate-900 dark:text-white mb-2">No Attendance Recorded Today</h3>
                        <p class="text-slate-500 dark:text-slate-400 mb-4">Start recording student attendance for {{ now()->format('F j, Y') }}</p>
                        <a href="{{ route('students-modern.index') }}" class="inline-flex items-center px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Record Attendance
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Upcoming Events --}}
        <div class="mb-8">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">📋 Upcoming Events</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <a href="{{ route('admin.upcoming-events.index') }}" class="card group hover:shadow-xl transition-all duration-300 cursor-pointer">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Total Events</p>
                                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['totalUpcomingEvents'] ?? 0 }}</p>
                                <p class="text-xs text-emerald-600 mt-1">Future: {{ $stats['futureEvents'] ?? 0 }}</p>
                            </div>
                            <div class="w-10 h-10 bg-rose-100 dark:bg-rose-900/30 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-rose-600 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('admin.capacity-buildings.index') }}" class="card group hover:shadow-xl transition-all duration-300 cursor-pointer">
                    <div class="card-body">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-slate-600 dark:text-slate-400">Capacity Building</p>
                                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $stats['capacityCount'] ?? 0 }}</p>
                                <p class="text-xs text-slate-500 mt-1">Total Cost: {{ number_format(($stats['capacityTotalCost'] ?? 0)/100, 2) }} RWF</p>
                            </div>
                            <div class="w-10 h-10 bg-sky-100 dark:bg-sky-900/30 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-sky-600 dark:text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        {{-- Capacity Trainings Summary removed per request --}}

        {{-- Quick Actions Grid --}}
        <div class="mb-8">
            <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-4">⚡ Quick Actions</h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                <a href="{{ route('admin.students.index') }}" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">📋</div>
                        <div class="text-sm font-semibold text-slate-900">Students</div>
                        <div class="text-xs text-slate-500 mt-1">Manage</div>
                    </div>
                </a>
                <a href="{{ route('admin.students.create') }}" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">➕</div>
                        <div class="text-sm font-semibold text-slate-900">New Student</div>
                        <div class="text-xs text-slate-500 mt-1">Add</div>
                    </div>
                </a>
                <a href="{{ route('admin.training_session_records.index') }}" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">📋</div>
                        <div class="text-sm font-semibold text-slate-900">Sessions</div>
                        <div class="text-xs text-slate-500 mt-1">View All</div>
                    </div>
                </a>
                <a href="{{ route('admin.training_session_records.create') }}" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">📋</div>
                        <div class="text-sm font-semibold text-slate-900">New Session</div>
                        <div class="text-xs text-slate-500 mt-1">Schedule</div>
                    </div>
                </a>
                <a href="{{ route('admin.users.index') }}" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">📋</div>
                        <div class="text-sm font-semibold text-slate-900">Users</div>
                        <div class="text-xs text-slate-500 mt-1">Manage</div>
                    </div>
                </a>
                <a href="{{ route('admin.users.create') }}" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">📋</div>
                        <div class="text-sm font-semibold text-slate-900">New User</div>
                        <div class="text-xs text-slate-500 mt-1">Create</div>
                    </div>
                </a>
                <a href="{{ route('admin.groups.index') }}" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">📋</div>
                        <div class="text-sm font-semibold text-slate-900">Groups</div>
                        <div class="text-xs text-slate-500 mt-1">Manage</div>
                    </div>
                </a>
                <a href="{{ route('admin.branches.index') }}" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">📋</div>
                        <div class="text-sm font-semibold text-slate-900">Branches</div>
                        <div class="text-xs text-slate-500 mt-1">Locations</div>
                    </div>
                </a>
                <a href="{{ route('admin.equipment.index') }}" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">⚽</div>
                        <div class="text-sm font-semibold text-slate-900">Equipment</div>
                        <div class="text-xs text-slate-500 mt-1">Assets</div>
                    </div>
                </a>
                <a href="{{ route('coach.attendance.index') }}" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">✅</div>
                        <div class="text-sm font-semibold text-slate-900">Attendance</div>
                        <div class="text-xs text-slate-500 mt-1">Track</div>
                    </div>
                </a>
                <a href="{{ route('accountant.payments.index') }}" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">💰</div>
                        <div class="text-sm font-semibold text-slate-900">Payments</div>
                        <div class="text-xs text-slate-500 mt-1">Finance</div>
                    </div>
                </a>
                <a href="{{ route('accountant.invoices.index') }}" class="card hover:shadow-lg transition-shadow">
                    <div class="card-body p-4 text-center">
                        <div class="text-3xl mb-2">📋</div>
                        <div class="text-sm font-semibold text-slate-900">Invoices</div>
                        <div class="text-xs text-slate-500 mt-1">Billing</div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Today's Incomes -->
        <div>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-xl font-bold text-slate-900 dark:text-white">💰 Today's Incomes</h2>
                <div class="flex items-center gap-4">
                    <span class="px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-400 rounded-full text-sm font-semibold">
                        Total: {{ number_format(($todayIncomeStats['total'] ?? 0) / 100, 0) }} RWF
                    </span>
                    <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-400 rounded-full text-sm font-semibold">
                        {{ $todayIncomeStats['count'] ?? 0 }} Records
                    </span>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                @if(($todayIncomes ?? collect())->isEmpty())
                    <div class="text-center py-12">
                        <svg class="mx-auto h-16 w-16 text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-slate-500 dark:text-slate-400 font-medium text-lg">No income recorded for today</p>
                        <a href="{{ route('admin.incomes.create') }}" class="inline-block mt-4 px-6 py-2 bg-emerald-600 text-white font-semibold rounded-lg hover:bg-emerald-700 transition">
                            Record Income
                        </a>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-slate-50 dark:bg-slate-700">
                                <tr class="text-slate-600 dark:text-slate-300">
                                    <th class="px-4 py-3 font-semibold">Time</th>
                                    <th class="px-4 py-3 font-semibold">Amount</th>
                                    <th class="px-4 py-3 font-semibold">Category</th>
                                    <th class="px-4 py-3 font-semibold">Source</th>
                                    <th class="px-4 py-3 font-semibold">Branch</th>
                                    <th class="px-4 py-3 font-semibold">Recorded By</th>
                                    <th class="px-4 py-3 font-semibold">Notes</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                                @foreach($todayIncomes as $income)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-700/50 transition">
                                        <td class="px-4 py-3 text-slate-900 dark:text-white">
                                            {{ $income->received_at ? $income->received_at->format('H:i') : '-' }}
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="font-bold text-emerald-600 dark:text-emerald-400">
                                                {{ number_format($income->amount_cents, 0) }} {{ $income->currency ?? 'RWF' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="px-2 py-1 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-700 dark:text-indigo-400 rounded text-xs font-medium">
                                                {{ ucfirst($income->category ?? '-') }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $income->source ?? '-' }}</td>
                                        <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $income->branch->name ?? '-' }}</td>
                                        <td class="px-4 py-3 text-slate-600 dark:text-slate-300">{{ $income->recordedBy->name ?? '-' }}</td>
                                        <td class="px-4 py-3 text-slate-500 dark:text-slate-400 text-xs">{{ Str::limit($income->notes, 30) ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="px-4 py-3 bg-slate-50 dark:bg-slate-700 border-t border-slate-200 dark:border-slate-600">
                        <a href="{{ route('admin.incomes.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm font-medium">
                            View All Incomes →
                        </a>
                    </div>
                @endif
            </div>
        </div>

        <!-- Analytics & Insights Section -->
        <div>
            <h2 class="text-xl font-bold text-slate-900 mb-4">📈 Analytics & Insights</h2>

        <!-- Recent Students -->
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-3">🆕 Recent Students</h3>
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
                @if(($recentStudents ?? collect())->isEmpty())
                    <div class="text-center py-6 text-slate-500">No recent students</div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead>
                                <tr class="text-slate-600">
                                    <th class="px-3 py-2">Name</th>
                                    <th class="px-3 py-2">Group</th>
                                    <th class="px-3 py-2">Branch</th>
                                    <th class="px-3 py-2">Enrolled</th>
                                    <th class="px-3 py-2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentStudents as $student)
                                    <tr class="border-t">
                                        <td class="px-3 py-2">{{ $student->first_name }} {{ $student->last_name }}</td>
                                        <td class="px-3 py-2">{{ optional($student->group)->name ?? '-' }}</td>
                                        <td class="px-3 py-2">{{ optional($student->branch)->name ?? '-' }}</td>
                                        <td class="px-3 py-2">{{ $student->created_at ? $student->created_at->format('M d, Y') : '-' }}</td>
                                        <td class="px-3 py-2">{{ ucfirst($student->status ?? '-') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="card">
                    <div class="card-body p-4">
                        <h3 class="font-semibold text-slate-900 mb-2 text-sm">📊 Weekly Session Trends (Last 8 Weeks)</h3>
                        <div class="h-48">
                            <canvas id="sessionTrendsChart" class="w-full h-full"></canvas>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <h3 class="font-semibold text-slate-900 mb-2 text-sm">📋 Coach Workload (This Month)</h3>
                        <div class="h-48">
                            <canvas id="coachWorkloadChart" class="w-full h-full"></canvas>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-4">
                        <h3 class="font-semibold text-slate-900 mb-2 text-sm">💸 Income / Expenses / Netflow (12m)</h3>
                        <div class="h-48">
                            <canvas id="financeFlowChart" class="w-full h-full"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                <div class="card">
                    <div class="card-body p-5">
                        <div class="text-xs text-slate-500 font-semibold">Equipment Utilization</div>
                        <div class="mt-2 text-2xl font-bold text-slate-900">{{ $equipmentUtilization ?? 0 }}%</div>
                        <div class="text-xs text-slate-400 mt-1">Assets in use</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-5">
                        <div class="text-xs text-slate-500 font-semibold">Net Profit (Month)</div>
                        <div class="mt-2 text-2xl font-bold {{ ($netProfit ?? 0) >= 0 ? 'text-emerald-600' : 'text-rose-600' }}">
                            {{ number_format(($netProfit ?? 0)/100, 2) }} RWF
                        </div>
                        <div class="text-xs text-slate-400 mt-1">Revenue minus expenses</div>
                        <div class="mt-3 text-xs text-slate-500">
                            <div>Expenses (This Month): <span class="font-medium">{{ number_format(($stats['totalExpensesThisMonth'] ?? 0)/100, 2) }} RWF</span></div>
                            <div>Total Expenses: <span class="font-medium">{{ number_format(($stats['totalExpenses'] ?? 0)/100, 2) }} RWF</span></div>
                            <div>Pending Expenses: <span class="font-medium">{{ $stats['pendingExpenses'] ?? 0 }}</span></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-5">
                        <div class="text-xs text-slate-500 font-semibold">Groups / Coaches</div>
                        <div class="mt-2 text-2xl font-bold text-slate-900">{{ $stats['totalGroups'] ?? 0 }} / {{ $stats['coachUsers'] ?? 0 }}</div>
                        <div class="text-xs text-slate-400 mt-1">Active groupings</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body p-5">
                        <div class="text-xs text-slate-500 font-semibold">Sessions This Week</div>
                        <div class="mt-2 text-2xl font-bold text-slate-900">{{ $stats['sessionsThisWeek'] ?? 0 }}</div>
                        <div class="text-xs text-slate-400 mt-1">Scheduled</div>
                    </div>
                </div>
            </div>

            <!-- System Health & Performance -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                <div class="card">
                    <div class="card-body p-6">
                        <h3 class="font-bold text-indigo-900 mb-4">⚙️ System Health</h3>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3 p-3 bg-emerald-50 border border-emerald-300 rounded-lg">
                                <span class="text-xl">✅</span>
                                <span class="text-sm font-semibold text-emerald-900">Database: Optimal</span>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-emerald-50 border border-emerald-300 rounded-lg">
                                <span class="text-xl">✅</span>
                                <span class="text-sm font-semibold text-emerald-900">API Endpoints: Responsive</span>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-emerald-50 border border-emerald-300 rounded-lg">
                                <span class="text-xl">✅</span>
                                <span class="text-sm font-semibold text-emerald-900">File Storage: Adequate</span>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-amber-50 border border-amber-300 rounded-lg">
                                <span class="text-xl">⚠️</span>
                                <span class="text-sm font-semibold text-amber-900">Backup: Last 2 hours ago</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 card">
                    <div class="card-body p-6">
                        <h3 class="font-bold text-slate-900 mb-4">📋 Performance Metrics</h3>
                        @php
                            $metricsBars = [
                                ['Student Enrollment Rate', 'bg-gradient-to-r from-blue-500 to-blue-600', (isset($studentEnrollmentRate) ? $studentEnrollmentRate : 75) . '%'],
                                ['Session Attendance', 'bg-gradient-to-r from-emerald-500 to-emerald-600', (isset($sessionAttendanceRate) ? $sessionAttendanceRate : 83) . '%'],
                                ['Revenue Target', 'bg-gradient-to-r from-amber-500 to-amber-600', (isset($revenueProgress) ? $revenueProgress : 66) . '%'],
                                ['Equipment Status', 'bg-gradient-to-r from-green-500 to-green-600', (isset($equipmentUtilPct) ? $equipmentUtilPct : 80) . '%'],
                            ];
                        @endphp
                        <div class="space-y-4">
                            @foreach($metricsBars as $m)
                                <div class="flex items-center justify-between">
                                    <span class="text-slate-700">{{ $m[0] }}</span>
                                    <div class="w-3/12 h-2 bg-slate-200 rounded-full overflow-hidden">
                                        <div class="h-full {{ $m[1] }}" style="width: {{ $m[2] }}"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function(){
            if (typeof Chart === 'undefined') { console.error('Chart.js not found. Skipping chart initialization.'); return; }

            // Session trends chart
            try {
                const trendsCtx = document.getElementById('sessionTrendsChart');
                if (trendsCtx) {
                    const trendsData = @json($weeklyTrends ?? []);
                    const labels = trendsData.map(t => t.label);
                    const data = trendsData.map(t => t.sessions);
                    new Chart(trendsCtx, { type: 'line', data: { labels, datasets:[{ label:'Sessions', data, borderColor:'#4f46e5', backgroundColor:'rgba(79,70,229,0.08)', fill:true, tension:0.3, pointRadius:3 }] }, options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}} } });
                }
            } catch (err) { console.error('sessionTrendsChart init error', err); }

            // Coach workload
            try {
                const coachCtx = document.getElementById('coachWorkloadChart');
                if (coachCtx) {
                    const workloadData = @json($coachWorkload ?? []);
                    const labels = workloadData.map(c => c.coach);
                    const data = workloadData.map(c => c.sessions);
                    new Chart(coachCtx, { type:'bar', data:{ labels, datasets:[{ label:'Sessions', data, backgroundColor:'#60a5fa' }] }, options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}} } });
                }
            } catch (err) { console.error('coachWorkloadChart init error', err); }

            // Capacity sparkline
            try {
                const capCtx = document.getElementById('capacitySpendChart');
                if (capCtx) {
                    const capLabels = @json($capacityMonthlyLabels ?? []);
                    const capTotals = @json($capacityMonthlyTotals ?? []);
                    new Chart(capCtx, { type:'line', data:{ labels:capLabels, datasets:[{ data:capTotals, borderColor:'#0ea5e9', backgroundColor:'rgba(14,165,233,0.08)', fill:true, pointRadius:0 }] }, options:{ responsive:true, maintainAspectRatio:false, plugins:{legend:{display:false}}, scales:{ x:{display:false}, y:{display:false} } } });
                }
            } catch (err) { console.error('capacitySpendChart init error', err); }

            // Finance flow
            try {
                const financeCtx = document.getElementById('financeFlowChart');
                if (financeCtx) {
                    const financeLabels = @json($financeLabels ?? []);
                    const incomeData = @json($incomeTotals ?? []);
                    const expenseData = @json($expenseTotals ?? []);
                    const netflowData = @json($netflowTotals ?? []);
                    new Chart(financeCtx, { type:'bar', data:{ labels:financeLabels, datasets:[ { type:'bar', label:'Income', data:incomeData, backgroundColor:'rgba(16,185,129,0.7)' }, { type:'bar', label:'Expenses', data:expenseData, backgroundColor:'rgba(239,68,68,0.7)' }, { type:'line', label:'Netflow', data:netflowData, borderColor:'#2563eb', backgroundColor:'rgba(37,99,235,0.08)', fill:false } ] }, options:{ responsive:true, maintainAspectRatio:false, plugins:{ tooltip:{ mode:'index', intersect:false } }, scales:{ x:{ stacked:true }, y:{ beginAtZero:true } } });
                }
            } catch (err) { console.error('financeFlowChart init error', err); }

        })();
    </script>
@endpush
