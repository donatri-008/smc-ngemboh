<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Admin - Smart Maritim Community Ngemboh</title>
    <script>window.__usesLivewireAlpine = true;</script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-neu min-h-screen">
    <div class="flex">
        {{-- Sidebar --}}
        <aside class="w-64 min-h-screen bg-neu shadow-neu-out p-6 space-y-6 hidden lg:block">
            <div class="text-lg font-bold text-gray-700">SMC Ngemboh</div>

            <nav class="space-y-2">
                @php
                $menus = [
                    ['route' => 'admin.dashboard', 'label' => 'Overview', 'icon' => 'home'],
                    ['route' => 'admin.articles', 'label' => 'Artikel & Berita', 'icon' => 'newspaper'],
                    ['route' => 'admin.products', 'label' => 'Belanja', 'icon' => 'shopping-bag'],
                    ['route' => 'admin.environment', 'label' => 'Info Lingkungan', 'icon' => 'globe-alt'],
                    ['route' => 'admin.statistics', 'label' => 'Data Statistik', 'icon' => 'chart-bar'],
                    ['route' => 'admin.legalities', 'label' => 'Legalitas & Sertifikasi', 'icon' => 'document-check'],
                    ['route' => 'admin.team', 'label' => 'Profil Tim', 'icon' => 'users'],
                    ['route' => 'admin.partners', 'label' => 'Mitra', 'icon' => 'building-office-2'],
                ];
                @endphp

                @foreach($menus as $menu)
                <a href="{{ route($menu['route']) }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition {{ request()->routeIs($menu['route']) ? 'bg-neu shadow-neu-in text-indigo-600' : 'text-gray-600 hover:shadow-neu-in' }}">
                    <x-heroicon-o-{{ $menu['icon'] }} class="w-5 h-5" />
                    {{ $menu['label'] }}
                </a>
                @endforeach
            </nav>

            <form method="POST" action="{{ route('logout') }}" class="pt-6 border-t border-gray-200/60">
                @csrf
                <button type="submit" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-red-500 hover:shadow-neu-in transition w-full">
                    <x-heroicon-o-arrow-right-on-rectangle class="w-5 h-5" />
                    Keluar
                </button>
            </form>
        </aside>

        {{-- Konten --}}
        <main class="flex-1 p-6 lg:p-10">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @stack('scripts')
</body>
</html>
