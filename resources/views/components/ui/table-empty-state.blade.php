@props([
    'icon' => 'inbox',
    'title' => 'Belum Ada Data',
    'message' => 'Data akan muncul di sini setelah ditambahkan.',
])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center text-center py-12 sm:py-16 px-6']) }}>
    <div class="w-16 h-16 sm:w-[72px] sm:h-[72px] rounded-2xl bg-blue-50 shadow-[inset_4px_4px_8px_#D1D9E6,inset_-4px_-4px_8px_#FFFFFF] flex items-center justify-center mb-4">
        <x-dynamic-component :component="'heroicon-o-' . $icon" class="w-7 h-7 sm:w-8 sm:h-8 text-[#4CC71C]" />
    </div>
    <p class="text-base sm:text-lg font-bold text-[#181C23]">{{ $title }}</p>
    <p class="text-sm text-[#717785] mt-1.5 max-w-sm">{{ $message }}</p>

    @isset($action)
    <div class="mt-5">
        {{ $action }}
    </div>
    @endisset
</div>