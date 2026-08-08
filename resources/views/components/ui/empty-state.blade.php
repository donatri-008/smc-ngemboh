@props([
    'icon' => 'inbox',
    'title' => 'Belum Ada Data',
    'message' => 'Belum ada data untuk ditampilkan saat ini.',
])

<div {{ $attributes->merge(['class' => 'col-span-full flex flex-col items-center justify-center text-center py-12 sm:py-16 px-6']) }}>
    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full shadow-[-6px_-6px_12px_#FFFFFF,6px_6px_12px_#BABECC] bg-blue-50 flex items-center justify-center mb-4 sm:mb-5">
        <x-dynamic-component :component="'heroicon-o-' . $icon" class="w-8 h-8 sm:w-9 sm:h-9 text-brand-green" />
    </div>
    <p class="text-base sm:text-lg font-semibold text-gray-700">{{ $title }}</p>
    <p class="text-sm text-gray-400 mt-1.5 max-w-sm">{{ $message }}</p>

    @isset($action)
    <div class="mt-5">
        {{ $action }}
    </div>
    @endisset
</div>