@php
    $colors = [
        'excellent' => 'green',
        'good'      => 'blue',
        'fair'      => 'yellow',
        'poor'      => 'orange',
        'damaged'   => 'red',
    ];
    $c = $colors[$condition] ?? 'gray';
@endphp
<span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-{{ $c }}-100 text-{{ $c }}-700 capitalize">{{ $condition ?? 'N/A' }}</span>
