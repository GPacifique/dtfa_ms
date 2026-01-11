@extends('layouts.app')

@section('hero')
    <x-hero title="Income #{{ $income->id }}" subtitle="Detailed income information">
        <a href="{{ route('admin.incomes.edit', $income) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg mr-2">Edit</a>
        <a href="{{ route('admin.incomes.index') }}" class="inline-flex items-center px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-lg">Back to Incomes</a>
    </x-hero>
@endsection

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="card p-6">
        <!-- Header with amount focus -->
        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Income #{{ $income->id }}</h2>
                <div class="mt-2 flex flex-wrap items-center gap-2">
                    @if($income->category)
                        <span class="badge badge-slate">{{ ucfirst(str_replace('_',' ',$income->category)) }}</span>
                    @endif
                    @if($income->source)
                        <span class="badge badge-slate">{{ ucfirst(str_replace('_',' ',$income->source)) }}</span>
                    @endif
                    @if($income->branch?->name)
                        <span class="badge badge-slate">{{ $income->branch->name }}</span>
                    @endif
                </div>
            </div>
            <div class="text-right">
                <div class="text-sm text-slate-500 dark:text-slate-400">Amount</div>
                <div class="text-3xl md:text-4xl font-extrabold tracking-tight text-emerald-600 dark:text-emerald-400">
                    {{ number_format($income->amount_cents, 0) }} <span class="text-base font-semibold">{{ $income->currency ?? 'RWF' }}</span>
                </div>
            </div>
        </div>

        <!-- Details grid -->
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-3">
                <div>
                    <div class="text-xs uppercase tracking-wide text-slate-500">Received At</div>
                    <div class="text-slate-900 dark:text-slate-100 font-medium">{{ $income->received_at?->format('M d, Y H:i') ?? '—' }}</div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wide text-slate-500">Recorded By</div>
                    <div class="text-slate-900 dark:text-slate-100 font-medium">{{ $income->recordedBy->name ?? '—' }}</div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wide text-slate-500">Branch</div>
                    <div class="text-slate-900 dark:text-slate-100 font-medium">{{ $income->branch?->name ?? '—' }}</div>
                </div>
            </div>
            <div class="space-y-3">
                <div>
                    <div class="text-xs uppercase tracking-wide text-slate-500">Category</div>
                    <div class="text-slate-900 dark:text-slate-100 font-medium">{{ $income->category ?? '—' }}</div>
                </div>
                <div>
                    <div class="text-xs uppercase tracking-wide text-slate-500">Source</div>
                    <div class="text-slate-900 dark:text-slate-100 font-medium">{{ $income->source ?? '—' }}</div>
                </div>
            </div>
        </div>

        <!-- Notes -->
        <div class="mt-6">
            <div class="text-xs uppercase tracking-wide text-slate-500">Notes</div>
            <div class="mt-2 rounded-lg border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 p-4 text-slate-700 dark:text-slate-200">
                {{ $income->notes ?: 'No notes provided.' }}
            </div>
        </div>

        <!-- Actions -->
        <div class="mt-8 flex items-center justify-end gap-3">
            <a href="{{ route('admin.incomes.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">Back to Incomes</a>
            <a href="{{ route('admin.incomes.edit', $income) }}" class="btn-primary">Edit</a>
        </div>
    </div>
</div>
@endsection
