@extends('layouts.app')

@php($title = 'Kit Manager Dashboard')

@section('content')
<div class="py-6 px-4 sm:px-6">
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">Equipment Management Dashboard</h1>
        <p class="text-slate-600 dark:text-slate-400 mt-2">Monitor and manage all sports and office equipment</p>
    </div>

    <!-- Overall Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Sports Equipment -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Total Sports Equipment</p>
                    <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1">{{ $sportsEquipmentTotal }}</p>
                </div>
                <svg class="w-12 h-12 text-blue-500 opacity-20" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>

        <!-- Total Office Equipment -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 border-l-4 border-emerald-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Total Office Equipment</p>
                    <p class="text-3xl font-bold text-slate-900 dark:text-white mt-1">{{ $officeEquipmentTotal }}</p>
                </div>
                <svg class="w-12 h-12 text-emerald-500 opacity-20" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h12a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zm0 8a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z" />
                </svg>
            </div>
        </div>

        <!-- Sports Equipment in Use -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 border-l-4 border-green-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Sports Equipment In Use</p>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-1">{{ $sportsEquipmentInUse }}</p>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-2">{{ $sportsEquipmentUtilizationRate }}% utilization</p>
                </div>
                <svg class="w-12 h-12 text-green-500 opacity-20" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-2.77 3.066 3.066 0 00-3.58 3.03A3.066 3.066 0 006.267 3.455zm9.8 6.32a3.066 3.066 0 001.745-2.77 3.066 3.066 0 00-3.58 3.03 3.066 3.066 0 001.835-.26zM9 13a3 3 0 11-6 0 3 3 0 016 0zm7 0a3 3 0 11-6 0 3 3 0 016 0z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>

        <!-- Equipment Needing Repair -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6 border-l-4 border-red-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400">Equipment Needing Repair</p>
                    <p class="text-3xl font-bold text-red-600 dark:text-red-400 mt-1">{{ count($damageSportsEquipment) + count($damageOfficeEquipment) }}</p>
                </div>
                <svg class="w-12 h-12 text-red-500 opacity-20" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 15 2.05 9.991L3.464 8.05A6 6 0 1113.476 14.89z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </div>

    <!-- Secondary Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
        <!-- Good Condition -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 border-t-2 border-green-400">
            <p class="text-xs font-semibold text-slate-600 dark:text-slate-400 uppercase tracking-wider">Good Condition</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-white mt-2">{{ $sportsEquipmentInGoodCondition }}</p>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Sports Equipment</p>
        </div>

        <!-- Stored -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 border-t-2 border-blue-400">
            <p class="text-xs font-semibold text-slate-600 dark:text-slate-400 uppercase tracking-wider">Stored</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-white mt-2">{{ $sportsEquipmentStored }}</p>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Sports Equipment</p>
        </div>

        <!-- Assigned -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 border-t-2 border-purple-400">
            <p class="text-xs font-semibold text-slate-600 dark:text-slate-400 uppercase tracking-wider">Assigned</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-white mt-2">{{ $officeEquipmentAssigned }}</p>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Office Equipment</p>
        </div>

        <!-- In Use -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 border-t-2 border-emerald-400">
            <p class="text-xs font-semibold text-slate-600 dark:text-slate-400 uppercase tracking-wider">In Use</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-white mt-2">{{ $officeEquipmentInUse }}</p>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Office Equipment</p>
        </div>

        <!-- Warranty Expiring -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-4 border-t-2 border-amber-400">
            <p class="text-xs font-semibold text-slate-600 dark:text-slate-400 uppercase tracking-wider">Expiring Soon</p>
            <p class="text-2xl font-bold text-slate-900 dark:text-white mt-2">{{ $warrantyExpiringCount }}</p>
            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Warranty (30d)</p>
        </div>
    </div>

    <!-- Equipment Conditions Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Sports Equipment by Condition -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Sports Equipment Condition</h3>
            <div class="space-y-3">
                @php
                    $conditionColors = [
                        'excellent' => 'text-green-600 dark:text-green-400 bg-green-100 dark:bg-green-900',
                        'good' => 'text-blue-600 dark:text-blue-400 bg-blue-100 dark:bg-blue-900',
                        'fair' => 'text-yellow-600 dark:text-yellow-400 bg-yellow-100 dark:bg-yellow-900',
                        'damaged' => 'text-red-600 dark:text-red-400 bg-red-100 dark:bg-red-900',
                    ];
                @endphp
                @forelse($sportsEquipmentByCondition as $condition => $count)
                    <div class="flex items-center justify-between">
                        <span class="text-slate-700 dark:text-slate-300 capitalize">{{ $condition }}</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $conditionColors[$condition] ?? 'text-slate-600 bg-slate-100' }}">
                            {{ $count }}
                        </span>
                    </div>
                @empty
                    <p class="text-slate-500 dark:text-slate-400 text-sm">No sports equipment yet</p>
                @endforelse
            </div>
        </div>

        <!-- Office Equipment by Condition -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Office Equipment Condition</h3>
            <div class="space-y-3">
                @forelse($officeEquipmentByCondition as $condition => $count)
                    <div class="flex items-center justify-between">
                        <span class="text-slate-700 dark:text-slate-300 capitalize">{{ $condition }}</span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $conditionColors[$condition] ?? 'text-slate-600 bg-slate-100' }}">
                            {{ $count }}
                        </span>
                    </div>
                @empty
                    <p class="text-slate-500 dark:text-slate-400 text-sm">No office equipment yet</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Equipment Needing Repair Section -->
    @if(count($damageSportsEquipment) > 0 || count($damageOfficeEquipment) > 0)
        <div class="bg-red-50 dark:bg-red-900/20 rounded-lg shadow p-6 mb-8 border border-red-200 dark:border-red-900">
            <h3 class="text-lg font-semibold text-red-900 dark:text-red-400 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                Equipment Needing Attention
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @if(count($damageSportsEquipment) > 0)
                    <div>
                        <h4 class="font-semibold text-slate-900 dark:text-white mb-3">Sports Equipment ({{ count($damageSportsEquipment) }})</h4>
                        <div class="space-y-2">
                            @foreach($damageSportsEquipment as $equipment)
                                <div class="bg-white dark:bg-slate-800 rounded p-3 flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-slate-900 dark:text-white text-sm">{{ $equipment->name }}</p>
                                        <p class="text-slate-600 dark:text-slate-400 text-xs">Type: {{ $equipment->equipment_type }}</p>
                                    </div>
                                    <a href="{{ route('admin.sports_equipment.edit', $equipment) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">Edit</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
                @if(count($damageOfficeEquipment) > 0)
                    <div>
                        <h4 class="font-semibold text-slate-900 dark:text-white mb-3">Office Equipment ({{ count($damageOfficeEquipment) }})</h4>
                        <div class="space-y-2">
                            @foreach($damageOfficeEquipment as $equipment)
                                <div class="bg-white dark:bg-slate-800 rounded p-3 flex items-center justify-between">
                                    <div>
                                        <p class="font-medium text-slate-900 dark:text-white text-sm">{{ $equipment->name }}</p>
                                        <p class="text-slate-600 dark:text-slate-400 text-xs">Assigned to: {{ $equipment->assigned_to ?? 'Unassigned' }}</p>
                                    </div>
                                    <a href="{{ route('admin.office_equipment.edit', $equipment) }}" class="text-blue-600 dark:text-blue-400 hover:underline text-sm">Edit</a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    @endif

    <!-- Recent Updates -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Recent Sports Equipment Updates -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Recent Sports Equipment Updates</h3>
            <div class="space-y-3">
                @forelse($recentSportsEquipment as $equipment)
                    <div class="flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-700 rounded">
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-slate-900 dark:text-white text-sm truncate">{{ $equipment->name }}</p>
                            <p class="text-slate-600 dark:text-slate-400 text-xs">{{ $equipment->updated_at->format('M d, Y') }}</p>
                        </div>
                        <a href="{{ route('admin.sports_equipment.show', $equipment) }}" class="ml-2 text-blue-600 dark:text-blue-400 hover:underline text-sm whitespace-nowrap">View</a>
                    </div>
                @empty
                    <p class="text-slate-500 dark:text-slate-400 text-sm">No sports equipment yet</p>
                @endforelse
            </div>
        </div>

        <!-- Recent Office Equipment Updates -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Recent Office Equipment Updates</h3>
            <div class="space-y-3">
                @forelse($recentOfficeEquipment as $equipment)
                    <div class="flex items-center justify-between p-3 bg-slate-50 dark:bg-slate-700 rounded">
                        <div class="flex-1 min-w-0">
                            <p class="font-medium text-slate-900 dark:text-white text-sm truncate">{{ $equipment->name }}</p>
                            <p class="text-slate-600 dark:text-slate-400 text-xs">{{ $equipment->updated_at->format('M d, Y') }}</p>
                        </div>
                        <a href="{{ route('admin.office_equipment.show', $equipment) }}" class="ml-2 text-blue-600 dark:text-blue-400 hover:underline text-sm whitespace-nowrap">View</a>
                    </div>
                @empty
                    <p class="text-slate-500 dark:text-slate-400 text-sm">No office equipment yet</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Equipment Types Breakdown -->
    @if($equipmentTypes->count() > 0)
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-4">Sports Equipment by Type</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach($equipmentTypes as $type)
                    <div class="text-center p-4 bg-slate-50 dark:bg-slate-700 rounded">
                        <p class="font-semibold text-slate-900 dark:text-white text-lg">{{ $type->count }}</p>
                        <p class="text-slate-600 dark:text-slate-400 text-sm capitalize">{{ str_replace('_', ' ', $type->equipment_type) }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
