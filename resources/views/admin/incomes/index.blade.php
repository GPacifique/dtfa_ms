@extends('layouts.app')

        


@section('content')
<div class="mt-6 flex justify-end relative z-50">

            <a href="{{ route('admin.incomes.create') }}"
               class="inline-flex items-center gap-2 px-6 py-3 
                      bg-gradient-to-r from-emerald-600 to-emerald-700 
                      hover:from-emerald-700 hover:to-emerald-800 
                      text-white font-semibold rounded-xl shadow-lg 
                      transition duration-300 transform hover:scale-105
                      relative z-50">

                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>

                {{ __('app.record_income') }}
            </a>

        </div>
<div class="container mx-auto px-4 py-8">

    @php
        // Compute totals across all filtered records (not just current page)
        $q = \App\Models\Income::query();
        $reqMonth = request('month');
        if ($reqMonth && $reqMonth !== 'all') {
            // Expecting format YYYY-MM
            try {
                [$y, $m] = explode('-', $reqMonth);
                $q->whereYear('received_at', (int) $y)->whereMonth('received_at', (int) $m);
            } catch (\Throwable $e) {
                // ignore invalid format
            }
        }
        $branchId = request('branch_id');
        if (!empty($branchId)) {
            $q->where('branch_id', $branchId);
        }
        $totalIncomeCents = (int) $q->sum('amount_cents');
        $totalRecords = (int) $q->count();
        // Show amounts as stored (no conversion). Use raw cents average.
        $avgIncomeCents = $totalRecords > 0 ? floor($totalIncomeCents / $totalRecords) : 0;
    @endphp

    <!-- Stats Card -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-sm font-medium uppercase tracking-wide">{{ __('app.total_income') }}</p>
                    <p class="text-4xl font-bold mt-2">{{ number_format($totalIncomeCents, 0) }} <span class="text-sm font-medium">{{ $incomes->first()->currency ?? 'RWF' }}</span></p>
                </div>
                <div class="bg-emerald-400 bg-opacity-30 rounded-lg p-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm font-medium uppercase tracking-wide">{{ __('app.total_records') }}</p>
                    <p class="text-4xl font-bold mt-2">{{ $incomes->total() }}</p>
                    <p class="text-xs text-blue-100 mt-1">{{ __('app.income_entries') }}</p>
                </div>
                <div class="bg-blue-400 bg-opacity-30 rounded-lg p-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl shadow-xl p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm font-medium uppercase tracking-wide">{{ __('app.avg_income') }}</p>
                    <p class="text-4xl font-bold mt-2">{{ number_format($avgIncomeCents, 0) }} <span class="text-sm font-medium">{{ $incomes->first()->currency ?? 'RWF' }}</span></p>
                    <p class="text-xs text-purple-100 mt-1">{{ __('app.per_entry') }}</p>
                </div>
                <div class="bg-purple-400 bg-opacity-30 rounded-lg p-4">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white rounded-xl shadow-md p-6 mb-8">
        <form method="GET" action="{{ route('admin.incomes.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">📅 {{ __('app.filter_by_month') }}</label>
                <select name="month" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" onchange="this.form.submit()">
                    <option value="all" {{ request('month') === 'all' ? 'selected' : '' }}>🌍 {{ __('app.all_time_option') }}</option>
                    @foreach($months as $m)
                        <option value="{{ $m['value'] }}" {{ request('month', now()->format('Y-m')) === $m['value'] ? 'selected' : '' }}>
                            {{ $m['label'] }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if(isset($branches) && $branches->count() > 0)
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">🏢 {{ __('app.filter_by_branch') }}</label>
                <select name="branch_id" class="w-full px-4 py-2.5 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition" onchange="this.form.submit()">
                    <option value="">{{ __('app.all_branches') }}</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>
                            {{ $branch->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            @endif
            <div class="flex items-end">
                <a href="{{ route('admin.incomes.index') }}" class="w-full px-4 py-2.5 bg-slate-200 hover:bg-slate-300 text-slate-700 font-medium rounded-lg transition text-center">
                    🔄 {{ __('app.reset_filters') }}
                </a>
            </div>
        </form>
    </div>

    <!-- Income Table -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200">
                <thead class="bg-gradient-to-r from-slate-50 to-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">{{ __('app.date') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">{{ __('app.branch') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">{{ __('app.category') }}</th>
                        <th class="px-6 py-4 text-left text-xs font-bold text-slate-600 uppercase tracking-wider">{{ __('app.source') }}</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-600 uppercase tracking-wider">{{ __('app.amount') }}</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-slate-600 uppercase tracking-wider">{{ __('app.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-slate-100">
                    @forelse($incomes as $income)
                        <tr class="hover:bg-emerald-50 transition duration-150">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                {{ $income->received_at?->format('M d, Y') ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                    {{ $income->branch?->name ?? 'N/A' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $income->category }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-700 max-w-xs truncate">
                                {{ $income->source }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-right text-emerald-600">
                                {{ number_format($income->amount_cents, 0) }} <span class="text-xs text-slate-500">{{ $income->currency ?? 'RWF' }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.incomes.show', $income) }}" class="text-blue-600 hover:text-blue-900 mr-3 transition">{{ __('app.view') }}</a>
                                <a href="{{ route('admin.incomes.edit', $income) }}" class="text-indigo-600 hover:text-indigo-900 mr-3 transition">{{ __('app.edit') }}</a>
                                <form action="{{ route('admin.incomes.destroy', $income) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('app.confirm_delete') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900 transition">{{ __('app.delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                <svg class="mx-auto h-12 w-12 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                                <p class="mt-4 text-lg font-medium">{{ __('app.no_income_records_found') }}</p>
                                <p class="mt-1 text-sm">{{ __('app.try_adjust_filters') }}</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $incomes->links() }}

    </div>
</div>
@endsection
