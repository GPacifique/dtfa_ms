@php $title = 'Unified Equipment Management'; @endphp
@extends('layouts.app')

@section('hero')
    <x-hero title="Equipment Management" subtitle="All equipment in one place – General, Sports & Office">
        <div class="mt-4 flex flex-wrap gap-3">
            <a href="{{ route('admin.equipment.unified.requests') }}" class="btn-primary">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Equipment Requests
            </a>
            <a href="{{ route('admin.equipment.unified.training') }}" class="btn-secondary">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Training Schedules
            </a>
            <a href="{{ route('admin.equipment.unified.usage-reports') }}" class="btn-secondary">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Usage Reports
            </a>
        </div>
    </x-hero>
@endsection

@section('content')
<div class="space-y-6">

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">{{ session('success') }}</div>
    @endif

    {{-- ── STATS CARDS ──────────────────────────────────────────────── --}}
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4">
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 text-center">
            <p class="text-2xl font-bold text-indigo-600">{{ $stats['general_total'] }}</p>
            <p class="text-xs text-slate-500 mt-1">General Items</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 text-center">
            <p class="text-2xl font-bold text-green-600">{{ $stats['general_avail'] }}</p>
            <p class="text-xs text-slate-500 mt-1">General Avail.</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 text-center">
            <p class="text-2xl font-bold text-blue-600">{{ $stats['sports_total'] }}</p>
            <p class="text-xs text-slate-500 mt-1">Sports Items</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 text-center">
            <p class="text-2xl font-bold text-green-600">{{ $stats['sports_avail'] }}</p>
            <p class="text-xs text-slate-500 mt-1">Sports Avail.</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 text-center">
            <p class="text-2xl font-bold text-purple-600">{{ $stats['office_total'] }}</p>
            <p class="text-xs text-slate-500 mt-1">Office Items</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4 text-center">
            <p class="text-2xl font-bold text-green-600">{{ $stats['office_avail'] }}</p>
            <p class="text-xs text-slate-500 mt-1">Office Avail.</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-yellow-200 p-4 text-center">
            <p class="text-2xl font-bold text-yellow-600">{{ $stats['pending_requests'] }}</p>
            <p class="text-xs text-slate-500 mt-1">Pending Requests</p>
        </div>
    </div>

    {{-- ── QUICK ACCESS LINKS ─────────────────────────────────────── --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        {{-- General Equipment --}}
        <div class="bg-white rounded-xl shadow-sm border border-indigo-200 p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="bg-indigo-100 rounded-lg p-2">
                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <h3 class="text-sm font-bold text-slate-800">General Equipment</h3>
            </div>
            <div class="flex flex-col gap-2">
                <a href="{{ route('admin.equipment.index') }}" class="flex items-center gap-2 px-3 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-xs font-semibold rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    View All
                </a>
                <a href="{{ route('admin.equipment.create') }}" class="flex items-center gap-2 px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-semibold rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add New
                </a>
            </div>
        </div>

        {{-- Sports Equipment --}}
        <div class="bg-white rounded-xl shadow-sm border border-blue-200 p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="bg-blue-100 rounded-lg p-2">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 7a4 4 0 00-4 4v6a4 4 0 004 4h12a4 4 0 004-4v-6a4 4 0 00-4-4M3 11h6M15 11h6M3 17h6M15 17h6"/></svg>
                </div>
                <h3 class="text-sm font-bold text-slate-800">Sports Equipment</h3>
            </div>
            <div class="flex flex-col gap-2">
                <a href="{{ route('admin.sports-equipment.index') }}" class="flex items-center gap-2 px-3 py-2 bg-blue-50 hover:bg-blue-100 text-blue-700 text-xs font-semibold rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    View All
                </a>
                <a href="{{ route('admin.sports-equipment.create') }}" class="flex items-center gap-2 px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white text-xs font-semibold rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add New
                </a>
            </div>
        </div>

        {{-- Office Equipment --}}
        <div class="bg-white rounded-xl shadow-sm border border-purple-200 p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="bg-purple-100 rounded-lg p-2">
                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m0 0L4 7m8 4v10l8-4v-10m-8 14l-8-4v-10"/></svg>
                </div>
                <h3 class="text-sm font-bold text-slate-800">Office Equipment</h3>
            </div>
            <div class="flex flex-col gap-2">
                <a href="{{ route('admin.office-equipment.index') }}" class="flex items-center gap-2 px-3 py-2 bg-purple-50 hover:bg-purple-100 text-purple-700 text-xs font-semibold rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/></svg>
                    View All
                </a>
                <a href="{{ route('admin.office-equipment.create') }}" class="flex items-center gap-2 px-3 py-2 bg-purple-600 hover:bg-purple-700 text-white text-xs font-semibold rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add New
                </a>
            </div>
        </div>

        {{-- Kit Manager Dashboard --}}
        @if(Route::has('kit-manager.dashboard'))
        <div class="bg-white rounded-xl shadow-sm border border-amber-200 p-5">
            <div class="flex items-center gap-3 mb-3">
                <div class="bg-amber-100 rounded-lg p-2">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8.97-5.7a1 1 0 00-1.06 0L4 7m16 0l-8 4.97m0 0L4 7m16 0v10a1 1 0 01-.94.997L12 22.97m0 0l8-4.97V7M12 22.97L4 18M12 22.97v-4.97"/></svg>
                </div>
                <h3 class="text-sm font-bold text-slate-800">Kit Manager</h3>
            </div>
            <div class="flex flex-col gap-2">
                <a href="{{ route('kit-manager.dashboard') }}" class="flex items-center gap-2 px-3 py-2 bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold rounded-lg transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                    Open Dashboard
                </a>
            </div>
        </div>
        @endif
    </div>

    {{-- ── FILTERS ─────────────────────────────────────────────────── --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
        <form method="GET" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 items-end">
            <input type="hidden" name="tab" value="{{ $tab }}">
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Search</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Name…"
                    class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Status</label>
                <select name="status" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Status</option>
                    <option value="available" @selected(request('status')==='available')>Available</option>
                    <option value="in_use" @selected(request('status')==='in_use')>In Use</option>
                    <option value="maintenance" @selected(request('status')==='maintenance')>Maintenance</option>
                    <option value="retired" @selected(request('status')==='retired')>Retired</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Condition</label>
                <select name="condition" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Conditions</option>
                    <option value="excellent" @selected(request('condition')==='excellent')>Excellent</option>
                    <option value="good" @selected(request('condition')==='good')>Good</option>
                    <option value="fair" @selected(request('condition')==='fair')>Fair</option>
                    <option value="poor" @selected(request('condition')==='poor')>Poor</option>
                    <option value="damaged" @selected(request('condition')==='damaged')>Damaged</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Branch</label>
                <select name="branch_id" class="w-full px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Branches</option>
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" @selected(request('branch_id')==$branch->id)>{{ $branch->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 px-4 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">Filter</button>
                <a href="{{ route('admin.equipment.unified') }}" class="px-4 py-2 bg-slate-200 text-slate-700 text-sm font-semibold rounded-lg hover:bg-slate-300 transition">Reset</a>
            </div>
        </form>
    </div>

    {{-- ── TABS ────────────────────────────────────────────────────── --}}
    <div x-data="{ tab: '{{ $tab }}' }" class="bg-white rounded-xl shadow-sm border border-slate-200">
        {{-- Tab Nav --}}
        <div class="border-b border-slate-200 px-6">
            <nav class="-mb-px flex gap-1 overflow-x-auto">
                <button @click="tab='general'"
                    :class="tab==='general' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-500 hover:text-slate-700'"
                    class="inline-flex items-center gap-2 px-5 py-4 text-sm font-semibold border-b-2 transition whitespace-nowrap">
                    General Equipment
                    <span class="bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full text-xs">{{ $general->total() }}</span>
                </button>
                <button @click="tab='sports'"
                    :class="tab==='sports' ? 'border-blue-600 text-blue-600' : 'border-transparent text-slate-500 hover:text-slate-700'"
                    class="inline-flex items-center gap-2 px-5 py-4 text-sm font-semibold border-b-2 transition whitespace-nowrap">
                    Sports Equipment
                    <span class="bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full text-xs">{{ $sports->total() }}</span>
                </button>
                <button @click="tab='office'"
                    :class="tab==='office' ? 'border-purple-600 text-purple-600' : 'border-transparent text-slate-500 hover:text-slate-700'"
                    class="inline-flex items-center gap-2 px-5 py-4 text-sm font-semibold border-b-2 transition whitespace-nowrap">
                    Office Equipment
                    <span class="bg-purple-100 text-purple-700 px-2 py-0.5 rounded-full text-xs">{{ $office->total() }}</span>
                </button>
            </nav>
        </div>

        {{-- Per-tab Add Button --}}
        <div class="px-6 py-3 border-b border-slate-100 flex items-center justify-end gap-3 bg-slate-50/50">
            <div x-show="tab==='general'">
                <a href="{{ route('admin.equipment.create') }}"
                    class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-indigo-600 text-white text-xs font-semibold rounded-lg hover:bg-indigo-700 transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add General Equipment
                </a>
            </div>
            <div x-show="tab==='sports'">
                <a href="{{ route('admin.sports-equipment.create') }}"
                    class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-blue-600 text-white text-xs font-semibold rounded-lg hover:bg-blue-700 transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Sports Equipment
                </a>
            </div>
            <div x-show="tab==='office'">
                <a href="{{ route('admin.office-equipment.create') }}"
                    class="inline-flex items-center gap-1.5 px-4 py-1.5 bg-purple-600 text-white text-xs font-semibold rounded-lg hover:bg-purple-700 transition">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add Office Equipment
                </a>
            </div>
        </div>

        {{-- ── GENERAL TAB ──────────────────────────────────────────── --}}
        <div x-show="tab==='general'" x-cloak class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Name</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Category</th>
                        <th class="px-5 py-3 text-center font-semibold text-slate-600">Qty / Avail.</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Condition</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Status</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Branch</th>
                        <th class="px-5 py-3 text-center font-semibold text-slate-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($general as $item)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-5 py-3 font-medium text-slate-800">{{ $item->name }}</td>
                        <td class="px-5 py-3 text-slate-600 capitalize">{{ $item->category }}</td>
                        <td class="px-5 py-3 text-center">
                            <span class="font-semibold">{{ $item->quantity }}</span>
                            <span class="text-slate-400">/</span>
                            <span class="text-green-600 font-semibold">{{ $item->available_quantity }}</span>
                        </td>
                        <td class="px-5 py-3">@include('admin.equipment._condition_badge', ['condition' => $item->condition])</td>
                        <td class="px-5 py-3">@include('admin.equipment._status_badge', ['status' => $item->status])</td>
                        <td class="px-5 py-3 text-slate-600">{{ $item->branch?->name ?? '–' }}</td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.equipment.show', $item) }}" class="text-indigo-600 hover:text-indigo-800 text-xs font-medium">View</a>
                                <a href="{{ route('admin.equipment.edit', $item) }}" class="text-blue-600 hover:text-blue-800 text-xs font-medium">Edit</a>
                                <form action="{{ route('admin.equipment.destroy', $item) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Delete {{ addslashes($item->name) }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="7" class="px-5 py-8 text-center text-slate-400">No general equipment found.</td></tr>
                    @endforelse
                </tbody>
            </table>
            @if($general->hasPages())
            <div class="px-5 py-4 border-t border-slate-200">{{ $general->appends(request()->except('general_page'))->links() }}</div>
            @endif
        </div>

        {{-- ── SPORTS TAB ───────────────────────────────────────────── --}}
        <div x-show="tab==='sports'" x-cloak class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Name</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Type</th>
                        <th class="px-5 py-3 text-center font-semibold text-slate-600">Qty / Avail.</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Condition</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Status</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Branch</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Ref. Code</th>
                        <th class="px-5 py-3 text-center font-semibold text-slate-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($sports as $item)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-5 py-3 font-medium text-slate-800">{{ $item->name }}</td>
                        <td class="px-5 py-3 text-slate-600 capitalize">{{ $item->equipment_type }}</td>
                        <td class="px-5 py-3 text-center">
                            <span class="font-semibold">{{ $item->quantity }}</span>
                            <span class="text-slate-400">/</span>
                            <span class="text-green-600 font-semibold">{{ $item->available_quantity }}</span>
                        </td>
                        <td class="px-5 py-3">@include('admin.equipment._condition_badge', ['condition' => $item->condition])</td>
                        <td class="px-5 py-3">@include('admin.equipment._status_badge', ['status' => $item->status])</td>
                        <td class="px-5 py-3 text-slate-600">{{ $item->branch?->name ?? '–' }}</td>
                        <td class="px-5 py-3 text-slate-500 font-mono text-xs">{{ $item->reference_code ?? '–' }}</td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.sports-equipment.show', $item) }}" class="text-indigo-600 hover:text-indigo-800 text-xs font-medium">View</a>
                                <a href="{{ route('admin.sports-equipment.edit', $item) }}" class="text-blue-600 hover:text-blue-800 text-xs font-medium">Edit</a>
                                <form action="{{ route('admin.sports-equipment.destroy', $item) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Delete {{ addslashes($item->name) }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="px-5 py-8 text-center text-slate-400">No sports equipment found.</td></tr>
                    @endforelse
                </tbody>
            </table>
            @if($sports->hasPages())
            <div class="px-5 py-4 border-t border-slate-200">{{ $sports->appends(request()->except('sports_page'))->links() }}</div>
            @endif
        </div>

        {{-- ── OFFICE TAB ───────────────────────────────────────────── --}}
        <div x-show="tab==='office'" x-cloak class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Name</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Type</th>
                        <th class="px-5 py-3 text-center font-semibold text-slate-600">Qty / Avail.</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Condition</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Status</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Branch</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Warranty</th>
                        <th class="px-5 py-3 text-center font-semibold text-slate-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($office as $item)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-5 py-3 font-medium text-slate-800">{{ $item->name }}</td>
                        <td class="px-5 py-3 text-slate-600 capitalize">{{ $item->equipment_type }}</td>
                        <td class="px-5 py-3 text-center">
                            <span class="font-semibold">{{ $item->quantity }}</span>
                            <span class="text-slate-400">/</span>
                            <span class="text-green-600 font-semibold">{{ $item->available_quantity }}</span>
                        </td>
                        <td class="px-5 py-3">@include('admin.equipment._condition_badge', ['condition' => $item->condition])</td>
                        <td class="px-5 py-3">@include('admin.equipment._status_badge', ['status' => $item->status])</td>
                        <td class="px-5 py-3 text-slate-600">{{ $item->branch?->name ?? '–' }}</td>
                        <td class="px-5 py-3">
                            @if($item->warranty_expiry)
                                @if($item->isWarrantyExpired())
                                    <span class="text-red-600 text-xs font-medium">Expired {{ $item->warranty_expiry->format('d M Y') }}</span>
                                @else
                                    <span class="text-green-600 text-xs font-medium">Until {{ $item->warranty_expiry->format('d M Y') }}</span>
                                @endif
                            @else
                                <span class="text-slate-400 text-xs">–</span>
                            @endif
                        </td>
                        <td class="px-5 py-3">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.office-equipment.show', $item) }}" class="text-indigo-600 hover:text-indigo-800 text-xs font-medium">View</a>
                                <a href="{{ route('admin.office-equipment.edit', $item) }}" class="text-blue-600 hover:text-blue-800 text-xs font-medium">Edit</a>
                                <form action="{{ route('admin.office-equipment.destroy', $item) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Delete {{ addslashes($item->name) }}?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-xs font-medium">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="8" class="px-5 py-8 text-center text-slate-400">No office equipment found.</td></tr>
                    @endforelse
                </tbody>
            </table>
            @if($office->hasPages())
            <div class="px-5 py-4 border-t border-slate-200">{{ $office->appends(request()->except('office_page'))->links() }}</div>
            @endif
        </div>
    </div>

    {{-- ── RECENT REQUESTS ─────────────────────────────────────────── --}}
    @if($recentRequests->count())
    @php $reqStatusColors = ['pending' => 'yellow', 'approved' => 'blue', 'rejected' => 'red', 'fulfilled' => 'green', 'returned' => 'gray']; @endphp
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-base font-bold text-slate-800">Recent Equipment Requests</h3>
            <a href="{{ route('admin.equipment.unified.requests') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">View All →</a>
        </div>
        <div class="space-y-3">
            @foreach($recentRequests as $req)
                @php $reqColor = $reqStatusColors[$req->status] ?? 'gray'; @endphp
                <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                    <div class="min-w-0">
                        <p class="text-sm font-semibold text-slate-800 truncate">{{ $req->equipment_name }}</p>
                        <p class="text-xs text-slate-500">{{ $req->getTrainingLabel() }} &bull; Requested by {{ $req->requestedBy?->name ?? '—' }}</p>
                    </div>
                    <div class="flex items-center gap-3 ml-4 flex-shrink-0">
                        <span class="text-sm font-semibold text-slate-700">×{{ $req->quantity_requested }}</span>
                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-{{ $reqColor }}-100 text-{{ $reqColor }}-700 capitalize">{{ $req->status }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection
