@extends('layouts.app')

@section('hero')
    <x-hero :title="__('app.create_expense_category')" :subtitle="__('app.add_new_expense_category')">
        <a href="{{ route('accountant.expense-categories.index') }}"
           class="inline-flex items-center px-5 py-2.5 bg-white/20 hover:bg-white/30 text-white font-semibold rounded-lg transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            {{ __('app.back_to_categories') }}
        </a>
    </x-hero>
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-700">
                <h2 class="text-xl font-semibold text-slate-900 dark:text-white">{{ __('app.category_details') }}</h2>
            </div>

            <form action="{{ route('accountant.expense-categories.store') }}" method="POST" class="p-6 space-y-6">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        {{ __('app.category_name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                           class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-slate-700 dark:text-white transition"
                           placeholder="e.g., Office Supplies">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="description" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                        {{ __('app.description') }}
                    </label>
                    <textarea name="description" id="description" rows="3"
                              class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-slate-700 dark:text-white transition"
                              placeholder="Brief description of this category...">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="color" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                            {{ __('app.color') }}
                        </label>
                        <div class="flex items-center space-x-3">
                            <input type="color" name="color" id="color" value="{{ old('color', '#6B7280') }}"
                                   class="w-12 h-10 border border-slate-300 dark:border-slate-600 rounded-lg cursor-pointer">
                            <input type="text" value="{{ old('color', '#6B7280') }}" readonly
                                   class="flex-1 px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg bg-slate-50 dark:bg-slate-700 dark:text-white"
                                   id="colorText">
                        </div>
                        @error('color')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="icon" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                            {{ __('app.icon') }}
                        </label>
                        <div class="flex items-center space-x-3">
                            <div id="icon-preview" class="w-12 h-12 border border-slate-300 dark:border-slate-600 rounded-lg flex items-center justify-center bg-slate-50 dark:bg-slate-700">
                                <i class="fas fa-folder text-xl text-slate-500"></i>
                            </div>
                            <select name="icon" id="icon" class="flex-1 px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-slate-700 dark:text-white transition">
                                <option value="folder" {{ old('icon', 'folder') == 'folder' ? 'selected' : '' }}>📁 folder</option>
                                <option value="truck" {{ old('icon') == 'truck' ? 'selected' : '' }}>🚚 truck</option>
                                <option value="phone" {{ old('icon') == 'phone' ? 'selected' : '' }}>📞 phone</option>
                                <option value="wrench" {{ old('icon') == 'wrench' ? 'selected' : '' }}>🔧 wrench</option>
                                <option value="bolt" {{ old('icon') == 'bolt' ? 'selected' : '' }}>⚡ bolt</option>
                                <option value="wifi" {{ old('icon') == 'wifi' ? 'selected' : '' }}>📶 wifi</option>
                                <option value="building" {{ old('icon') == 'building' ? 'selected' : '' }}>🏢 building</option>
                                <option value="users" {{ old('icon') == 'users' ? 'selected' : '' }}>👥 users</option>
                                <option value="briefcase" {{ old('icon') == 'briefcase' ? 'selected' : '' }}>💼 briefcase</option>
                                <option value="file-invoice" {{ old('icon') == 'file-invoice' ? 'selected' : '' }}>📝 file-invoice</option>
                                <option value="box" {{ old('icon') == 'box' ? 'selected' : '' }}>📦 box</option>
                                <option value="utensils" {{ old('icon') == 'utensils' ? 'selected' : '' }}>🍴 utensils</option>
                                <option value="gas-pump" {{ old('icon') == 'gas-pump' ? 'selected' : '' }}>⛽ gas-pump</option>
                                <option value="car" {{ old('icon') == 'car' ? 'selected' : '' }}>🚗 car</option>
                                <option value="tools" {{ old('icon') == 'tools' ? 'selected' : '' }}>🛠️ tools</option>
                                <option value="money-bill" {{ old('icon') == 'money-bill' ? 'selected' : '' }}>💵 money-bill</option>
                                <option value="credit-card" {{ old('icon') == 'credit-card' ? 'selected' : '' }}>💳 credit-card</option>
                                <option value="print" {{ old('icon') == 'print' ? 'selected' : '' }}>🖨️ print</option>
                                <option value="desktop" {{ old('icon') == 'desktop' ? 'selected' : '' }}>🖥️ desktop</option>
                                <option value="tshirt" {{ old('icon') == 'tshirt' ? 'selected' : '' }}>👕 tshirt</option>
                            </select>
                        </div>
                        @error('icon')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="sort_order" class="block text-sm font-semibold text-slate-700 dark:text-slate-300 mb-2">
                            {{ __('app.sort_order') }}
                        </label>
                        <input type="number" name="sort_order" id="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                               class="w-full px-4 py-2.5 border border-slate-300 dark:border-slate-600 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 dark:bg-slate-700 dark:text-white transition">
                        @error('sort_order')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center pt-8">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-red-300 dark:peer-focus:ring-red-800 rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-slate-600 peer-checked:bg-red-600"></div>
                            <span class="ml-3 text-sm font-medium text-slate-700 dark:text-slate-300">{{ __('app.active') }}</span>
                        </label>
                    </div>
                </div>

                <div class="flex items-center justify-end space-x-4 pt-6 border-t border-slate-200 dark:border-slate-700">
                    <a href="{{ route('accountant.expense-categories.index') }}"
                       class="px-6 py-2.5 bg-slate-200 hover:bg-slate-300 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-300 font-medium rounded-lg transition">
                        {{ __('app.cancel') }}
                    </a>
                    <button type="submit"
                            class="px-6 py-2.5 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white font-semibold rounded-lg shadow-lg transition">
                        {{ __('app.create_category') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('color').addEventListener('input', function(e) {
        document.getElementById('colorText').value = e.target.value;
    });
</script>
@endpush
@endsection
