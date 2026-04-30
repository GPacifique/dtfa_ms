@extends('layouts.app')

@section('hero')
    <x-hero title="Record Income" subtitle="Add a new income entry">
        <a href="{{ route('admin.incomes.index') }}"
           class="inline-flex items-center px-4 py-2 bg-slate-200 hover:bg-slate-300 text-slate-800 rounded-lg transition">
            ← Back to Incomes
        </a>
    </x-hero>
@endsection

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="bg-white dark:bg-slate-900 rounded-xl shadow-md p-6">

        <div class="mb-6">
            <h2 class="text-xl font-semibold text-slate-900 dark:text-white">Record Income</h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">
                Capture a new income entry with category, source, and timing.
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 dark:bg-red-900/20 p-4 text-sm text-red-700 dark:text-red-300">
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.incomes.store') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- Branch --}}
                <div>
                    <label class="label">Branch</label>
                    <select name="branch_id" class="input">
                        <option value="">Select branch</option>
                        @foreach($branches as $b)
                            <option value="{{ $b->id }}" @selected(old('branch_id') == $b->id)>
                                {{ $b->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Amount --}}
                <div>
                    <label class="label">Amount <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <input id="amount" name="amount" type="text"
                               value="{{ old('amount') }}"
                               class="input pr-16"
                               placeholder="250,000" required>
                        <span class="absolute right-3 top-2.5 text-sm text-slate-500">RWF</span>
                    </div>
                </div>

                {{-- Currency --}}
                <div>
                    <label class="label">Currency</label>
                    <input name="currency" value="{{ old('currency', 'RWF') }}" class="input uppercase">
                </div>

                {{-- Category --}}
                <div>
                    <label class="label">Category</label>
                    <input list="categoryOptions" name="category" value="{{ old('category') }}" class="input">
                    <datalist id="categoryOptions">
                        <option value="fees"></option>
                        <option value="donation"></option>
                        <option value="sponsorship"></option>
                        <option value="ticket_sales"></option>
                        <option value="other"></option>
                    </datalist>
                </div>

                {{-- Source --}}
                <div>
                    <label class="label">Source</label>
                    <input list="sourceOptions" name="source" value="{{ old('source') }}" class="input">
                    <datalist id="sourceOptions">
                        <option value="cash"></option>
                        <option value="mobile_money"></option>
                        <option value="bank_transfer"></option>
                    </datalist>
                </div>

                {{-- Received At --}}
                <div>
                    <label class="label">Received At</label>
                    <input type="datetime-local" name="received_at" value="{{ old('received_at') }}" class="input">
                </div>

                {{-- Notes --}}
                <div class="md:col-span-2">
                    <label class="label">Notes</label>
                    <textarea name="notes" rows="3" class="input"></textarea>
                </div>

            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-between pt-6 border-t border-slate-200 dark:border-slate-700">
                <a href="{{ route('admin.incomes.index') }}"
                   class="px-4 py-2 border rounded-lg text-slate-700 hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800">
                    Cancel
                </a>

                <button type="submit"
                        class="px-5 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg shadow transition">
                    Save Income
                </button>
            </div>

        </form>
    </div>
</div>
@endsection