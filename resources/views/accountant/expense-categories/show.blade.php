@extends('layouts.app')

@section('hero')
    <x-hero :title="$expenseCategory->name" :subtitle="__('app.view_expense_details')">
        <div class="flex items-center space-x-3">
            <a href="{{ route('accountant.expense-categories.edit', $expenseCategory) }}"
               class="inline-flex items-center px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white font-semibold rounded-lg transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                {{ __('app.edit') }}
            </a>
            <a href="{{ route('accountant.expense-categories.index') }}"
               class="inline-flex items-center px-5 py-2.5 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-lg transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                {{ __('app.back') }}
            </a>
        </div>
    </x-hero>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">

    <!-- Category Details Card -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden mb-8">
        <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white">{{ __('app.category_information') }}</h2>
        </div>
        <div class="p-6">
            <div class="flex items-start space-x-6">
                <div class="w-20 h-20 rounded-xl flex items-center justify-center text-4xl" style="background-color: {{ $expenseCategory->color ?? '#6B7280' }}20;">
                    @if($expenseCategory->icon)
                        <i class="fas fa-{{ $expenseCategory->icon }}" style="color: {{ $expenseCategory->color ?? '#6B7280' }}"></i>
                    @else
                        📁
                    @endif
                </div>
                <div class="flex-1">
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $expenseCategory->name }}</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ $expenseCategory->slug }}</p>
                    @if($expenseCategory->description)
                        <p class="text-slate-600 dark:text-slate-300 mt-3">{{ $expenseCategory->description }}</p>
                    @endif
                    <div class="flex items-center space-x-4 mt-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $expenseCategory->is_active ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400' : 'bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-400' }}">
                            {{ $expenseCategory->is_active ? __('app.active') : __('app.inactive') }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                            {{ $expenseCategory->expenses_count ?? 0 }} {{ __('app.expenses') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-red-100 text-sm font-medium uppercase tracking-wide">{{ __('app.total_expenses_amount') }}</p>
                    @php
                        $totalAmount = $expenses->sum('amount_cents');
                    @endphp
                    <p class="text-3xl font-bold mt-2">{{ number_format($totalAmount) }} RWF</p>
                </div>
                <div class="bg-red-400 bg-opacity-30 rounded-lg p-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-amber-100 text-sm font-medium uppercase tracking-wide">{{ __('app.total_records') }}</p>
                    <p class="text-3xl font-bold mt-2">{{ $expenses->total() }}</p>
                </div>
                <div class="bg-amber-400 bg-opacity-30 rounded-lg p-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium uppercase tracking-wide">{{ __('app.average_expense') }}</p>
                    @php
                        $avgAmount = $expenses->count() > 0 ? $expenses->sum('amount_cents') / $expenses->count() : 0;
                    @endphp
                    <p class="text-3xl font-bold mt-2">{{ number_format($avgAmount) }} RWF</p>
                </div>
                <div class="bg-purple-400 bg-opacity-30 rounded-lg p-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Expenses Table -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white">{{ __('app.related_expenses') }}</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                <thead class="bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-700 dark:to-slate-800">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">{{ __('app.date') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">{{ __('app.branch') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">{{ __('app.description') }}</th>
                        <th class="px-6 py-4 text-center text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">{{ __('app.status') }}</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">{{ __('app.amount') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">{{ __('app.requested_by') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800 divide-y divide-slate-100 dark:divide-slate-700">
                    @forelse($expenses as $expense)
                        <tr class="hover:bg-red-50 dark:hover:bg-slate-700 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-white">
                                {{ $expense->expense_date?->format('M d, Y') ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-300">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-400">
                                    {{ $expense->branch?->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300 max-w-xs truncate">
                                {{ $expense->description ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
                                        'approved' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
                                        'paid' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400',
                                        'rejected' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusClasses[$expense->status] ?? 'bg-slate-100 text-slate-800' }}">
                                    {{ ucfirst($expense->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-semibold text-red-600 dark:text-red-400">
                                {{ number_format($expense->amount_cents) }} {{ $expense->currency ?? 'RWF' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-300">
                                {{ $expense->user?->name ?? 'System' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-lg font-medium">{{ __('app.no_expenses_recorded') }}</p>
                                    <p class="text-sm mt-1">{{ __('app.expense_records_appear_here') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($expenses->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700">
                {{ $expenses->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
