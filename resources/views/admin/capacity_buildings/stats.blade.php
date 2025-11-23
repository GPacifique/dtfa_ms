@extends('layouts.app')

@section('content')
@php
    $currency = env('APP_CURRENCY', 'UGX');
    $fmt = fn($v) => number_format((float)($v ?? 0), 2);
    $monthLabels = $byMonth->pluck('month')->map(fn($m) => $m)->values();
    $monthTotals = $byMonth->pluck('total')->map(fn($t) => (float)$t)->values();
@endphp

<div class="max-w-6xl mx-auto p-6">
    <div class="flex items-center justify-between mb-4">
        <h1 class="text-2xl font-bold">Capacity Building Costs — Summary</h1>
        <div class="flex items-center gap-3">
            @if(Route::has('admin.capacity-buildings.stats.export'))
                <a href="{{ route('admin.capacity-buildings.stats.export') }}" class="inline-flex items-center px-3 py-2 bg-indigo-600 text-white rounded shadow">Export CSV</a>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-sm font-medium text-gray-500">Records</h3>
            <div class="mt-2 text-3xl font-semibold">{{ number_format($count) }}</div>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h3 class="text-sm font-medium text-gray-500">Total Cost</h3>
            <div class="mt-2 text-3xl font-semibold">{{ $currency }} {{ $fmt($total) }}</div>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h3 class="text-sm font-medium text-gray-500">Average Cost</h3>
            <div class="mt-2 text-2xl font-semibold">{{ $currency }} {{ $fmt($average) }}</div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-6">
        <div class="bg-white shadow rounded p-4">
            <h4 class="font-medium text-gray-600 mb-2">Min / Max</h4>
            <div>{{ $currency }} {{ $fmt($min) }} / {{ $currency }} {{ $fmt($max) }}</div>
        </div>

        <div class="bg-white shadow rounded p-4 lg:col-span-2">
            <h4 class="font-medium text-gray-600 mb-2">Spend Over Time (Monthly)</h4>
            <canvas id="monthlyChart" height="120"></canvas>
        </div>
    </div>

    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-3">By Cost Type</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            @forelse($byCostType as $row)
                <div class="flex items-center justify-between bg-white shadow rounded p-3">
                    <div class="text-sm">{{ ucfirst($row['cost_type'] ?? 'unknown') }}</div>
                    <div class="text-sm font-medium">Count: {{ $row['count'] }} — Total: {{ $currency }} {{ $fmt($row['total'] ?? 0) }}</div>
                </div>
            @empty
                <div class="text-sm text-gray-500">No data</div>
            @endforelse
        </div>
    </div>

    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-3">By Branch</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
            @forelse($byBranch as $b)
                <div class="flex items-center justify-between bg-white shadow rounded p-3">
                    <div class="text-sm">{{ $b->branch ?? 'Unspecified' }}</div>
                    <div class="text-sm font-medium">Count: {{ $b->count }} — Total: {{ $currency }} {{ $fmt($b->total) }}</div>
                </div>
            @empty
                <div class="text-sm text-gray-500">No branch data</div>
            @endforelse
        </div>
    </div>

    <div>
        <h2 class="text-lg font-semibold mb-3">Top Categories by Spend</h2>
        <div class="space-y-2">
            @forelse($byCategory as $row)
                <div class="flex items-center justify-between bg-white shadow rounded p-3">
                    <div class="text-sm">{{ $row->training_category ?? 'Unspecified' }}</div>
                    <div class="text-sm font-medium">Count: {{ $row->count }} — Total: {{ $currency }} {{ $fmt($row->total ?? 0) }}</div>
                </div>
            @empty
                <div class="text-sm text-gray-500">No categories</div>
            @endforelse
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        (function(){
            const labels = {!! json_encode($monthLabels) !!};
            const data = {!! json_encode($monthTotals) !!};

            const ctx = document.getElementById('monthlyChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total Spend',
                        data: data,
                        borderColor: 'rgba(59,130,246,1)',
                        backgroundColor: 'rgba(59,130,246,0.2)',
                        fill: true,
                        tension: 0.2,
                    }]
                },
                options: {
                    responsive: true,
                    scales: { y: { beginAtZero: true } }
                }
            });
        })();
    </script>
@endpush

@endsection
