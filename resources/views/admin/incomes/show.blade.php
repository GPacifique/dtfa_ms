@extends('layouts.app')

@push('hero')
    <x-hero title="Income #{{ $income->id }}" subtitle="Detailed income information">
        <a href="{{ route('admin.incomes.edit', $income) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg mr-2">Edit</a>
        <a href="{{ route('admin.incomes.index') }}" class="inline-flex items-center px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-lg">Back to Incomes</a>
    </x-hero>
@endpush

@section('content')
<div class="container">

    <div class="mb-2"><strong>Branch:</strong> {{ $income->branch?->name }}</div>
    <div class="mb-2"><strong>Amount:</strong> {{ number_format($income->amount_cents, 0) }} {{ $income->currency }}</div>
    <div class="mb-2"><strong>Category:</strong> {{ $income->category }}</div>
    <div class="mb-2"><strong>Source:</strong> {{ $income->source }}</div>
    <div class="mb-2"><strong>Received:</strong> {{ $income->received_at?->format('Y-m-d H:i') }}</div>
    <div class="mb-2"><strong>Notes:</strong> {{ $income->notes }}</div>

    <a href="{{ route('admin.incomes.index') }}" class="btn btn-link">Back</a>
</div>
@endsection
