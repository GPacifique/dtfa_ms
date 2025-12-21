@props([
    'title' => null,
    'subtitle' => null,
])

<div class="footer-like-hero relative overflow-hidden">
    <div class="hero-blob-layer">
        <div class="hero-blob blob-1"></div>
        <div class="hero-blob blob-2"></div>
        <div class="hero-blob blob-3"></div>
    </div>
    <div class="relative z-10 container mx-auto px-6 py-8">
        @if($title)
            <h1 class="flex items-center gap-3 text-3xl md:text-4xl font-bold text-white mb-2">
                <img src="{{ asset('logo.jpeg') }}" alt="Logo" width="40" height="40" class="w-9 h-9 md:w-10 md:h-10 rounded-md object-cover shadow-sm ring-2 ring-white/20">
                <span>{{ $title }}</span>
            </h1>
        @endif
        @if($subtitle)
            <p class="text-emerald-100">{{ $subtitle }}</p>
        @endif
        {{ $slot }}
    </div>
    {{-- Optional gradient backdrop for better contrast in light mode --}}
</div>
