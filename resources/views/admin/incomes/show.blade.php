@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Income #{{ $income->id }}</h3>

    <div class="mb-2"><strong>Branch:</strong> {{ $income->branch?->name }}</div>
    <div class="mb-2"><strong>Amount:</strong> {{ number_format($income->amount_cents/100,2) }} {{ $income->currency }}</div>
    <div class="mb-2"><strong>Category:</strong> {{ $income->category }}</div>
    <div class="mb-2"><strong>Source:</strong> {{ $income->source }}</div>
    <div class="mb-2"><strong>Received:</strong> {{ $income->received_at?->format('Y-m-d H:i') }}</div>
    <div class="mb-2"><strong>Notes:</strong> {{ $income->notes }}</div>

    <a href="{{ route('admin.incomes.index') }}" class="btn btn-link">Back</a>
</div>
@endsection
