@php $title = 'Training Schedule Equipment'; @endphp
@extends('layouts.app')

@section('hero')
    <x-hero title="Training Schedule Equipment" subtitle="Equipment requests and reports per training record">
        <div class="mt-4 flex flex-wrap gap-3">
            <a href="{{ route('admin.equipment.unified.requests') }}" class="btn-primary">+ New Request</a>
            <a href="{{ route('admin.equipment.unified') }}" class="btn-secondary">← Equipment Inventory</a>
        </div>
    </x-hero>
@endsection

@section('content')
<div class="space-y-6">

    @php $reqStatusColors = ['pending'=>'yellow','approved'=>'blue','rejected'=>'red','fulfilled'=>'green','returned'=>'gray']; @endphp

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-5 border-b border-slate-200 flex items-center justify-between">
            <h3 class="text-base font-bold text-slate-800">Training Records ({{ $records->total() }})</h3>
            <a href="{{ route('admin.equipment.unified.requests') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">+ New Equipment Request</a>
        </div>

        <div class="divide-y divide-slate-100">
            @forelse($records as $record)
            <div class="p-5">
                {{-- Record header --}}
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-3">
                    <div>
                        <div class="flex flex-wrap items-center gap-2">
                            <h4 class="font-bold text-slate-800">Record #{{ $record->id }}</h4>
                            @if($record->date)
                            <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full">{{ $record->date->format('d M Y') }}</span>
                            @endif
                            @if($record->branch)
                            <span class="text-xs bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full">{{ $record->branch }}</span>
                            @endif
                            @if($record->status)
                            <span class="text-xs px-2 py-0.5 rounded-full font-medium
                                {{ $record->status === 'completed' ? 'bg-green-100 text-green-700' : ($record->status === 'in_progress' ? 'bg-blue-100 text-blue-700' : 'bg-slate-100 text-slate-600') }} capitalize">
                                {{ str_replace('_', ' ', $record->status) }}
                            </span>
                            @endif
                        </div>
                        @if($record->main_topic)
                        <p class="text-sm text-slate-600 mt-1">{{ $record->main_topic }}</p>
                        @endif
                        @if($record->coach_name)
                        <p class="text-xs text-slate-500 mt-0.5">Coach: {{ $record->coach_name }}</p>
                        @endif
                    </div>
                    <a href="{{ route('admin.equipment.unified.requests') }}?training_record_id={{ $record->id }}"
                        class="flex-shrink-0 text-xs text-indigo-600 hover:text-indigo-800 font-medium">
                        View all requests →
                    </a>
                </div>

                {{-- Equipment requests for this record --}}
                @if($record->equipmentRequests->count())
                <div class="mt-4 overflow-x-auto rounded-lg border border-slate-200">
                    <table class="w-full text-xs">
                        <thead class="bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Equipment</th>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Category</th>
                                <th class="px-3 py-2 text-center font-semibold text-slate-600">Req / Appr</th>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Status</th>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Purpose</th>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Report</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-50">
                            @foreach($record->equipmentRequests as $req)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-3 py-2 font-medium text-slate-700">{{ $req->equipment_name }}</td>
                                <td class="px-3 py-2">
                                    <span class="px-2 py-0.5 rounded text-xs font-medium
                                        {{ $req->equipment_type === 'sports' ? 'bg-blue-100 text-blue-700' : ($req->equipment_type === 'office' ? 'bg-purple-100 text-purple-700' : 'bg-indigo-100 text-indigo-700') }} capitalize">
                                        {{ $req->equipment_type }}
                                    </span>
                                </td>
                                <td class="px-3 py-2 text-center">
                                    <span class="font-semibold text-slate-700">{{ $req->quantity_requested }}</span>
                                    @if($req->quantity_approved !== null)
                                        <span class="text-slate-400"> / </span>
                                        <span class="text-green-600 font-semibold">{{ $req->quantity_approved }}</span>
                                    @endif
                                </td>
                                <td class="px-3 py-2">
                                    @php $sc = $reqStatusColors[$req->status] ?? 'gray'; @endphp
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-{{ $sc }}-100 text-{{ $sc }}-700 capitalize">{{ $req->status }}</span>
                                </td>
                                <td class="px-3 py-2 text-slate-500 max-w-[160px] truncate">{{ $req->purpose ?? '—' }}</td>
                                <td class="px-3 py-2">
                                    @if($req->usageReport)
                                        <a href="{{ route('admin.equipment.unified.usage-reports.show', $req->usageReport) }}"
                                            class="text-indigo-600 hover:text-indigo-800 font-medium">View Report</a>
                                    @elseif(in_array($req->status, ['approved', 'fulfilled']))
                                        <a href="{{ route('admin.equipment.unified.usage-reports.create', $req) }}"
                                            class="text-green-600 hover:text-green-800 font-medium">+ Report</a>
                                    @else
                                        <span class="text-slate-400">—</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <p class="mt-3 text-xs text-slate-400 italic">No equipment requested for this training record.
                    <a href="{{ route('admin.equipment.unified.requests') }}" class="text-indigo-500 hover:text-indigo-700 ml-1">Request equipment →</a>
                </p>
                @endif
            </div>
            @empty
            <div class="p-10 text-center text-slate-400">
                <p class="text-lg font-semibold mb-2">No training records found</p>
                <p class="text-sm">Training session records will appear here once created.</p>
            </div>
            @endforelse
        </div>

        @if($records->hasPages())
        <div class="px-5 py-4 border-t border-slate-200">{{ $records->links() }}</div>
        @endif
    </div>

</div>
@endsection
