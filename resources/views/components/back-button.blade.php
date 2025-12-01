@props(['fallback' => route('dashboard'), 'label' => 'Back'])

<div class="mb-4 sm:mb-6">
    <button type="button"
            onclick="if (window.history.length > 1) { history.back(); } else { window.location.href='{{ $fallback }}'; }"
            class="inline-flex items-center gap-2 px-3 py-2 rounded-md border border-slate-300 dark:border-slate-700 text-slate-700 dark:text-slate-200 bg-white dark:bg-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 transition shadow-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
        <span class="text-sm font-medium">{{ $label }}</span>
    </button>
</div>
