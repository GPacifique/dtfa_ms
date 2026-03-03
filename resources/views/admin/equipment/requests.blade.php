@php $title = 'Equipment Requests'; @endphp
@extends('layouts.app')

@section('hero')
    <x-hero title="Equipment Requests" subtitle="Manage equipment requested for training schedules">
        <div class="mt-4 flex flex-wrap gap-3">
            <button onclick="document.getElementById('new-request-modal').classList.remove('hidden')" class="btn-primary">
                + New Request
            </button>
            <a href="{{ route('admin.equipment.unified') }}" class="btn-secondary">← Equipment Inventory</a>
        </div>
    </x-hero>
@endsection

@section('content')
<div class="space-y-6">

    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">{{ session('success') }}</div>
    @endif
    @if(session('info'))
        <div class="bg-blue-50 border border-blue-200 text-blue-800 px-4 py-3 rounded-lg">{{ session('info') }}</div>
    @endif
    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg">
            <ul class="list-disc list-inside text-sm space-y-1">
                @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
            </ul>
        </div>
    @endif

    {{-- ── FILTERS ─────────────────────────────────────────────────── --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-4">
        <form method="GET" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Status</label>
                <select name="status" class="px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Status</option>
                    @foreach(['pending','approved','rejected','fulfilled','returned'] as $s)
                        <option value="{{ $s }}" @selected(request('status')===$s)>{{ ucfirst($s) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-slate-600 mb-1">Equipment Category</label>
                <select name="equipment_type" class="px-3 py-2 text-sm border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="">All Categories</option>
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
            <a href="{{ route('admin.equipment.unified.requests') }}" class="px-5 py-2 bg-slate-200 text-slate-700 text-sm font-semibold rounded-lg hover:bg-slate-300 transition">Reset</a>
        </form>
    </div>

    {{-- ── REQUESTS TABLE ──────────────────────────────────────────── --}}
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-5 border-b border-slate-200 flex items-center justify-between">
            <h3 class="text-base font-bold text-slate-800">Equipment Requests ({{ $requests->total() }})</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-slate-600">#</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-600">Training</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-600">Equipment</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-600">Type</th>
                        <th class="px-4 py-3 text-center font-semibold text-slate-600">Req. / Appr.</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-600">Status</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-600">Requested By</th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-600">Date</th>
                        <th class="px-4 py-3 text-center font-semibold text-slate-600">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @php $reqColors = ['pending'=>'yellow','approved'=>'blue','rejected'=>'red','fulfilled'=>'green','returned'=>'gray']; @endphp
                    @forelse($requests as $req)
                    @php $reqC = $reqColors[$req->status] ?? 'gray'; @endphp
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 py-3 text-slate-500 text-xs">{{ $req->id }}</td>
                        <td class="px-4 py-3">
                            <p class="font-medium text-slate-800 text-xs">{{ $req->getTrainingLabel() }}</p>
                            @if($req->purpose)
                            <p class="text-slate-400 text-xs truncate max-w-[180px]">{{ $req->purpose }}</p>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium text-slate-800">{{ $req->equipment_name }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-0.5 rounded text-xs font-medium {{ $req->equipment_type === 'sports' ? 'bg-blue-100 text-blue-700' : ($req->equipment_type === 'office' ? 'bg-purple-100 text-purple-700' : 'bg-indigo-100 text-indigo-700') }} capitalize">
                                {{ $req->equipment_type }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="font-semibold text-slate-700">{{ $req->quantity_requested }}</span>
                            @if($req->quantity_approved !== null)
                                <span class="text-slate-400"> / </span>
                                <span class="font-semibold text-green-600">{{ $req->quantity_approved }}</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-2.5 py-0.5 rounded-full text-xs font-semibold bg-{{ $reqC }}-100 text-{{ $reqC }}-700 capitalize">{{ $req->status }}</span>
                        </td>
                        <td class="px-4 py-3 text-slate-600 text-xs">{{ $req->requestedBy?->name ?? '—' }}</td>
                        <td class="px-4 py-3 text-slate-500 text-xs">{{ $req->created_at->format('d M Y') }}</td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-center gap-2">
                                {{-- Approve / Reject --}}
                                @if($req->status === 'pending')
                                <button onclick="openApproveModal({{ $req->id }}, {{ $req->quantity_requested }})"
                                    class="text-green-600 hover:text-green-800 text-xs font-medium">Approve</button>
                                <form action="{{ route('admin.equipment.unified.requests.reject', $req) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <button type="submit" class="text-red-600 hover:text-red-800 text-xs font-medium"
                                        onclick="return confirm('Reject this request?')">Reject</button>
                                </form>
                                @endif
                                {{-- Submit usage report --}}
                                @if(in_array($req->status, ['approved','fulfilled']) && !$req->usageReport)
                                <a href="{{ route('admin.equipment.unified.usage-reports.create', $req) }}"
                                    class="text-indigo-600 hover:text-indigo-800 text-xs font-medium">+ Report</a>
                                @elseif($req->usageReport)
                                <a href="{{ route('admin.equipment.unified.usage-reports.show', $req->usageReport) }}"
                                    class="text-slate-500 hover:text-slate-700 text-xs font-medium">View Report</a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="9" class="px-5 py-10 text-center text-slate-400">No equipment requests found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($requests->hasPages())
        <div class="px-5 py-4 border-t border-slate-200">{{ $requests->links() }}</div>
        @endif
    </div>

</div>

{{-- ══ NEW REQUEST MODAL ════════════════════════════════════════════ --}}
<div id="new-request-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b border-slate-200">
            <h2 class="text-lg font-bold text-slate-800">New Equipment Request</h2>
            <button onclick="document.getElementById('new-request-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form action="{{ route('admin.equipment.unified.requests.store') }}" method="POST" class="p-6 space-y-5">
            @csrf
            {{-- Training Record Select --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Training Record <span class="text-red-500">*</span></label>
                <select name="training_record_id" required
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="">Select training record…</option>
                    @foreach($trainingRecords as $record)
                    <option value="{{ $record->id }}" @selected(old('training_record_id') == $record->id)>
                        #{{ $record->id }}
                        &ndash; {{ $record->date?->format('d M Y') ?? 'No date' }}
                        @if($record->main_topic) &ndash; {{ Str::limit($record->main_topic, 40) }} @endif
                        @if($record->branch) ({{ $record->branch }}) @endif
                    </option>
                    @endforeach
                </select>
            </div>
            {{-- Equipment Type --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Equipment Category <span class="text-red-500">*</span></label>
                <select name="equipment_type" id="modal_equipment_type" onchange="updateEquipmentList()" required
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="">Select category…</option>
                    <option value="general">General Equipment</option>
                    <option value="sports">Sports Equipment</option>
                    <option value="office">Office Equipment</option>
                </select>
            </div>
            {{-- Equipment Item --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Equipment Item <span class="text-red-500">*</span></label>
                <select name="equipment_id" id="modal_equipment_id" required
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                    <option value="">Select equipment category first…</option>
                </select>
            </div>
            {{-- Quantity --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Quantity Requested <span class="text-red-500">*</span></label>
                <input type="number" name="quantity_requested" min="1" required value="{{ old('quantity_requested', 1) }}"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
            </div>
            {{-- Purpose --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Purpose</label>
                <textarea name="purpose" rows="2" placeholder="Why is this equipment needed?"
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 resize-none">{{ old('purpose') }}</textarea>
            </div>
            {{-- Notes --}}
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Notes</label>
                <textarea name="notes" rows="2" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 resize-none">{{ old('notes') }}</textarea>
            </div>
            <div class="flex justify-end gap-3 pt-2">
                <button type="button" onclick="document.getElementById('new-request-modal').classList.add('hidden')"
                    class="px-5 py-2 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition">Cancel</button>
                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-700 transition">Submit Request</button>
            </div>
        </form>
    </div>
</div>

{{-- ══ APPROVE MODAL ════════════════════════════════════════════════ --}}
<div id="approve-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <div class="flex items-center justify-between p-6 border-b border-slate-200">
            <h2 class="text-lg font-bold text-slate-800">Approve Request</h2>
            <button onclick="document.getElementById('approve-modal').classList.add('hidden')" class="text-slate-400 hover:text-slate-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <form id="approve-form" method="POST" class="p-6 space-y-4">
            @csrf @method('PATCH')
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Quantity to Approve <span class="text-red-500">*</span></label>
                <input type="number" name="quantity_approved" id="approve-qty" min="0" required
                    class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
                <p class="text-xs text-slate-500 mt-1">Set to 0 to reject.</p>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Notes</label>
                <textarea name="notes" rows="2" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 resize-none"></textarea>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="document.getElementById('approve-modal').classList.add('hidden')"
                    class="px-5 py-2 bg-slate-200 text-slate-700 font-semibold rounded-lg hover:bg-slate-300 transition">Cancel</button>
                <button type="submit" class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition">Confirm</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Equipment data map for modal
    const equipmentData = {
        general: @json($allEquipment['general']),
        sports:  @json($allEquipment['sports']),
        office:  @json($allEquipment['office']),
    };

    function updateEquipmentList() {
        const type   = document.getElementById('modal_equipment_type').value;
        const select = document.getElementById('modal_equipment_id');
        select.innerHTML = '<option value="">Select item…</option>';
        if (!type) return;
        const items = Array.isArray(equipmentData[type])
            ? equipmentData[type]
            : Object.values(equipmentData[type] || {});
        if (!items.length) {
            select.innerHTML = '<option value="">No equipment available for this category</option>';
            return;
        }
        items.forEach(item => {
            const opt = document.createElement('option');
            opt.value = item.id;
            opt.textContent = `${item.name} (Available: ${item.available_quantity})`;
            if (item.status !== 'available' || item.available_quantity < 1) opt.disabled = true;
            select.appendChild(opt);
        });
    }

    function openApproveModal(id, maxQty) {
        const form = document.getElementById('approve-form');
        form.action = `/admin/equipment/requests/${id}/approve`;
        document.getElementById('approve-qty').value = maxQty;
        document.getElementById('approve-qty').max = maxQty;
        document.getElementById('approve-modal').classList.remove('hidden');
    }

    // Auto open modal if validation failed
    @if($errors->any())
    document.getElementById('new-request-modal').classList.remove('hidden');
    @endif
</script>
@endpush
@endsection
