@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between mb-3">
        <h3>Incomes</h3>
        <a href="{{ route('admin.incomes.create') }}" class="btn btn-primary">Record Income</a>
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
