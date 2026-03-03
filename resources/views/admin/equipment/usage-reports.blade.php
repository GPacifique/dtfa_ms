@php $title = 'Equipment Usage Reports'; @endphp
@extends('layouts.app')

@section('hero')
    <x-hero title="Equipment Usage Reports" subtitle="Post-training equipment usage records">
        <div class="mt-4 flex gap-3">
            <a href="{{ route('admin.equipment.unified.requests') }}" class="btn-secondary">← Equipment Requests</a>
        </div>
    </x-hero>
@endsection

@section('content')
<div class="space-y-6">

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">{{ session('success') }}</div>
    @endif

    {{-- Filter --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
        <form method="GET" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Equipment Category</label>
                <select name="equipment_type" class="px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="">All</option>
                    <option value="general" @selected(request('equipment_type')==='general')>General</option>
                    <option value="sports" @selected(request('equipment_type')==='sports')>Sports</option>
                    <option value="office" @selected(request('equipment_type')==='office')>Office</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Training Record</label>
                <select name="training_record_id" class="px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Records</option>
                    @foreach($trainingRecords as $record)
                        <option value="{{ $record->id }}" @selected(request('training_record_id')==$record->id)>
                            #{{ $record->id }} – {{ $record->date?->format('d M Y') ?? 'No date' }}
                            @if($record->main_topic) – {{ Str::limit($record->main_topic, 30) }} @endif
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="px-5 py-2 bg-indigo-600 text-white text-sm font-semibold rounded-lg hover:bg-indigo-700 transition">Filter</button>
            <a href="{{ route('admin.equipment.unified.usage-reports') }}" class="px-5 py-2 bg-slate-200 text-slate-700 text-sm font-semibold rounded-lg hover:bg-slate-300 transition">Reset</a>
        </form>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-5 border-b border-slate-200">
            <h3 class="text-base font-bold text-slate-800">All Usage Reports ({{ $reports->total() }})</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-slate-600">Training</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-600">Equipment</th>
                        <th class="px-4 py-3 text-center font-semibold text-slate-600">Used</th>
                        <th class="px-4 py-3 text-center font-semibold text-slate-600">Returned</th>
                        <th class="px-4 py-3 text-center font-semibold text-slate-600">Damaged</th>
                        <th class="px-4 py-3 text-center font-semibold text-slate-600">Lost</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-600">Condition After</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-600">Reported By</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-600">Date</th>
                        <th class="px-4 py-3 text-center font-semibold text-slate-600">View</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($reports as $report)
                    <tr class="hover:bg-slate-50 transition {{ $report->hasLosses() ? 'bg-red-50/30' : '' }}">
                        <td class="px-4 py-3">
                            <p class="text-xs font-medium text-slate-700">
                                @if($report->trainingRecord)
                                    Record #{{ $report->training_record_id }}
                                    @if($report->trainingRecord->date) ({{ $report->trainingRecord->date->format('d M Y') }}) @endif
                                    @if($report->trainingRecord->main_topic)
                                        <br><span class="text-slate-400">{{ Str::limit($report->trainingRecord->main_topic, 40) }}</span>
                                    @endif
                                @else
                                    <span class="text-slate-400">—</span>
                                @endif
                            </p>
                        </td>
                        <td class="px-4 py-3 font-medium text-slate-800">{{ $report->equipment_name }}</td>
                        <td class="px-4 py-3 text-center font-semibold text-slate-700">{{ $report->quantity_used }}</td>
                        <td class="px-4 py-3 text-center text-green-600 font-semibold">{{ $report->quantity_returned }}</td>
                        <td class="px-4 py-3 text-center {{ $report->quantity_damaged > 0 ? 'text-orange-600 font-semibold' : 'text-slate-400' }}">{{ $report->quantity_damaged }}</td>
                        <td class="px-4 py-3 text-center {{ $report->quantity_lost > 0 ? 'text-red-600 font-semibold' : 'text-slate-400' }}">{{ $report->quantity_lost }}</td>
                        <td class="px-4 py-3">@include('admin.equipment._condition_badge', ['condition' => $report->equipment_condition_after])</td>
                        <td class="px-4 py-3 text-slate-600 text-xs">{{ $report->reportedBy?->name ?? '—' }}</td>
                        <td class="px-4 py-3 text-slate-500 text-xs">{{ $report->reported_at?->format('d M Y') ?? $report->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('admin.equipment.unified.usage-reports.show', $report) }}" class="text-indigo-600 hover:text-indigo-800 text-xs font-medium">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="10" class="px-5 py-10 text-center text-slate-400">No usage reports found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($reports->hasPages())
        <div class="px-5 py-4 border-t border-slate-200">{{ $reports->links() }}</div>
        @endif
    </div>

</div>
@endsection
