@props(['label' => null, 'name', 'type' => 'text', 'value' => null, 'placeholder' => null, 'required' => false])
<div class="space-y-1">
    @if($label)
        <label for="{{ $name }}" class="text-sm font-medium text-slate-700 dark:text-slate-300">{{ $label }}</label>
    @endif
    <input id="{{ $name }}" name="{{ $name }}" type="{{ $type }}" value="{{ old($name, $value) }}" @if($placeholder) placeholder="{{ $placeholder }}" @endif @if($required) required @endif class="w-full px-3 py-2 rounded-md border border-slate-300 dark:border-slate-700 bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-100 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
    @error($name)
        <p class="text-xs text-rose-600">{{ $message }}</p>
    @enderror
</div>
