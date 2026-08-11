@props([
    'label',
    'value',
    'icon' => 'chart-bar',
    'valueSize' => 'text-lg sm:text-xl lg:text-2xl',
    'iconColor' => 'text-brand-green',
])

<div {{ $attributes->merge(['class' => 'bg-neu rounded-2xl sm:rounded-[28px] lg:rounded-[32px] shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] p-3 sm:p-5 lg:p-6 flex flex-col gap-1.5 sm:gap-2.5 lg:gap-3 min-w-0']) }}>
    <div class="w-8 h-8 sm:w-10 sm:h-10 lg:w-12 lg:h-12 shrink-0 rounded-xl sm:rounded-2xl shadow-[inset_4px_4px_8px_#D1D9E6,inset_-4px_-4px_8px_#FFFFFF] flex items-center justify-center">
        <x-dynamic-component :component="'heroicon-o-' . $icon" class="w-4 h-4 sm:w-5 sm:h-5 lg:w-6 lg:h-6 {{ $iconColor }} shrink-0" />
    </div>
    <p class="text-[11px] sm:text-xs lg:text-sm text-gray-600 leading-tight line-clamp-2 min-h-[2.2em] sm:min-h-[2.4em] lg:min-h-[2.6em]">{{ $label }}</p>
    <p class="{{ $valueSize }} font-bold text-gray-900 truncate mt-auto">{{ $value }}</p>
</div>