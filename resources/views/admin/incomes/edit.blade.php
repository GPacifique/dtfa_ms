@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Edit Income</h3>

    <form method="POST" action="{{ route('admin.incomes.update', $income) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Branch</label>
            <select name="branch_id" class="form-control">
                <option value="">-- Select branch --</option>
                @foreach($branches as $b)
                    <option value="{{ $b->id }}" @if($income->branch_id == $b->id) selected @endif>{{ $b->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Amount</label>
            <input name="amount" type="text" class="form-control" value="{{ number_format($income->amount_cents/100, 2) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Currency</label>
            <input name="currency" type="text" class="form-control" value="{{ $income->currency }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <input name="category" type="text" class="form-control" value="{{ $income->category }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Source</label>
            <input name="source" type="text" class="form-control" value="{{ $income->source }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Received At</label>
            <input name="received_at" type="datetime-local" class="form-control" value="{{ $income->received_at?->format('Y-m-d\TH:i') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control">{{ $income->notes }}</textarea>
        </div>

        <button class="btn btn-primary">Save</button>
        <a href="{{ route('admin.incomes.index') }}" class="btn btn-link">Cancel</a>
    </form>
</div>
@endsection
