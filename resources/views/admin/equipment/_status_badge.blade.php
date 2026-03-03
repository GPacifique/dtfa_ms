@php
    $colors = [
        'available'   => 'green',
        'in_use'      => 'blue',
        'maintenance' => 'yellow',
        'retired'     => 'gray',
        'lost'        => 'red',
    ];
    $c = $colors[$status] ?? 'gray';
    $labels = [
        'available'   => 'Available',
        'in_use'      => 'In Use',
        'maintenance' => 'Maintenance',
        'retired'     => 'Retired',
        'lost'        => 'Lost',
    ];
@endphp
<span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-semibold bg-{{ $c }}-100 text-{{ $c }}-700">{{ $labels[$status] ?? ucfirst($status ?? 'N/A') }}</span>
