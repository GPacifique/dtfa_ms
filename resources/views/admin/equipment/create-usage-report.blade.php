@php($title = 'Submit Usage Report')
@extends('layouts.app')

@section('hero')
    <x-hero title="Submit Usage Report" subtitle="Record equipment usage after training">
        <div class="mt-4">
            <a href="{{ route('admin.equipment.unified.usage-reports') }}" class="btn-secondary">← Usage Reports</a>
        </div>
    </x-hero>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-5">
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    {{-- Request Info Card --}}
    <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-5 mb-6">
        <h3 class="text-sm font-bold text-indigo-800 mb-3">Equipment Request Details</h3>
        <div class="grid grid-cols-2 gap-3 text-sm">
            <div>
                <span class="text-indigo-600 font-semibold">Training:</span>
                <p class="text-indigo-900">{{ $equipmentRequest->getTrainingLabel() }}</p>
            </div>
            <div>
                <span class="text-indigo-600 font-semibold">Equipment:</span>
                <p class="text-indigo-900">{{ $equipmentRequest->equipment_name }}</p>
            </div>
            <div>
                <span class="text-indigo-600 font-semibold">Approved Qty:</span>
                <p class="text-indigo-900 font-bold">{{ $equipmentRequest->quantity_approved ?? $equipmentRequest->quantity_requested }}</p>
            </div>
            <div>
                <span class="text-indigo-600 font-semibold">Purpose:</span>
                <p class="text-indigo-900">{{ $equipmentRequest->purpose ?? '—' }}</p>
            </div>
        </div>
    </div>

    {{-- Report Form --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <h3 class="text-base font-bold text-slate-800 mb-5">Post-Training Report</h3>
        <form action="{{ route('admin.equipment.unified.usage-reports.store', $equipmentRequest) }}" method="POST" class="space-y-5">
            @csrf

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Quantity Used <span class="text-red-500">*</span></label>
                    <input type="number" name="quantity_used" min="0" required value="{{ old('quantity_used', $equipmentRequest->quantity_approved ?? $equipmentRequest->quantity_requested) }}"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Quantity Returned <span class="text-red-500">*</span></label>
                    <input type="number" name="quantity_returned" min="0" required value="{{ old('quantity_returned', 0) }}"
                        class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Quantity Damaged <span class="text-red-500">*</span></label>
                    <input type="number" name="quantity_damaged" min="0" required value="{{ old('quantity_damaged', 0) }}"
                        class="w-full px-4 py-2 border border-orange-300 rounded-lg focus:ring-2 focus:ring-orange-400">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Quantity Lost <span class="text-red-500">*</span></label>
                    <input type="number" name="quantity_lost" min="0" required value="{{ old('quantity_lost', 0) }}"
                        class="w-full px-4 py-2 border border-red-300 rounded-lg focus:ring-2 focus:ring-red-400">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Equipment Condition After Use <span class="text-red-500">*</span></label>
                <select name="equipment_condition_after" required
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    @foreach(['excellent','good','fair','poor','damaged'] as $c)
                    <option value="{{ $c }}" @selected(old('equipment_condition_after')===$c)>{{ ucfirst($c) }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Usage Summary</label>
                <textarea name="usage_summary" rows="3" placeholder="How was the equipment used? General observations…"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 resize-none">{{ old('usage_summary') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Issues Encountered</label>
                <textarea name="issues_encountered" rows="3" placeholder="Any problems or damage noted during use?"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 resize-none">{{ old('issues_encountered') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Recommendations</label>
                <textarea name="recommendations" rows="2" placeholder="Maintenance needs, replacement suggestions…"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 resize-none">{{ old('recommendations') }}</textarea>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <a href="{{ route('admin.equipment.unified.usage-reports') }}"
                    class="px-5 py-2 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition">Cancel</a>
                <button type="submit"
                    class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">Submit Report</button>
            </div>
        </form>
    </div>
</div>
@endsection
