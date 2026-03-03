@php($title = 'Usage Report Details')
@extends('layouts.app')

@section('hero')
    <x-hero title="Usage Report #{{ $report->id }}" subtitle="Equipment usage record after training">
        <div class="mt-4 flex gap-3">
            <a href="{{ route('admin.equipment.unified.usage-reports') }}" class="btn-secondary">← All Reports</a>
        </div>
    </x-hero>
@endsection

@section('content')
<div class="max-w-3xl mx-auto space-y-6">

    {{-- Header Info --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Training</h3>
                @if($report->trainingSession)
                    <p class="font-bold text-slate-800">Training Session #{{ $report->training_session_id }}</p>
                    <p class="text-sm text-slate-600">{{ $report->trainingSession->date?->format('d M Y') }}</p>
                    @if($report->trainingSession->branch)
                    <p class="text-sm text-slate-500">{{ $report->trainingSession->branch->name }}</p>
                    @endif
                @elseif($report->inhouseTraining)
                    <p class="font-bold text-slate-800">{{ $report->inhouseTraining->training_name }}</p>
                    <p class="text-sm text-slate-600">{{ $report->inhouseTraining->training_date?->format('d M Y') }}</p>
                @else
                    <p class="text-slate-500">—</p>
                @endif
            </div>
            <div>
                <h3 class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-3">Equipment</h3>
                <p class="font-bold text-slate-800">{{ $report->equipment_name }}</p>
                <p class="text-sm text-slate-500 capitalize">Category: {{ $report->equipment_type }}</p>
                <div class="mt-2">@include('admin.equipment._condition_badge', ['condition' => $report->equipment_condition_after])</div>
            </div>
        </div>
    </div>

    {{-- Quantities --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 text-center">
            <p class="text-3xl font-bold text-blue-700">{{ $report->quantity_used }}</p>
            <p class="text-xs text-blue-600 mt-1 font-semibold">Used</p>
        </div>
        <div class="bg-green-50 border border-green-200 rounded-xl p-4 text-center">
            <p class="text-3xl font-bold text-green-700">{{ $report->quantity_returned }}</p>
            <p class="text-xs text-green-600 mt-1 font-semibold">Returned</p>
        </div>
        <div class="bg-orange-50 border border-orange-200 rounded-xl p-4 text-center">
            <p class="text-3xl font-bold text-orange-700">{{ $report->quantity_damaged }}</p>
            <p class="text-xs text-orange-600 mt-1 font-semibold">Damaged</p>
        </div>
        <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center">
            <p class="text-3xl font-bold text-red-700">{{ $report->quantity_lost }}</p>
            <p class="text-xs text-red-600 mt-1 font-semibold">Lost</p>
        </div>
    </div>

    {{-- Narrative --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6 space-y-5">
        @if($report->usage_summary)
        <div>
            <h3 class="text-sm font-bold text-slate-700 mb-2">Usage Summary</h3>
            <p class="text-sm text-slate-600 leading-relaxed">{{ $report->usage_summary }}</p>
        </div>
        @endif

        @if($report->issues_encountered)
        <div>
            <h3 class="text-sm font-bold text-orange-700 mb-2">Issues Encountered</h3>
            <p class="text-sm text-slate-600 leading-relaxed bg-orange-50 p-3 rounded-lg">{{ $report->issues_encountered }}</p>
        </div>
        @endif

        @if($report->recommendations)
        <div>
            <h3 class="text-sm font-bold text-indigo-700 mb-2">Recommendations</h3>
            <p class="text-sm text-slate-600 leading-relaxed bg-indigo-50 p-3 rounded-lg">{{ $report->recommendations }}</p>
        </div>
        @endif
    </div>

    {{-- Footer --}}
    <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 flex flex-col md:flex-row md:items-center justify-between gap-3 text-sm text-slate-600">
        <p>Reported by <span class="font-semibold text-slate-800">{{ $report->reportedBy?->name ?? '—' }}</span></p>
        <p>{{ $report->reported_at?->format('d M Y, H:i') ?? $report->created_at->format('d M Y, H:i') }}</p>
    </div>

</div>
@endsection
