@php($title = 'Training Schedule Equipment')
@extends('layouts.app')

@section('hero')
    <x-hero title="Training Schedule Equipment" subtitle="Equipment requests and reports per training session">
        <div class="mt-4 flex flex-wrap gap-3">
            <a href="{{ route('admin.equipment.unified.requests') }}" class="btn-primary">+ New Request</a>
            <a href="{{ route('admin.equipment.unified') }}" class="btn-secondary">← Equipment Inventory</a>
        </div>
    </x-hero>
@endsection

@section('content')
<div class="space-y-6" x-data="{ view: 'sessions' }">

    {{-- Tab switch --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="flex border-b border-slate-200">
            <button @click="view='sessions'" :class="view==='sessions' ? 'border-indigo-600 text-indigo-600' : 'border-transparent text-slate-500'"
                class="px-6 py-4 text-sm font-semibold border-b-2 transition">
                Training Sessions ({{ $sessions->total() }})
            </button>
            <button @click="view='inhouse'" :class="view==='inhouse' ? 'border-blue-600 text-blue-600' : 'border-transparent text-slate-500'"
                class="px-6 py-4 text-sm font-semibold border-b-2 transition">
                Inhouse Trainings ({{ $inhouse->total() }})
            </button>
        </div>

        {{-- ── Training Sessions ─────────────────────────────────────── --}}
        <div x-show="view==='sessions'" x-cloak class="divide-y divide-slate-100">
            @forelse($sessions as $session)
            <div class="p-5">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-3">
                    <div>
                        <div class="flex flex-wrap items-center gap-2">
                            <h4 class="font-bold text-slate-800">
                                Session #{{ $session->id }}
                                @if($session->group) – {{ $session->group->name }} @endif
                            </h4>
                            <span class="text-xs bg-indigo-100 text-indigo-700 px-2 py-0.5 rounded-full">{{ $session->date?->format('d M Y') ?? '–' }}</span>
                            @if($session->branch)
                            <span class="text-xs bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full">{{ $session->branch->name }}</span>
                            @endif
                        </div>
                        @if($session->coach)
                        <p class="text-xs text-slate-500 mt-1">Coach: {{ $session->coach->name }}</p>
                        @endif
                    </div>
                    <a href="{{ route('admin.equipment.unified.requests') }}?training_type=session&session_id={{ $session->id }}"
                        class="flex-shrink-0 text-xs text-indigo-600 hover:text-indigo-800 font-medium">View requests →</a>
                </div>

                {{-- Equipment Requests for this session --}}
                @if($session->equipmentRequests->count())
                <div class="mt-3 overflow-x-auto">
                    <table class="w-full text-xs">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Equipment</th>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Cat.</th>
                                <th class="px-3 py-2 text-center font-semibold text-slate-600">Req / Appr</th>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Status</th>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Report</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($session->equipmentRequests as $req)
                            <tr class="border-t border-slate-100">
                                <td class="px-3 py-2 font-medium text-slate-700">{{ $req->equipment_name }}</td>
                                <td class="px-3 py-2 text-slate-500 capitalize">{{ $req->equipment_type }}</td>
                                <td class="px-3 py-2 text-center">
                                    {{ $req->quantity_requested }}
                                    @if($req->quantity_approved !== null) / <span class="text-green-600">{{ $req->quantity_approved }}</span> @endif
                                </td>
                                <td class="px-3 py-2">
                                    @php $c = ['pending'=>'yellow','approved'=>'blue','rejected'=>'red','fulfilled'=>'green','returned'=>'gray'][$req->status] ?? 'gray'; @endphp
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-{{ $c }}-100 text-{{ $c }}-700 capitalize">{{ $req->status }}</span>
                                </td>
                                <td class="px-3 py-2">
                                    @if($req->usageReport)
                                        <a href="{{ route('admin.equipment.unified.usage-reports.show', $req->usageReport) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">View</a>
                                    @elseif(in_array($req->status, ['approved','fulfilled']))
                                        <a href="{{ route('admin.equipment.unified.usage-reports.create', $req) }}" class="text-green-600 hover:text-green-800 font-medium">+ Report</a>
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
                <p class="mt-3 text-xs text-slate-400 italic">No equipment requested for this session.</p>
                @endif
            </div>
            @empty
            <div class="p-10 text-center text-slate-400">No training sessions found.</div>
            @endforelse
        </div>
        @if($sessions->hasPages())
        <div class="px-5 py-4 border-t border-slate-200" x-show="view==='sessions'" x-cloak>{{ $sessions->links() }}</div>
        @endif

        {{-- ── Inhouse Trainings ─────────────────────────────────────── --}}
        <div x-show="view==='inhouse'" x-cloak class="divide-y divide-slate-100">
            @forelse($inhouse as $training)
            <div class="p-5">
                <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-3">
                    <div>
                        <div class="flex flex-wrap items-center gap-2">
                            <h4 class="font-bold text-slate-800">{{ $training->training_name ?? 'Inhouse Training #'.$training->id }}</h4>
                            <span class="text-xs bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full">{{ $training->training_date?->format('d M Y') ?? '–' }}</span>
                            @if($training->branch)
                            <span class="text-xs bg-slate-100 text-slate-600 px-2 py-0.5 rounded-full">{{ $training->branch->name }}</span>
                            @endif
                        </div>
                        @if($training->trainer_name)
                        <p class="text-xs text-slate-500 mt-1">Trainer: {{ $training->trainer_name }}</p>
                        @endif
                    </div>
                </div>

                @if($training->equipmentRequests->count())
                <div class="mt-3 overflow-x-auto">
                    <table class="w-full text-xs">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Equipment</th>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Cat.</th>
                                <th class="px-3 py-2 text-center font-semibold text-slate-600">Req / Appr</th>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Status</th>
                                <th class="px-3 py-2 text-left font-semibold text-slate-600">Report</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($training->equipmentRequests as $req)
                            <tr class="border-t border-slate-100">
                                <td class="px-3 py-2 font-medium text-slate-700">{{ $req->equipment_name }}</td>
                                <td class="px-3 py-2 text-slate-500 capitalize">{{ $req->equipment_type }}</td>
                                <td class="px-3 py-2 text-center">
                                    {{ $req->quantity_requested }}
                                    @if($req->quantity_approved !== null) / <span class="text-green-600">{{ $req->quantity_approved }}</span> @endif
                                </td>
                                <td class="px-3 py-2">
                                    @php $c = ['pending'=>'yellow','approved'=>'blue','rejected'=>'red','fulfilled'=>'green','returned'=>'gray'][$req->status] ?? 'gray'; @endphp
                                    <span class="px-2 py-0.5 rounded-full text-xs font-semibold bg-{{ $c }}-100 text-{{ $c }}-700 capitalize">{{ $req->status }}</span>
                                </td>
                                <td class="px-3 py-2">
                                    @if($req->usageReport)
                                        <a href="{{ route('admin.equipment.unified.usage-reports.show', $req->usageReport) }}" class="text-indigo-600 hover:text-indigo-800 font-medium">View</a>
                                    @elseif(in_array($req->status, ['approved','fulfilled']))
                                        <a href="{{ route('admin.equipment.unified.usage-reports.create', $req) }}" class="text-green-600 hover:text-green-800 font-medium">+ Report</a>
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
                <p class="mt-3 text-xs text-slate-400 italic">No equipment requested for this training.</p>
                @endif
            </div>
            @empty
            <div class="p-10 text-center text-slate-400">No inhouse trainings found.</div>
            @endforelse
        </div>
        @if($inhouse->hasPages())
        <div class="px-5 py-4 border-t border-slate-200" x-show="view==='inhouse'" x-cloak>{{ $inhouse->links() }}</div>
        @endif
    </div>

</div>
@endsection
