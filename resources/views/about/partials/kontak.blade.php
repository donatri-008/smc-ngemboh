@php
    $kontakList = [
        ['key' => 'whatsapp',  'label' => 'WhatsApp',   'icon' => 'chat-bubble-left'],
        ['key' => 'shopee',    'label' => 'Shopee',     'icon' => 'building-storefront'],
        ['key' => 'email',     'label' => 'Email Resmi','icon' => 'envelope'],
        ['key' => 'tiktok',    'label' => 'Tiktok',     'icon' => 'musical-note'],
        ['key' => 'instagram', 'label' => 'Instagram',  'icon' => 'camera'],
    ];
@endphp

<div id="kontak" class="bg-neu rounded-2xl sm:rounded-3xl px-4 sm:px-6 md:px-12 py-8 sm:py-14 scroll-mt-40">
    <h2 class="text-lg sm:text-2xl font-bold text-brand-navy text-center mb-6 sm:mb-10">Informasi Kontak</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-5 max-w-4xl mx-auto">
        @foreach($kontakList as $item)
        @if(!empty($contents[$item['key']]))
        <div class="bg-white rounded-2xl p-4 sm:p-5 flex items-center gap-3 sm:gap-4 shadow-[0_4px_20px_-2px_rgba(0,0,0,0.15)]">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                <x-dynamic-component :component="'heroicon-o-' . $item['icon']" class="w-5 h-5 sm:w-6 sm:h-6 text-brand-blue" />
            </div>
            <div class="min-w-0">
                <p class="text-[11px] sm:text-xs text-gray-400">{{ $item['label'] }}</p>
                <p class="text-sm sm:text-lg font-bold text-[#1E293B] truncate">{{ $contents[$item['key']] }}</p>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>