@extends('layouts.app')

@section('content')
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex items-center justify-between mb-4">
            <a href="{{ url()->previous() ?? route('admin.capacity-buildings.index') }}" class="btn-secondary">&larr; Back</a>
            <h2 class="text-lg font-semibold">Edit Capacity Building Record</h2>
            <div></div>
        </div>
        <form action="{{ route('admin.capacity-buildings.update', $item) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.capacity_buildings._form')

            <div class="mt-6 flex items-center justify-end gap-3">
                <a href="{{ route('admin.capacity-buildings.index') }}" class="btn-secondary">Cancel</a>
                <button class="btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
