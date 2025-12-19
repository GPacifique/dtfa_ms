@extends('layouts.app')

@section('title', 'Accountant Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-emerald-50 to-teal-50 dark:from-slate-900 dark:via-slate-800 dark:to-slate-900">

    {{-- Hero Section --}}
    <div class="footer-like-hero relative overflow-hidden">
        <div class="hero-blob-layer">
            <div class="hero-blob blob-1"></div>
            <div class="hero-blob blob-2"></div>
            <div class="hero-blob blob-3"></div>
        </div>

        <div class="relative z-10 container mx-auto px-6 py-8">
            <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">Financial Dashboard</h1>
            <p class="text-emerald-100">Monitor revenue, expenses, and financial health.</p>
        </div>
    </div>

    <div class="container mx-auto px-6 -mt-8">

        {{-- Financial KPI Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            {{-- Revenue This Month --}}
            <a href="{{ route('accountant.payments.index') }}" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 block">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Revenue (This Month)</p>
                            <h3 class="text-3xl font-bold text-emerald-600 dark:text-emerald-400" data-animate-count>
                                {{ number_format((int) floor($totalRevenueCents / 100)) }}
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                <span class="{{ $revenueChangeDirection === 'up' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $revenueChangeDirection === 'up' ? '↑' : '↓' }} {{ abs($revenueChange) }}%
                                </span> vs last month
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Expenses This Month --}}
            <a href="{{ route('admin.expenses.index') }}" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 block">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Expenses (This Month)</p>
                            <h3 class="text-3xl font-bold text-orange-600 dark:text-orange-400" data-animate-count>
                                {{ number_format((int) floor($totalExpensesThisMonth / 100)) }}
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                <span class="text-amber-600 dark:text-amber-400">{{ $pendingExpenses }}</span> pending
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Net Profit --}}
            <a href="{{ route('accountant.payments.index') }}" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 block">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Net Profit</p>
                            <h3 class="text-3xl font-bold {{ $netProfitColor === 'green' ? 'text-green-600 dark:text-green-400' : 'text-rose-600 dark:text-rose-400' }}" data-animate-count>
                                {{ number_format((int) floor($netProfitThisMonth / 100)) }}
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">RWF</p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br {{ $netProfitColor === 'green' ? 'from-green-500 to-green-600' : 'from-rose-500 to-rose-600' }} rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $netProfitColor === 'green' ? 'M13 7h8m0 0v8m0-8l-8 8-4-4-6 6' : 'M13 17h8m0 0V9m0 8l-8-8-4 4-6-6' }}"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            {{-- Outstanding Balance --}}
            <a href="{{ route('accountant.invoices.index') }}" class="card group hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 block">
                <div class="card-body">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">Outstanding</p>
                            <h3 class="text-3xl font-bold text-red-600 dark:text-red-400" data-animate-count>
                                {{ number_format((int) floor($outstandingCents / 100)) }}
                            </h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">
                                <span class="text-red-600 dark:text-red-400">{{ $overdueInvoices }}</span> overdue
                            </p>
                        </div>
                        <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        {{-- Secondary Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <a href="{{ route('accountant.subscriptions.index') }}" class="card block">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Subscriptions</p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $activeSubscriptions }}/{{ $totalSubscriptions }}</p>
                        </div>
                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{{ route('accountant.payments.index') }}" class="card block">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Payments</p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $succeededPayments }}</p>
                        </div>
                        <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{{ route('accountant.invoices.index') }}" class="card block">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Pending Invoices</p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $pendingInvoices }}</p>
                        </div>
                        <div class="w-10 h-10 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-600 dark:text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>

            <a href="{{ route('accountant.payments.index') }}" class="card block">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-slate-600 dark:text-slate-400">Total Revenue</p>
                            <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ number_format((int) floor($totalRevenueAllTime / 100)) }}</p>
                        </div>
                        <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </a>
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

        {{-- Charts Section --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
            {{-- Payment Methods Chart --}}
            <div class="card">
                <div class="card-body">
                    <h3 class="text-xl md:text-2xl font-semibold text-slate-900 dark:text-white mb-4">Payment Methods (This Month)</h3>
                    <div class="card-chart">
                        <canvas id="paymentMethodsChart" height="200"></canvas>
                    </div>
                </div>
            </div>

            {{-- Expense Categories Chart --}}
            <div class="card">
                <div class="card-body">
                    <h3 class="text-xl md:text-2xl font-semibold text-slate-900 dark:text-white mb-4">Expense Categories (This Month)</h3>
                    <div class="card-chart">
                        <canvas id="expenseCategoriesChart" height="200"></canvas>
                    </div>
                </div>
            </div>

            {{-- Subscriptions (Last 6 months) --}}
            <div class="card">
                <div class="card-body">
                    <h3 class="text-xl md:text-2xl font-semibold text-slate-900 dark:text-white mb-4">Subscriptions (Last 6 months)</h3>
                    <div class="card-chart">
                        <canvas id="accountantSubscriptionsChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Additional Charts: Monthly Registrations & Fees Status --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="card">
                <div class="card-body">
                    <h3 class="text-xl md:text-2xl font-semibold text-slate-900 dark:text-white mb-4">Monthly Registrations (Last 6 months)</h3>
                    <div class="card-chart">
                        <canvas id="monthlyRegistrationsChart" height="200"></canvas>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h3 class="text-xl md:text-2xl font-semibold text-slate-900 dark:text-white mb-4">Fees Status (This Month)</h3>
                    <div class="card-chart">
                        <canvas id="feesStatusChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="card mb-8">
            <div class="card-body">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Quick Actions</h3>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                    <a href="{{ route('accountant.payments.index') }}" class="flex flex-col items-center p-4 rounded-lg bg-slate-50 dark:bg-slate-800 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-colors group">
                        <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Payments</span>
                    </a>

                    <a href="{{ route('accountant.invoices.index') }}" class="flex flex-col items-center p-4 rounded-lg bg-slate-50 dark:bg-slate-800 hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors group">
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Invoices</span>
                    </a>

                    <a href="{{ route('accountant.subscriptions.index') }}" class="flex flex-col items-center p-4 rounded-lg bg-slate-50 dark:bg-slate-800 hover:bg-purple-50 dark:hover:bg-purple-900/20 transition-colors group">
                        <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Subscriptions</span>
                    </a>

                    <a href="{{ route('admin.expenses.index') }}" class="flex flex-col items-center p-4 rounded-lg bg-slate-50 dark:bg-slate-800 hover:bg-orange-50 dark:hover:bg-orange-900/20 transition-colors group">
                        <div class="w-12 h-12 bg-orange-100 dark:bg-orange-900/30 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Expenses</span>
                    </a>

                    <a href="{{ route('admin.plans.index') }}" class="flex flex-col items-center p-4 rounded-lg bg-slate-50 dark:bg-slate-800 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 transition-colors group">
                        <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/30 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Plans</span>
                    </a>

                    <a href="{{ route('admin.students.index') }}" class="flex flex-col items-center p-4 rounded-lg bg-slate-50 dark:bg-slate-800 hover:bg-teal-50 dark:hover:bg-teal-900/20 transition-colors group">
                        <div class="w-12 h-12 bg-teal-100 dark:bg-teal-900/30 rounded-full flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-slate-700 dark:text-slate-300">Students</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- Recent Payments Table --}}
        @if($recentPayments->count() > 0)
        <div class="card mb-8">
            <div class="card-body">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Recent Payments</h3>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Student</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Amount</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Method</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Date</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                            @foreach($recentPayments as $payment)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                                <td class="px-4 py-3 text-sm text-slate-900 dark:text-white">{{ $payment->student->first_name ?? 'N/A' }} {{ $payment->student->second_name ?? '' }}</td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">{{ number_format($payment->amount_cents / 100, 0) }} RWF</td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">{{ ucfirst(str_replace('_', ' ', $payment->method)) }}</td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">{{ $payment->paid_at ? \Carbon\Carbon::parse($payment->paid_at)->format('M d, Y') : 'N/A' }}</td>
                                <td class="px-4 py-3">
                                    <span class="px-2 py-1 text-xs rounded-full {{ $payment->status === 'succeeded' ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400' : 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400' }}">
                                        {{ ucfirst($payment->status) }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        {{-- Recent Incomes Table --}}
        @if(isset($recentIncomes) && $recentIncomes->count() > 0)
        <div class="card mb-8">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Recent Incomes</h3>
                    <a href="{{ route('admin.incomes.index') }}" class="text-sm text-emerald-600 hover:text-emerald-700 dark:text-emerald-400 dark:hover:text-emerald-300 font-medium">
                        View All &rarr;
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Branch</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Category</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Amount</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Source</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                            @foreach($recentIncomes as $income)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                                <td class="px-4 py-3 text-sm text-slate-900 dark:text-white">
                                    {{ $income->branch->name ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">{{ ucfirst($income->category ?? '-') }}</td>
                                <td class="px-4 py-3 text-sm font-semibold text-emerald-600 dark:text-emerald-400">{{ number_format($income->amount_cents / 100, 0) }} RWF</td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">
                                    <span class="px-2 py-1 text-xs rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                                        {{ ucfirst(str_replace('_', ' ', $income->source ?? 'other')) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">{{ $income->received_at ? \Carbon\Carbon::parse($income->received_at)->format('M d, Y') : 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

        {{-- Recent Expenses Table --}}
        @if(isset($recentExpenses) && $recentExpenses->count() > 0)
        <div class="card mb-8">
            <div class="card-body">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">Recent Expenses</h3>
                    <a href="{{ route('admin.expenses.index') }}" class="text-sm text-orange-600 hover:text-orange-700 dark:text-orange-400 dark:hover:text-orange-300 font-medium">
                        View All &rarr;
                    </a>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Description</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Category</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Amount</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-slate-500 dark:text-slate-400 uppercase">Date</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 dark:divide-slate-700">
                            @foreach($recentExpenses as $expense)
                            <tr class="hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                                <td class="px-4 py-3 text-sm text-slate-900 dark:text-white">{{ Str::limit($expense->description ?? '-', 35) }}</td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">
                                    <span class="px-2 py-1 text-xs rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400">
                                        {{ ucfirst($expense->category ?? 'Other') }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm font-semibold text-red-600 dark:text-red-400">{{ number_format($expense->amount_cents / 100, 0) }} RWF</td>
                                <td class="px-4 py-3">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                                            'approved' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                            'paid' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
                                            'rejected' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                                        ];
                                    @endphp
                                    <span class="px-2 py-1 text-xs rounded-full {{ $statusColors[$expense->status] ?? 'bg-gray-100 text-gray-800' }}">
                                        {{ ucfirst($expense->status ?? 'Unknown') }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-slate-600 dark:text-slate-400">{{ $expense->expense_date ? \Carbon\Carbon::parse($expense->expense_date)->format('M d, Y') : 'N/A' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>

{{-- Chart.js Scripts --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Payment Methods Chart
    const paymentMethodsCtx = document.getElementById('paymentMethodsChart');
    if (paymentMethodsCtx) {
        const paymentData = @json($paymentMethodBreakdown);
        const paymentChart = new Chart(paymentMethodsCtx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(paymentData),
                datasets: [{
                    data: Object.values(paymentData).map(v => v / 100),
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.7)',
                        'rgba(59, 130, 246, 0.7)',
                        'rgba(245, 158, 11, 0.7)',
                        'rgba(139, 92, 246, 0.7)'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // Click handler: go to payments index filtered by method
        paymentMethodsCtx.onclick = (evt) => {
            const points = paymentChart.getElementsAtEventForMode(evt, 'nearest', { intersect: true }, true);
            if (points && points.length) {
                const idx = points[0].index;
                const method = paymentChart.data.labels[idx];
                const url = `{{ route('accountant.payments.index') }}` + `?method=` + encodeURIComponent(method);
                window.location.href = url;
            }
        };
    }

    // Expense Categories Chart
    const expenseCategoriesCtx = document.getElementById('expenseCategoriesChart');
    if (expenseCategoriesCtx) {
        const expenseData = @json($expenseCategories);
        const expenseChart = new Chart(expenseCategoriesCtx, {
            type: 'doughnut',
            data: {
                labels: Object.keys(expenseData),
                datasets: [{
                    data: Object.values(expenseData).map(v => v / 100),
                    backgroundColor: [
                        'rgba(239, 68, 68, 0.7)',
                        'rgba(251, 146, 60, 0.7)',
                        'rgba(234, 179, 8, 0.7)',
                        'rgba(168, 85, 247, 0.7)',
                        'rgba(236, 72, 153, 0.7)',
                        'rgba(14, 165, 233, 0.7)'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });

        // Click handler: go to expenses index filtered by category
        expenseCategoriesCtx.onclick = (evt) => {
            const points = expenseChart.getElementsAtEventForMode(evt, 'nearest', { intersect: true }, true);
            if (points && points.length) {
                const idx = points[0].index;
                const category = expenseChart.data.labels[idx];
                const url = `{{ route('admin.expenses.index') }}` + `?category=` + encodeURIComponent(category);
                window.location.href = url;
            }
        };
    }

    // Subscriptions Chart (Last 6 months) - fetch real metrics
    const accSubsCtx = document.getElementById('accountantSubscriptionsChart');
    if (accSubsCtx) {
        const metricsUrl = `{{ route('accountant.dashboard.metrics') }}`;
        fetch(metricsUrl, { headers: { 'Accept': 'application/json' } })
            .then(resp => resp.json())
            .then(json => {
                const subs = json && json.subscriptionsLastSixMonths ? json.subscriptionsLastSixMonths : { labels: [], active: [], new: [] };
                new Chart(accSubsCtx, {
                    type: 'line',
                    data: {
                        labels: subs.labels,
                        datasets: [{
                            label: 'Active Subscriptions',
                            data: subs.active,
                            borderColor: '#22c55e',
                            backgroundColor: 'rgba(34, 197, 94, 0.2)',
                            tension: 0.3,
                            fill: true
                        },{
                            label: 'New Subscriptions',
                            data: subs.new,
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
            })
            .catch(err => {
                console.error('Failed to load subscriptions metrics', err);
            });
    }

    // Monthly Registrations (Last 6 months)
    const regCtx = document.getElementById('monthlyRegistrationsChart');
    if (regCtx) {
        const regLabels = @json($regLabels ?? []);
        const regCounts = @json($regCounts ?? []);
        new Chart(regCtx, {
            type: 'bar',
            data: { labels: regLabels, datasets: [{ label: 'Registrations', data: regCounts, backgroundColor: 'rgba(99,102,241,0.7)' }] },
            options: { responsive: true, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } }
        });
    }

    // Fees Status (This Month)
    const feesStatusCtx = document.getElementById('feesStatusChart');
    if (feesStatusCtx) {
        const feesPaid = @json($feesPaidCount ?? 0);
        const feesPending = @json($feesPendingCount ?? 0);
        const feesOverdue = @json($feesOverdueCount ?? 0);
        new Chart(feesStatusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Paid', 'Pending', 'Overdue'],
                datasets: [{
                    data: [feesPaid, feesPending, feesOverdue],
                    backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: { responsive: true, plugins: { legend: { position: 'bottom' } } }
        });
    }
});
</script>
@endpush
@endsection
