@props([
    'title' => null,
    'subtitle' => null,
    'gradient' => 'violet',
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

<div class="relative bg-gradient-to-r {{ $gradientClass }} rounded-2xl shadow-2xl">

    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-40 pointer-events-none z-0
        bg-[url('data:image/svg+xml,%3Csvg width=%2230%22 height=%2230%22 viewBox=%220 0 30 30%22 fill=%22none%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Ccircle cx=%221.5%22 cy=%221.5%22 r=%221.5%22 fill=%22white%22 fill-opacity=%220.08%22/%3E%3C/svg%3E')]">
    </div>

    {{-- Animated Blobs (BEHIND EVERYTHING) --}}
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-yellow-400/20 rounded-full blur-3xl animate-pulse z-0"></div>
    <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-cyan-400/20 rounded-full blur-3xl animate-pulse z-0"></div>

    {{-- CONTENT --}}
    <div class="relative z-50 container mx-auto px-6 py-8">

        {{-- Title --}}
        @if($title)
            <h1 class="flex items-center gap-3 text-3xl md:text-4xl font-bold text-white mb-2">
                <div class="p-2 bg-white/20 backdrop-blur-sm rounded-xl">
                    <img src="{{ asset('logo.jpeg') }}" class="w-9 h-9 rounded-lg object-cover">
                </div>
                <span>{!! html_entity_decode($title) !!}</span>
            </h1>
        @endif

        {{-- Subtitle --}}
        @if($subtitle)
            <p class="text-white/90 text-lg mb-4">
                {!! html_entity_decode($subtitle) !!}
            </p>
        @endif

        {{-- SLOT (IMPORTANT FIX) --}}
        <div class="relative z-50 mt-6">
            {{ $slot }}
        </div>

    </div>
</div>