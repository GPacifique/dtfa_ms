@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Incomes</h3>
        <a href="{{ route('admin.incomes.create') }}" class="btn btn-primary">Record Income</a>
    </div>

    <!-- Month Filter -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('admin.incomes.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Month</label>
                    <select name="month" class="form-select" onchange="this.form.submit()">
                        <option value="all" {{ request('month') === 'all' ? 'selected' : '' }}>All Time</option>
                        @foreach($months as $m)
                            <option value="{{ $m['value'] }}" {{ request('month', now()->format('Y-m')) === $m['value'] ? 'selected' : '' }}>
                                {{ $m['label'] }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @if(isset($branches) && $branches->count() > 0)
                <div class="col-md-4">
                    <label class="form-label">Branch</label>
                    <select name="branch_id" class="form-select" onchange="this.form.submit()">
                        <option value="">All Branches</option>
                        @foreach($branches as $branch)
                            <option value="{{ $branch->id }}" {{ request('branch_id') == $branch->id ? 'selected' : '' }}>
                                {{ $branch->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @endif
            </form>
        </div>
    </div>

    <table class="table table-sm">
        <thead>
            <tr>
                <th>ID</th>
                <th>Branch</th>
                <th>Amount</th>
                <th>Category</th>
                <th>Source</th>
                <th>Received At</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($incomes as $income)
            <tr>
                <td>{{ $income->id }}</td>
                <td>{{ $income->branch?->name }}</td>
                <td>{{ number_format($income->amount_cents/100, 2) }} {{ $income->currency }}</td>
                <td>{{ $income->category }}</td>
                <td>{{ $income->source }}</td>
                <td>{{ $income->received_at?->format('Y-m-d H:i') }}</td>
                <td>
                    <a href="{{ route('admin.incomes.show', $income) }}" class="btn btn-sm btn-secondary">View</a>
                    <a href="{{ route('admin.incomes.edit', $income) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $incomes->links() }}
</div>
@endsection
