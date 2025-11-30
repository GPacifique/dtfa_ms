@php($title = 'Sports Equipment Details')
@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-slate-900">{{ $sports_equipment->name }}</h1>
                <p class="text-slate-600 mt-1">Ref: {{ $sports_equipment->reference_code ?? 'N/A' }}</p>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('admin.sports-equipment.edit', $sports_equipment) }}" class="px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transition">
                    Edit
                </a>
                <a href="{{ route('admin.sports-equipment.index') }}" class="px-6 py-3 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition">
                    Back to List
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <!-- Main Content -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h2 class="text-xl font-bold text-slate-900 mb-4">Basic Information</h2>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-slate-600">Equipment Type</p>
                                <p class="text-lg font-semibold text-slate-900">{{ $sports_equipment->equipment_type }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-600">Branch</p>
                                <p class="text-lg font-semibold text-slate-900">{{ $sports_equipment->branch->name ?? 'N/A' }}</p>
                            </div>
                        </div>
                        @if($sports_equipment->description)
                        <div>
                            <p class="text-sm text-slate-600">Description</p>
                            <p class="text-slate-900">{{ $sports_equipment->description }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Inventory Status -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h2 class="text-xl font-bold text-slate-900 mb-4">Inventory Status</h2>
                    <div class="space-y-4">
                        <div class="grid grid-cols-3 gap-4">
                            <div class="bg-slate-50 p-4 rounded-lg">
                                <p class="text-sm text-slate-600">Total Quantity</p>
                                <p class="text-2xl font-bold text-indigo-600">{{ $sports_equipment->quantity }}</p>
                            </div>
                            <div class="bg-slate-50 p-4 rounded-lg">
                                <p class="text-sm text-slate-600">Available</p>
                                <p class="text-2xl font-bold text-green-600">{{ $sports_equipment->available_quantity }}</p>
                            </div>
                            <div class="bg-slate-50 p-4 rounded-lg">
                                <p class="text-sm text-slate-600">In Use</p>
                                <p class="text-2xl font-bold text-orange-600">{{ $sports_equipment->quantity - $sports_equipment->available_quantity }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-slate-600">Condition</p>
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-{{ $sports_equipment->getConditionBadgeColor() }}-100 text-{{ $sports_equipment->getConditionBadgeColor() }}-800 mt-1">
                                    {{ ucfirst($sports_equipment->condition) }}
                                </span>
                            </div>
                            <div>
                                <p class="text-sm text-slate-600">Status</p>
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-{{ $sports_equipment->getStatusBadgeColor() }}-100 text-{{ $sports_equipment->getStatusBadgeColor() }}-800 mt-1">
                                    {{ ucfirst(str_replace('_', ' ', $sports_equipment->status)) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Purchase Information -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h2 class="text-xl font-bold text-slate-900 mb-4">Purchase Information</h2>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-slate-600">Purchase Date</p>
                                <p class="text-lg font-semibold text-slate-900">{{ $sports_equipment->purchase_date?->format('M d, Y') ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-slate-600">Purchase Price</p>
                                <p class="text-lg font-semibold text-slate-900">${{ number_format($sports_equipment->purchase_price, 2) }}</p>
                            </div>
                        </div>
                        @if($sports_equipment->replacement_cost)
                        <div>
                            <p class="text-sm text-slate-600">Replacement Cost</p>
                            <p class="text-lg font-semibold text-slate-900">${{ number_format($sports_equipment->replacement_cost, 2) }}</p>
                        </div>
                        @endif
                        @if($sports_equipment->supplier)
                        <div>
                            <p class="text-sm text-slate-600">Supplier</p>
                            <p class="text-lg font-semibold text-slate-900">{{ $sports_equipment->supplier }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Location & Maintenance -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h2 class="text-xl font-bold text-slate-900 mb-4">Location & Maintenance</h2>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-slate-600">Location</p>
                                <p class="text-lg font-semibold text-slate-900">{{ $sports_equipment->location }}</p>
                            </div>
                            @if($sports_equipment->storage_area)
                            <div>
                                <p class="text-sm text-slate-600">Storage Area</p>
                                <p class="text-lg font-semibold text-slate-900">{{ $sports_equipment->storage_area }}</p>
                            </div>
                            @endif
                        </div>
                        @if($sports_equipment->maintenance_date)
                        <div>
                            <p class="text-sm text-slate-600">Last Maintenance</p>
                            <p class="text-lg font-semibold text-slate-900">{{ $sports_equipment->maintenance_date?->format('M d, Y') }}</p>
                        </div>
                        @endif
                        @if($sports_equipment->maintenance_notes)
                        <div>
                            <p class="text-sm text-slate-600">Maintenance Notes</p>
                            <p class="text-slate-900">{{ $sports_equipment->maintenance_notes }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                @if($sports_equipment->notes)
                <!-- Additional Notes -->
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h2 class="text-xl font-bold text-slate-900 mb-4">Notes</h2>
                    <p class="text-slate-900">{{ $sports_equipment->notes }}</p>
                </div>
                @endif
            </div>

            <!-- Right Column - Timeline -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
                    <h2 class="text-xl font-bold text-slate-900 mb-4">Timeline</h2>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-slate-600">Created</p>
                            <p class="text-sm font-semibold text-slate-900">{{ $sports_equipment->created_at?->format('M d, Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-slate-600">Last Updated</p>
                            <p class="text-sm font-semibold text-slate-900">{{ $sports_equipment->updated_at?->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Delete Button -->
                <form action="{{ route('admin.sports-equipment.destroy', $sports_equipment) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this equipment?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-6 py-3 bg-red-600 text-white font-semibold rounded-lg hover:bg-red-700 transition">
                        Delete Equipment
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
