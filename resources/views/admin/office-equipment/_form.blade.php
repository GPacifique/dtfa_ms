<!-- Basic Information -->
<div>
    <h3 class="text-lg font-bold text-slate-900 mb-4">Basic Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Equipment Name *</label>
            <input type="text" name="name" value="{{ old('name', $office_equipment->name ?? '') }}" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror">
            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Description</label>
            <textarea name="description" rows="3" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror">{{ old('description', $office_equipment->description ?? '') }}</textarea>
            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Equipment Type *</label>
            <input type="text" name="equipment_type" value="{{ old('equipment_type', $office_equipment->equipment_type ?? '') }}" placeholder="e.g., computers, furniture, appliances" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('equipment_type') border-red-500 @enderror">
            @error('equipment_type')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Branch *</label>
            <select name="branch_id" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('branch_id') border-red-500 @enderror">
                <option value="">Select Branch</option>
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}" @selected(old('branch_id', $office_equipment->branch_id ?? null) == $branch->id)>{{ $branch->name }}</option>
                @endforeach
            </select>
            @error('branch_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<!-- Inventory -->
<div>
    <h3 class="text-lg font-bold text-slate-900 mb-4">Inventory</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Total Quantity *</label>
            <input type="number" name="quantity" value="{{ old('quantity', $office_equipment->quantity ?? 1) }}" min="1" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('quantity') border-red-500 @enderror">
            @error('quantity')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Available Quantity *</label>
            <input type="number" name="available_quantity" value="{{ old('available_quantity', $office_equipment->available_quantity ?? 1) }}" min="0" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('available_quantity') border-red-500 @enderror">
            @error('available_quantity')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Condition *</label>
            <select name="condition" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('condition') border-red-500 @enderror">
                <option value="">Select Condition</option>
                <option value="excellent" @selected(old('condition', $office_equipment->condition ?? null) === 'excellent')>Excellent</option>
                <option value="good" @selected(old('condition', $office_equipment->condition ?? null) === 'good')>Good</option>
                <option value="fair" @selected(old('condition', $office_equipment->condition ?? null) === 'fair')>Fair</option>
                <option value="poor" @selected(old('condition', $office_equipment->condition ?? null) === 'poor')>Poor</option>
                <option value="damaged" @selected(old('condition', $office_equipment->condition ?? null) === 'damaged')>Damaged</option>
            </select>
            @error('condition')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Status *</label>
            <select name="status" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('status') border-red-500 @enderror">
                <option value="">Select Status</option>
                <option value="available" @selected(old('status', $office_equipment->status ?? null) === 'available')>Available</option>
                <option value="in_use" @selected(old('status', $office_equipment->status ?? null) === 'in_use')>In Use</option>
                <option value="maintenance" @selected(old('status', $office_equipment->status ?? null) === 'maintenance')>Maintenance</option>
                <option value="retired" @selected(old('status', $office_equipment->status ?? null) === 'retired')>Retired</option>
                <option value="lost" @selected(old('status', $office_equipment->status ?? null) === 'lost')>Lost</option>
            </select>
            @error('status')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<!-- Purchase Information -->
<div>
    <h3 class="text-lg font-bold text-slate-900 mb-4">Purchase Information</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Purchase Price *</label>
            <input type="number" name="purchase_price" value="{{ old('purchase_price', $office_equipment->purchase_price ?? '') }}" step="0.01" min="0" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('purchase_price') border-red-500 @enderror">
            @error('purchase_price')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Purchase Date *</label>
            <input type="date" name="purchase_date" value="{{ old('purchase_date', isset($office_equipment) && $office_equipment?->purchase_date ? $office_equipment->purchase_date->format('Y-m-d') : '') }}" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('purchase_date') border-red-500 @enderror">
            @error('purchase_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Replacement Cost</label>
            <input type="number" name="replacement_cost" value="{{ old('replacement_cost', $office_equipment->replacement_cost ?? '') }}" step="0.01" min="0" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('replacement_cost') border-red-500 @enderror">
            @error('replacement_cost')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Supplier</label>
            <input type="text" name="supplier" value="{{ old('supplier', $office_equipment->supplier ?? '') }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('supplier') border-red-500 @enderror">
            @error('supplier')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<!-- Assignment & Warranty -->
<div>
    <h3 class="text-lg font-bold text-slate-900 mb-4">Assignment & Warranty</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Location *</label>
            <input type="text" name="location" value="{{ old('location', $office_equipment->location ?? '') }}" required class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('location') border-red-500 @enderror">
            @error('location')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Assigned To</label>
            <input type="text" name="assigned_to" value="{{ old('assigned_to', $office_equipment->assigned_to ?? '') }}" placeholder="Person or Department" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('assigned_to') border-red-500 @enderror">
            @error('assigned_to')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Warranty Expiry</label>
            <input type="date" name="warranty_expiry" value="{{ old('warranty_expiry', isset($office_equipment) && $office_equipment?->warranty_expiry ? $office_equipment->warranty_expiry->format('Y-m-d') : '') }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('warranty_expiry') border-red-500 @enderror">
            @error('warranty_expiry')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Reference Code</label>
            <input type="text" name="reference_code" value="{{ old('reference_code', $office_equipment->reference_code ?? '') }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('reference_code') border-red-500 @enderror">
            @error('reference_code')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<!-- Maintenance -->
<div>
    <h3 class="text-lg font-bold text-slate-900 mb-4">Maintenance</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Maintenance Date</label>
            <input type="date" name="maintenance_date" value="{{ old('maintenance_date', isset($office_equipment) && $office_equipment?->maintenance_date ? $office_equipment->maintenance_date->format('Y-m-d') : '') }}" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('maintenance_date') border-red-500 @enderror">
            @error('maintenance_date')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-slate-700 mb-2">Maintenance Notes</label>
            <textarea name="maintenance_notes" rows="3" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('maintenance_notes') border-red-500 @enderror">{{ old('maintenance_notes', $office_equipment->maintenance_notes ?? '') }}</textarea>
            @error('maintenance_notes')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<!-- Additional Notes -->
<div>
    <h3 class="text-lg font-bold text-slate-900 mb-4">Additional Notes</h3>
    <div class="grid grid-cols-1 gap-6">
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">Notes</label>
            <textarea name="notes" rows="3" class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('notes') border-red-500 @enderror">{{ old('notes', $office_equipment->notes ?? '') }}</textarea>
            @error('notes')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
