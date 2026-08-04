@props(['padding' => 'p-6'])

<div {{ $attributes->merge(['class' => "bg-neu shadow-neu-out rounded-2xl {$padding}"]) }}>
    {{ $slot }}
</div>