@props(['label' => null, 'name', 'options' => [], 'value' => null, 'placeholder' => 'Select'])
<div class="space-y-1">
    @if($label)
        <label for="{{ $name }}" class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $label }}</label>
    @endif
    <select id="{{ $name }}" name="{{ $name }}" class="w-full px-3 py-2 rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500">
        @if($placeholder !== null)
            <option value="">{{ $placeholder }}</option>
        @endif
        @foreach($options as $key => $label)
            <option value="{{ is_int($key) ? $label : $key }}" @selected(old($name, $value) == (is_int($key) ? $label : $key))>{{ $label }}</option>
        @endforeach
    </select>
    @error($name)
        <p class="text-xs text-rose-600">{{ $message }}</p>
    @enderror
</div>
