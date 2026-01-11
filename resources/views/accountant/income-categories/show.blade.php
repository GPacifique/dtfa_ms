@extends('layouts.app')

@section('hero')
    <x-hero :title="$incomeCategory->name" :subtitle="__('app.view_category_details')">
        <div class="flex items-center space-x-3">
            <a href="{{ route('accountant.income-categories.edit', $incomeCategory) }}"
               class="inline-flex items-center px-5 py-2.5 bg-amber-500 hover:bg-amber-600 text-white font-semibold rounded-lg transition">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                {{ __('app.edit') }}
            </a>
            <a href="{{ route('accountant.income-categories.index') }}"
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
                <div class="w-20 h-20 rounded-xl flex items-center justify-center text-4xl" style="background-color: {{ $incomeCategory->color ?? '#10B981' }}20;">
                    @if($incomeCategory->icon)
                        <i class="fas fa-{{ $incomeCategory->icon }}" style="color: {{ $incomeCategory->color ?? '#10B981' }}"></i>
                    @else
                        📁
                    @endif
                </div>
                <div class="flex-1">
                    <h3 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $incomeCategory->name }}</h3>
                    <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">{{ $incomeCategory->slug }}</p>
                    @if($incomeCategory->description)
                        <p class="text-slate-600 dark:text-slate-300 mt-3">{{ $incomeCategory->description }}</p>
                    @endif
                    <div class="flex items-center space-x-4 mt-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $incomeCategory->is_active ? 'bg-emerald-100 text-emerald-800 dark:bg-emerald-900/30 dark:text-emerald-400' : 'bg-slate-100 text-slate-800 dark:bg-slate-700 dark:text-slate-400' }}">
                            {{ $incomeCategory->is_active ? __('app.active') : __('app.inactive') }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                            {{ $incomeCategory->incomes_count ?? 0 }} {{ __('app.incomes') }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-sm font-medium uppercase tracking-wide">{{ __('app.total_income') }}</p>
                    <p class="text-3xl font-bold mt-2">{{ number_format($incomes->sum('amount_cents')) }} RWF</p>
                </div>
                <div class="bg-emerald-400 bg-opacity-30 rounded-lg p-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium uppercase tracking-wide">{{ __('app.total_records') }}</p>
                    <p class="text-3xl font-bold mt-2">{{ $incomes->total() }}</p>
                </div>
                <div class="bg-blue-400 bg-opacity-30 rounded-lg p-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium uppercase tracking-wide">{{ __('app.average_income') }}</p>
                    @php
                        $avgAmount = $incomes->count() > 0 ? $incomes->sum('amount_cents') / $incomes->count() : 0;
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

    <!-- Incomes Table -->
    <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white">{{ __('app.related_incomes') }}</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 dark:divide-slate-700">
                <thead class="bg-gradient-to-r from-slate-50 to-slate-100 dark:from-slate-700 dark:to-slate-800">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">{{ __('app.date') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">{{ __('app.branch') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">{{ __('app.source') }}</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">{{ __('app.amount') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 dark:text-slate-300 uppercase tracking-wider">{{ __('app.recorded_by') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-slate-800 divide-y divide-slate-100 dark:divide-slate-700">
                    @forelse($incomes as $income)
                        <tr class="hover:bg-emerald-50 dark:hover:bg-slate-700 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900 dark:text-white">
                                {{ $income->received_at?->format('M d, Y') ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-300">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900/30 dark:text-indigo-400">
                                    {{ $income->branch?->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-300">
                                {{ $income->source ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-semibold text-emerald-600 dark:text-emerald-400">
                                {{ number_format($income->amount_cents) }} {{ $income->currency ?? 'RWF' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600 dark:text-slate-300">
                                {{ $income->recordedBy?->name ?? 'System' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-500 dark:text-slate-400">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-slate-300 dark:text-slate-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <p class="text-lg font-medium">{{ __('app.no_incomes_recorded') }}</p>
                                    <p class="text-sm mt-1">{{ __('app.income_records_appear_here') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($incomes->hasPages())
            <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-700">
                {{ $incomes->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
