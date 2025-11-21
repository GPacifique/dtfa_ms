@extends('layouts.app')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ url()->previous() ?? route('admin.dashboard') }}" class="btn-secondary">&larr; Back</a>
            <h1 class="text-2xl font-bold">Capacity Building Records</h1>
        </div>
        <a href="{{ route('admin.capacity-buildings.create') }}" class="btn-primary">New Record</a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-slate-50">
                <tr>
                    <th class="p-3 text-left">Name</th>
                    <th class="p-3 text-left">Training</th>
                    <th class="p-3 text-left">Start</th>
                    <th class="p-3 text-left">End</th>
                    <th class="p-3 text-left">Channel</th>
                    <th class="p-3 text-left">Cost</th>
                    <th class="p-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr class="border-t">
                        <td class="p-3">{{ $item->first_name }} {{ $item->second_name }}</td>
                        <td class="p-3">{{ $item->training_name }}</td>
                        <td class="p-3">{{ optional($item->start_date)->format('Y-m-d') }}</td>
                        <td class="p-3">{{ optional($item->end_date)->format('Y-m-d') }}</td>
                        <td class="p-3">{{ $item->channel }}</td>
                        <td class="p-3">{{ $item->cost_type }} {{ $item->cost_amount ? number_format($item->cost_amount,2) : '' }}</td>
                        <td class="p-3">
                            <a href="{{ route('admin.capacity-buildings.edit', $item) }}" class="text-blue-600">Edit</a>
                            <form action="{{ route('admin.capacity-buildings.destroy', $item) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete record?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 ml-3">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">{{ $items->links() }}</div>
@endsection
