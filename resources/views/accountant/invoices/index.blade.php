@php($title = 'Invoices')
@extends('layouts.app')

@section('content')
<div class="container-page space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="page-title">Invoices</h1>
        <x-button :href="route('accountant.invoices.create')" variant="primary">Create Invoice</x-button>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="GET" action="{{ route('accountant.invoices.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-2">Month</label>
                    <select name="month" class="form-select w-full" onchange="this.form.submit()">
                        <option value="all" {{ request('month') === 'all' ? 'selected' : '' }}>All Time</option>
                        @foreach($months as $m)
                            <option value="{{ $m['value'] }}" {{ request('month', now()->format('Y-m')) === $m['value'] ? 'selected' : '' }}>
                                {{ $m['label'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <x-form.input label="Search Student" name="q" type="text" :value="request('q')" placeholder="Student name..." />
                <div class="flex items-end">
                    <x-button type="submit" variant="primary" class="w-full">Filter</x-button>
                </div>
            </form>
        </div>
    </div>

    <div class="card overflow-hidden">
        <table class="table">
            <thead>
                <tr>
                    <th>Due Date</th>
                    <th>Student</th>
                    <th>Subscription</th>
                    <th>Amount</th>
                    <th>Paid</th>
                    <th>Balance</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($invoices as $inv)
                    <tr>
                        <td class="px-4 py-3">{{ $inv->due_date->format('Y-m-d') }}</td>
                        <td class="px-4 py-3">{{ $inv->subscription->student->first_name }} {{ $inv->subscription->student->second_name }}</td>
                        <td class="px-4 py-3">{{ $inv->subscription->plan->name }}</td>
                        <td class="px-4 py-3">{{ number_format($inv->amount_cents/100, 2) }} {{ $inv->currency }}</td>
                        <td class="px-4 py-3">{{ number_format($inv->total_paid/100, 2) }}</td>
                        <td class="px-4 py-3">{{ number_format($inv->outstanding_balance/100, 2) }}</td>
                        <td class="px-4 py-3">
                            <x-badge color="{{ $inv->status === 'paid' ? 'green' : ($inv->status === 'overdue' ? 'red' : 'yellow') }}">
                                {{ ucfirst($inv->status) }}
                            </x-badge>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <a class="text-indigo-700 hover:underline px-2" href="{{ route('accountant.invoices.edit', $inv) }}">Edit</a>
                            <form class="inline" method="POST" action="{{ route('accountant.invoices.destroy', $inv) }}" onsubmit="return confirm('Delete this invoice?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-700 hover:underline px-2" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $invoices->links() }}</div>
</div>
@endsection
