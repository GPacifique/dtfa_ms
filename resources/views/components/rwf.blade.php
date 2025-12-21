@props([
    'value' => 0,
    'currency' => 'RWF',
    'cents' => false,
    'class' => ''
])
@php
    $raw = $value ?? 0;
    $amount = $cents ? (int) floor($raw / 100) : (int) $raw;
@endphp
<span class="{{ $class }}">{{ number_format($amount, 0) }} <span class="text-xs text-slate-500">{{ $currency }}</span></span>
