<div class="flex items-center justify-between px-2 pb-6">
    <div>
        <div class="text-2xl font-bold text-blue-500">Maritime Hub</div>
        <div class="text-xs font-medium text-gray-500">Community Admin</div>
    </div>
    <button @click="sidebarOpen = false" class="lg:hidden w-8 h-8 rounded-lg flex items-center justify-center text-gray-500 hover:text-gray-700 transition-colors duration-150">
        <x-heroicon-o-x-mark class="w-5 h-5" />
    </button>
</div>

<nav class="flex-1 space-y-1">
    @php
    $menus = [
        ['route' => 'admin.dashboard', 'label' => 'Overview', 'icon' => 'squares-2x2'],
        ['route' => 'admin.articles', 'label' => 'Kelola Artikel & Berita', 'icon' => 'newspaper'],
        ['route' => 'admin.products', 'label' => 'Kelola Produk', 'icon' => 'shopping-cart'],
        ['route' => 'admin.environment', 'label' => 'Info Lingkungan', 'icon' => 'globe-alt'],
        ['route' => 'admin.demographics', 'label' => 'Data Demografis', 'icon' => 'chart-bar-square'],
        ['route' => 'admin.legalities', 'label' => 'Sertifikat & Legalitas', 'icon' => 'shield-check'],
        ['route' => 'admin.team', 'label' => 'Profil Tim', 'icon' => 'user-group'],
        ['route' => 'admin.partners', 'label' => 'Mitra', 'icon' => 'building-office-2'],
    ];
    @endphp

    @foreach($menus as $menu)
    @php $active = request()->routeIs($menu['route']); @endphp
    <a href="{{ route($menu['route']) }}"
       class="group flex items-center gap-3 px-3 py-3 rounded-lg text-sm font-medium
       {{ $active
            ? 'bg-blue-50 border-l-4 border-brand-green shadow-[inset_4px_4px_8px_#D1D9E6,inset_-4px_-4px_8px_#FFFFFF] text-brand-green font-bold'
            : 'text-gray-600 transition-colors duration-150 hover:text-brand-green' }}">
        <x-dynamic-component :component="'heroicon-o-' . $menu['icon']"
            class="w-[18px] h-[18px] shrink-0
            {{ $active ? 'text-brand-green' : 'text-gray-500 transition-colors duration-150 group-hover:text-brand-green' }}" />
        {{ $menu['label'] }}
    </a>
    @endforeach
</nav>

<div class="pt-4">
    <hr class="border-0 border-t-2 border-gray-300/70 mb-4">
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="flex items-center gap-3 px-3 py-3 rounded-lg text-sm font-semibold text-red-600 hover:bg-red-50 transition w-full">
            <x-heroicon-o-arrow-right-on-rectangle class="w-[18px] h-[18px]" />
            Keluar
        </button>
    </form>
</div>