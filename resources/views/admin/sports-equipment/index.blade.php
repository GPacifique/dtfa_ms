@php($title = 'Sports Equipment Management')
@extends('layouts.app')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">Sports Equipment Management</h1>
                <p class="text-slate-600 mt-1">Manage sports equipment inventory and tracking</p>
            </div>
            <a href="{{ route('admin.sports-equipment.create') }}" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add Sports Equipment
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Equipment Type</label>
                    <input type="text" name="equipment_type" value="{{ request('equipment_type') }}" placeholder="e.g., balls, nets..." class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Condition</label>
                    <select name="condition" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">All Conditions</option>
                        <option value="excellent" @selected(request('condition') === 'excellent')>Excellent</option>
                        <option value="good" @selected(request('condition') === 'good')>Good</option>
                        <option value="fair" @selected(request('condition') === 'fair')>Fair</option>
                        <option value="poor" @selected(request('condition') === 'poor')>Poor</option>
                        <option value="damaged" @selected(request('condition') === 'damaged')>Damaged</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Status</label>
                    <select name="status" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">All Status</option>
                        <option value="available" @selected(request('status') === 'available')>Available</option>
                        <option value="in_use" @selected(request('status') === 'in_use')>In Use</option>
                        <option value="maintenance" @selected(request('status') === 'maintenance')>Maintenance</option>
                        <option value="retired" @selected(request('status') === 'retired')>Retired</option>
                        <option value="lost" @selected(request('status') === 'lost')>Lost</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">
                        Filter
                    </button>
                    <a href="{{ route('admin.sports-equipment.index') }}" class="px-6 py-2 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition">
                        Clear
                    </a>
                </div>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
            <table class="w-full">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr class="text-left text-sm font-semibold text-slate-700">
                        <th class="px-6 py-3">Equipment Name</th>
                        <th class="px-6 py-3">Type</th>
                        <th class="px-6 py-3">Quantity</th>
                        <th class="px-6 py-3">Condition</th>
                        <th class="px-6 py-3">Status</th>
                        <th class="px-6 py-3">Location</th>
                        <th class="px-6 py-3 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    @forelse($sports_equipment as $item)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-6 py-4">
                            <p class="text-sm font-semibold text-slate-900">{{ $item->name }}</p>
                            <p class="text-xs text-slate-500">Ref: {{ $item->reference_code ?? 'N/A' }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $item->equipment_type }}</td>
                        <td class="px-6 py-4 text-sm text-slate-600">
                            <span class="font-semibold">{{ $item->available_quantity }}</span> / {{ $item->quantity }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-{{ $item->getConditionBadgeColor() }}-100 text-{{ $item->getConditionBadgeColor() }}-800">
                                {{ ucfirst($item->condition) }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-{{ $item->getStatusBadgeColor() }}-100 text-{{ $item->getStatusBadgeColor() }}-800">
                                {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-slate-600">{{ $item->location }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.sports-equipment.show', $item) }}" class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">View</a>
                            <a href="{{ route('admin.sports-equipment.edit', $item) }}" class="text-blue-600 hover:text-blue-900 font-medium text-sm">Edit</a>
                            <form action="{{ route('admin.sports-equipment.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Delete this equipment?');">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:text-red-900 font-medium text-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-8 text-center text-slate-500">
                            No sports equipment found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $sports_equipment->links() }}
        </div>
    </div>
@endsection
