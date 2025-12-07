@extends('layouts.app')

@push('hero')
    <x-hero title="Record Income" subtitle="Add a new income entry">
        <a href="{{ route('admin.incomes.index') }}" class="inline-flex items-center px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-lg">Back to Incomes</a>
    </x-hero>
@endpush

@section('content')
<div class="container">

    <form method="POST" action="{{ route('admin.incomes.store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Branch</label>
            <select name="branch_id" class="form-control">
                <option value="">-- Select branch --</option>
                @foreach($branches as $b)
                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Amount</label>
            <input name="amount" type="text" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Currency</label>
            <input name="currency" type="text" class="form-control" value="RWF">
        </div>

        <div class="mb-3">
            <label class="form-label">Category</label>
            <input name="category" type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Source</label>
            <input name="source" type="text" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Received At</label>
            <input name="received_at" type="datetime-local" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Notes</label>
            <textarea name="notes" class="form-control"></textarea>
        </div>

        <button class="btn btn-primary">Save</button>
        <a href="{{ route('admin.incomes.index') }}" class="btn btn-link">Cancel</a>
    </form>
</div>
@endsection
