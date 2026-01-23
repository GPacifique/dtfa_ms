@extends('layouts.app')

@section('hero')
    <x-hero title="Record Income" subtitle="Add a new income entry">
        <a href="{{ route('admin.incomes.index') }}" class="inline-flex items-center px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-lg">Back to Incomes</a>
    </x-hero>
@endsection

@section('content')
<div class="max-w-5xl px-4 sm:px-6 lg:px-8 lg:ml-64">
    <div class="card p-6">
        <h2 class="text-xl font-semibold text-slate-900 dark:text-white mb-1">Record Income</h2>
        <p class="text-sm text-slate-500 dark:text-slate-400 mb-6">Capture a new income entry with category, source, and timing.</p>

        @if (is_object($errors) && method_exists($errors, 'any') && $errors->any())
            <div class="mb-6 rounded-lg border border-red-200 dark:border-red-800 bg-red-50 dark:bg-red-900/20 p-4 text-sm text-red-700 dark:text-red-300">
                <div class="font-semibold mb-1">Please fix the following:</div>
                <ul class="list-disc list-inside space-y-0.5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.incomes.store') }}" class="space-y-8">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Branch -->
                <div class="col-span-1">
                    <label for="branch_id" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Branch</label>
                    <select id="branch_id" name="branch_id" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-emerald-500 focus:ring-emerald-500">
                        <option value="">-- Select branch --</option>
                        @foreach($branches as $b)
                            <option value="{{ $b->id }}" @selected(old('branch_id')==$b->id)>{{ $b->name }}</option>
                        @endforeach
                    </select>
                    @error('branch_id')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Amount -->
                <div class="col-span-1">
                    <label for="amount" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Amount <span class="text-red-600">*</span></label>
                    <div class="relative">
                        <input id="amount" name="amount" type="text" inputmode="numeric" autocomplete="off" placeholder="e.g. 250,000" value="{{ old('amount') }}" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 pr-16 text-slate-900 dark:text-slate-100 focus:border-emerald-500 focus:ring-emerald-500" required>
                        <span class="absolute inset-y-0 right-3 inline-flex items-center text-xs text-slate-500">RWF</span>
                    </div>
                    <p class="mt-1 text-xs text-slate-500">Enter whole amount; commas allowed.</p>
                    @error('amount')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Currency -->
                <div class="col-span-1">
                    <label for="currency" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Currency</label>
                    <input id="currency" name="currency" type="text" value="{{ old('currency', 'RWF') }}" class="w-full uppercase rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-emerald-500 focus:ring-emerald-500">
                    <p class="mt-1 text-xs text-slate-500">ISO code (e.g., RWF, USD, EUR)</p>
                    @error('currency')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div class="col-span-1">
                    <label for="category" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Category</label>
                    <input list="categoryOptions" id="category" name="category" type="text" value="{{ old('category') }}" placeholder="e.g. sponsorship" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-emerald-500 focus:ring-emerald-500">
                    <datalist id="categoryOptions">
                        <option value="fees" />
                        <option value="donation" />
                        <option value="sponsorship" />
                        <option value="ticket_sales" />
                        <option value="merchandise" />
                        <option value="other" />
                    </datalist>
                    @error('category')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Source -->
                <div class="col-span-1">
                    <label for="source" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Source</label>
                    <input list="sourceOptions" id="source" name="source" type="text" value="{{ old('source') }}" placeholder="e.g. mobile_money" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-emerald-500 focus:ring-emerald-500">
                    <datalist id="sourceOptions">
                        <option value="cash" />
                        <option value="mobile_money" />
                        <option value="bank_transfer" />
                        <option value="cheque" />
                        <option value="other" />
                    </datalist>
                    @error('source')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Received at -->
                <div class="max-w-5xl px-4 sm:px-6 lg:px-8 lg:ml-64">
                    <label for="received_at" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Received At</label>
                    <input id="received_at" name="received_at" type="datetime-local" value="{{ old('received_at') }}" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-emerald-500 focus:ring-emerald-500">
                    <p class="mt-1 text-xs text-slate-500">Leave blank to default to now.</p>
                    @error('received_at')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Notes -->
               <div class="max-w-5xl px-4 sm:px-6 lg:px-8 lg:ml-64">
                    <label for="notes" class="block text-sm font-medium text-slate-700 dark:text-slate-200 mb-1">Notes</label>
                    <textarea id="notes" name="notes" rows="3" class="w-full rounded-lg border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:border-emerald-500 focus:ring-emerald-500" placeholder="Optional notes or references">{{ old('notes') }}</textarea>
                    @error('notes')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

<div class="max-w-5xl px-4 sm:px-6 lg:px-8 lg:ml-64">
                <a href="{{ route('admin.incomes.index') }}" class="px-4 py-2 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">Cancel</a>
                <button class="btn-primary">Save Income</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Simple currency formatting for amount (allows digits and commas)
    (function() {
        const el = document.getElementById('amount');
        if (!el) return;
        const format = (val) => {
            const digits = (val || '').toString().replace(/[^0-9]/g, '');
            return digits.replace(/\B(?=(\d{3})+(?!\d))/g, ',');
        };
        // Initial format if prefilled
        el.value = format(el.value);
        el.addEventListener('input', () => { el.value = format(el.value); });
        el.addEventListener('blur', () => { el.value = format(el.value); });
    })();
</script>
<!-- Removed unmatched @endsection: Blade section error fix -->
