@props([
    'title' => null,
    'subtitle' => null,
    'gradient' => 'violet', // violet, cyan, emerald, amber, rose
])

@php
    $gradients = [
        'violet' => 'from-violet-600 via-fuchsia-600 to-pink-600',
        'cyan' => 'from-cyan-600 via-blue-600 to-indigo-600',
        'emerald' => 'from-emerald-600 via-teal-600 to-cyan-600',
        'amber' => 'from-amber-500 via-orange-500 to-red-500',
        'rose' => 'from-rose-600 via-pink-600 to-fuchsia-600',
    ];
    $gradientClass = $gradients[$gradient] ?? $gradients['violet'];
@endphp

<div class="relative overflow-hidden bg-gradient-to-r {{ $gradientClass }} rounded-2xl shadow-2xl">
    {{-- Animated Background Pattern --}}
    <div class="absolute inset-0 bg-[url('data:image/svg+xml,%3Csvg width=%2230%22 height=%2230%22 viewBox=%220 0 30 30%22 fill=%22none%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z%22 fill=%22rgba(255,255,255,0.07)%22/%3E%3C/svg%3E')] opacity-50"></div>

    {{-- Animated Blobs --}}
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-gradient-to-br from-yellow-400/30 to-orange-500/30 rounded-full blur-3xl animate-pulse"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-gradient-to-br from-cyan-400/30 to-blue-500/30 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-white/10 rounded-full blur-3xl animate-pulse" style="animation-delay: 0.5s"></div>

    <div class="relative z-10 container mx-auto px-6 py-8">
        @if($title)
            <h1 class="flex items-center gap-3 text-3xl md:text-4xl font-bold text-white mb-2 drop-shadow-lg">
                <div class="p-2 bg-white/20 backdrop-blur-sm rounded-xl shadow-lg">
                    <img src="{{ asset('logo.jpeg') }}" alt="Logo" width="40" height="40" class="w-9 h-9 md:w-10 md:h-10 rounded-lg object-cover">
                </div>
                <span>{!! html_entity_decode($title) !!}</span>
            </h1>
        @endif
        @if($subtitle)
            <p class="text-white/90 text-lg font-medium">{!! html_entity_decode($subtitle) !!}</p>
        @endif
        {{ $slot }}
    </div>
</div>
