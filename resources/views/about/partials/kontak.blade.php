@php
    $kontakList = [
        ['key' => 'whatsapp',  'label' => 'WhatsApp',   'icon' => 'chat-bubble-left'],
        ['key' => 'shopee',    'label' => 'Shopee',     'icon' => 'building-storefront'],
        ['key' => 'email',     'label' => 'Email Resmi','icon' => 'envelope'],
        ['key' => 'tiktok',    'label' => 'Tiktok',     'icon' => 'musical-note'],
        ['key' => 'instagram', 'label' => 'Instagram',  'icon' => 'camera'],
    ];

    $buildHref = function ($key, $value) {
        $clean = trim($value);

        return match ($key) {
            'whatsapp'  => 'https://wa.me/' . preg_replace('/[^0-9]/', '', $clean),
            'email'     => 'https://mail.google.com/mail/?view=cm&fs=1&to=' . $clean,
            'instagram' => 'https://instagram.com/' . ltrim($clean, '@'),
            'tiktok'    => 'https://tiktok.com/@' . ltrim($clean, '@'),
            'shopee'    => 'https://shopee.co.id/' . ltrim($clean, '@'),
            default     => '#',
        };
    };
@endphp

<div id="kontak" class="rounded-2xl sm:rounded-3xl px-4 sm:px-6 md:px-12 py-8 sm:py-14 scroll-mt-40">
    <h2 class="text-lg sm:text-2xl font-bold text-brand-navy text-center mb-6 sm:mb-10">Informasi Kontak</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 sm:gap-5 max-w-5xl mx-auto">
        @foreach($kontakList as $item)
        @if(!empty($contents[$item['key']]))

        <a href="{{ $buildHref($item['key'], $contents[$item['key']]) }}"
            target="_blank"
            rel="noopener noreferrer"
            class="bg-white rounded-2xl p-4 sm:p-5 flex items-start gap-3 sm:gap-4 shadow-[0_4px_20px_-2px_rgba(0,0,0,0.15)] transition-transform duration-200 hover:-translate-y-0.5 hover:shadow-[0_6px_24px_-2px_rgba(0,0,0,0.2)] cursor-pointer">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                <x-dynamic-component :component="'heroicon-o-' . $item['icon']" class="w-5 h-5 sm:w-6 sm:h-6 text-brand-blue" />
            </div>
            <div class="min-w-0 flex-1 self-center">
                <p class="text-[11px] sm:text-xs text-gray-400">{{ $item['label'] }}</p>
                <p class="text-[13px] sm:text-base md:text-lg font-bold text-[#1E293B] leading-snug break-words">{{ $contents[$item['key']] }}</p>
            </div>
        </a>
        @endif
        @endforeach
    </div>
</div>