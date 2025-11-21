@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <a href="{{ url()->previous() ?? route('admin.capacity-buildings.index') }}" class="btn-secondary">&larr; Back</a>
            <h2 class="text-lg font-semibold">Capacity Building Record</h2>
            <div></div>
        </div>
        <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div><dt class="font-semibold">Name</dt><dd>{{ $item->first_name }} {{ $item->second_name }}</dd></div>
            <div><dt class="font-semibold">Role/Function</dt><dd>{{ $item->role_function }}</dd></div>
            <div><dt class="font-semibold">Training</dt><dd>{{ $item->training_name }}</dd></div>
            <div><dt class="font-semibold">Institution</dt><dd>{{ $item->institution_name }}</dd></div>
            <div><dt class="font-semibold">Start</dt><dd>{{ optional($item->start_date)->format('Y-m-d') }}</dd></div>
            <div><dt class="font-semibold">End</dt><dd>{{ optional($item->end_date)->format('Y-m-d') }}</dd></div>
            <div><dt class="font-semibold">Channel</dt><dd>{{ $item->channel }}</dd></div>
            <div><dt class="font-semibold">Cost</dt><dd>{{ $item->cost_type }} {{ $item->cost_amount }}</dd></div>
            <div><dt class="font-semibold">Category</dt><dd>{{ $item->training_category }}</dd></div>
            <div><dt class="font-semibold">Venue</dt><dd>{{ $item->venue }}</dd></div>
            <div><dt class="font-semibold">Location</dt><dd>{{ $item->city }}, {{ $item->country }}</dd></div>
        </dl>

        <div class="mt-6">
            <a href="{{ route('admin.capacity-buildings.index') }}" class="btn-secondary">Back</a>
            <a href="{{ route('admin.capacity-buildings.edit', $item) }}" class="btn-primary">Edit</a>
        </div>
    </div>
@endsection
