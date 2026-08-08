@php
    $kontakList = [
        ['key' => 'whatsapp',  'label' => 'WhatsApp',   'icon' => 'chat-bubble-left'],
        ['key' => 'shopee',    'label' => 'Shopee',     'icon' => 'building-storefront'],
        ['key' => 'email',     'label' => 'Email Resmi','icon' => 'envelope'],
        ['key' => 'tiktok',    'label' => 'Tiktok',     'icon' => 'musical-note'],
        ['key' => 'instagram', 'label' => 'Instagram',  'icon' => 'camera'],
    ];
@endphp

<div class="bg-[#0F1E3D] rounded-3xl px-6 md:px-12 py-14">
    <h2 class="text-2xl font-bold text-white text-center mb-10">Informasi Kontak</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 max-w-4xl mx-auto">
        @foreach($kontakList as $item)
        @if(!empty($contents[$item['key']]))
        <div class="bg-white rounded-2xl p-5 flex items-center gap-4 shadow-[0_4px_20px_-2px_rgba(0,0,0,0.15)]">
            <div class="w-12 h-12 rounded-xl bg-blue-50 flex items-center justify-center flex-shrink-0">
                <x-dynamic-component :component="'heroicon-o-' . $item['icon']" class="w-6 h-6 text-brand-blue" />
            </div>
            <div>
                <p class="text-xs text-gray-400">{{ $item['label'] }}</p>
                <p class="text-lg font-bold text-[#1E293B]">{{ $contents[$item['key']] }}</p>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>