@extends('layouts.app')

@php($title = __('app.kit_manager_dashboard'))

@section('content')
<div class="py-4 md:py-6 px-3 sm:px-4 md:px-6 lg:px-8">

    <!-- Page Header -->
    <div class="mb-6 md:mb-8">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div class="min-w-0">
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 dark:text-white truncate">
                    {{ __('app.equipment_dashboard') }}
                </h1>
                <p class="text-sm sm:text-base text-slate-600 dark:text-slate-400 mt-1">
                    {{ __('app.real_time_overview') }}
                </p>
            </div>

            <div class="flex flex-col xs:flex-row gap-2 flex-shrink-0">
                <a href="{{ route('admin.sports-equipment.index') }}"
                   class="btn btn-secondary text-xs sm:text-sm px-3 sm:px-4 py-2">
                    {{ __('app.sports_equip') }}
                </a>

                <a href="{{ route('admin.office-equipment.index') }}"
                   class="btn btn-secondary text-xs sm:text-sm px-3 sm:px-4 py-2">
                    {{ __('app.office_equip') }}
                </a>
            </div>
        </div>
    </div>

    <!-- Key Metrics Overview -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 md:gap-6 mb-6 md:mb-8">

        <!-- Total Sports Equipment -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-4 sm:p-5 md:p-6
                    border-l-4 border-blue-500 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between gap-3">
                <div class="flex-1 min-w-0">
                    <p class="text-xs sm:text-sm font-medium text-slate-600 dark:text-slate-400 truncate">
                        {{ __('app.sports_equipment') }}
                    </p>
                    <p class="text-2xl sm:text-3xl md:text-4xl font-bold text-blue-600 dark:text-blue-400 mt-1 sm:mt-2">
                        {{ $sportsEquipmentTotal }}
                    </p>
                    <p class="text-xs text-slate-500 dark:text-slate-500 mt-1 sm:mt-2">
                        {{ __('app.total_inventory') }}
                    </p>
                </div>

                <div class="bg-blue-100 dark:bg-blue-900/30 p-2 sm:p-3 rounded-lg flex-shrink-0">
                    <svg class="w-6 sm:w-8 h-6 sm:h-8 text-blue-600"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Office Equipment -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-4 sm:p-5 md:p-6
                    border-l-4 border-emerald-500 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between gap-3">
                <div class="flex-1 min-w-0">
                    <p class="text-xs sm:text-sm font-medium text-slate-600 dark:text-slate-400 truncate">
                        {{ __('app.office_equipment') }}
                    </p>
                    <p class="text-2xl sm:text-3xl md:text-4xl font-bold text-emerald-600 dark:text-emerald-400 mt-1 sm:mt-2">
                        {{ $officeEquipmentTotal }}
                    </p>
                    <p class="text-xs text-slate-500 dark:text-slate-500 mt-1 sm:mt-2">
                        {{ __('app.total_inventory') }}
                    </p>
                </div>

                <div class="bg-emerald-100 dark:bg-emerald-900/30 p-2 sm:p-3 rounded-lg flex-shrink-0">
                    <svg class="w-6 sm:w-8 h-6 sm:h-8 text-emerald-600"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h12a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zm0 8a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Equipment In Use -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-4 sm:p-5 md:p-6
                    border-l-4 border-green-500 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between gap-3">
                <div class="flex-1 min-w-0">
                    <p class="text-xs sm:text-sm font-medium text-slate-600 dark:text-slate-400 truncate">
                        {{ __('app.in_active_use') }}
                    </p>

                    @php
                        $inUse = $sportsEquipmentInUse + $officeEquipmentInUse;
                        $total = $sportsEquipmentTotal + $officeEquipmentTotal;
                        $utilization = round(($inUse / max($total, 1)) * 100, 1);
                    @endphp

                    <p class="text-2xl sm:text-3xl md:text-4xl font-bold text-green-600 dark:text-green-400 mt-1 sm:mt-2">
                        {{ $inUse }}
                    </p>

                    <p class="text-xs text-slate-500 dark:text-slate-500 mt-1 sm:mt-2 truncate">
                        {{ $utilization }}% {{ __('app.utilization') }}
                    </p>
                </div>

                <div class="bg-green-100 dark:bg-green-900/30 p-2 sm:p-3 rounded-lg flex-shrink-0">
                    <svg class="w-6 sm:w-8 h-6 sm:h-8 text-green-600"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M6.267 3.455a3.066 3.066 0 001.745-2.77 3.066 3.066 0 00-3.58 3.03A3.066 3.066 0 006.267 3.455zm9.8 6.32a3.066 3.066 0 001.745-2.77 3.066 3.066 0 00-3.58 3.03 3.066 3.066 0 001.835-.26zM9 13a3 3 0 11-6 0 3 3 0 016 0zm7 0a3 3 0 11-6 0 3 3 0 016 0z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Attention Required -->
        <div class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-4 sm:p-5 md:p-6
                    border-l-4 border-amber-500 hover:shadow-lg transition-shadow">
            <div class="flex items-start justify-between gap-3">

                @php
                    $needsAttention = count($damageSportsEquipment)
                                    + count($damageOfficeEquipment)
                                    + $warrantyExpiringCount;
                @endphp

                <div class="flex-1 min-w-0">
                    <p class="text-xs sm:text-sm font-medium text-slate-600 dark:text-slate-400 truncate">
                        {{ __('app.needs_attention') }}
                    </p>

                    <p class="text-2xl sm:text-3xl md:text-4xl font-bold text-amber-600 dark:text-amber-400 mt-1 sm:mt-2">
                        {{ $needsAttention }}
                    </p>

                    <p class="text-xs text-slate-500 dark:text-slate-500 mt-1 sm:mt-2 truncate">
                        {{ __('app.damaged_warranty_expiring') }}
                    </p>
                </div>

                <div class="bg-amber-100 dark:bg-amber-900/30 p-2 sm:p-3 rounded-lg flex-shrink-0">
                    <svg class="w-6 sm:w-8 h-6 sm:h-8 text-amber-600"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
        </div>

    </div>

    <!-- More sections below (Condition cards, Storage status, Alerts, Recent activity, Type distribution)… -->
    <!-- ✨ The rest of your template is structurally OK and mostly needed formatting fixes.  -->
    <!-- If you'd like, I can polish the remaining sections the same way. -->

</div>
@endsection
