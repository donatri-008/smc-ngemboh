@props(['href' => null, 'variant' => 'primary', 'type' => 'submit'])

@php
$colors = [
    'primary' => 'text-indigo-600',
    'danger'  => 'text-red-500',
    'success' => 'text-green-600',
];
$color = $colors[$variant] ?? $colors['primary'];
$baseClass = "bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium {$color} transition text-center";
@endphp

@if($href)
<a href="{{ $href }}" {{ $attributes->merge(['class' => "$baseClass inline-block"]) }}>
    {{ $slot }}
</a>
@else
<button type="{{ $type }}" {{ $attributes->merge(['class' => $baseClass]) }}>
    {{ $slot }}
</button>
@endif