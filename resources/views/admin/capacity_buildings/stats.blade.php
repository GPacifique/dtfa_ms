@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Capacity Building Costs — Summary</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div class="bg-white shadow rounded p-4">
            <h3 class="text-sm font-medium text-gray-500">Records</h3>
            <div class="mt-2 text-3xl font-semibold">{{ number_format($count) }}</div>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h3 class="text-sm font-medium text-gray-500">Total Cost</h3>
            <div class="mt-2 text-3xl font-semibold">{{ number_format($total, 2) }}</div>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h3 class="text-sm font-medium text-gray-500">Average Cost</h3>
            <div class="mt-2 text-2xl font-semibold">{{ number_format($average, 2) }}</div>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h3 class="text-sm font-medium text-gray-500">Min / Max</h3>
            <div class="mt-2 text-lg">{{ number_format((float) $min ?? 0, 2) }} / {{ number_format((float) $max ?? 0, 2) }}</div>
        </div>
    </div>

    <div class="mb-6">
        <h2 class="text-lg font-semibold mb-3">By Cost Type</h2>
        <div class="space-y-2">
            @forelse($byCostType as $row)
                <div class="flex items-center justify-between bg-white shadow rounded p-3">
                    <div class="text-sm">{{ ucfirst($row['cost_type'] ?? 'unknown') }}</div>
                    <div class="text-sm font-medium">Count: {{ $row['count'] }} — Total: {{ number_format($row['total'] ?? 0, 2) }}</div>
                </div>
            @empty
                <div class="text-sm text-gray-500">No data</div>
            @endforelse
        </div>
    </div>

    <div>
        <h2 class="text-lg font-semibold mb-3">Top Categories by Spend</h2>
        <div class="space-y-2">
            @forelse($byCategory as $row)
                <div class="flex items-center justify-between bg-white shadow rounded p-3">
                    <div class="text-sm">{{ $row->training_category ?? 'Unspecified' }}</div>
                    <div class="text-sm font-medium">Count: {{ $row->count }} — Total: {{ number_format($row->total ?? 0, 2) }}</div>
                </div>
            @empty
                <div class="text-sm text-gray-500">No categories</div>
            @endforelse
        </div>
    </div>
</div>
@endsection
