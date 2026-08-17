<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Smart Maritim Community Ngemboh</title>
    <link rel="icon" type="image/png" href="/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/favicon.svg" />
    <link rel="shortcut icon" href="/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png" />
    <link rel="manifest" href="/site.webmanifest" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet"></noscript>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-neu min-h-screen" x-data="{ sidebarOpen: false }">
    <div class="flex">

        {{-- Sidebar DESKTOP --}}
        <aside class="hidden lg:flex w-64 fixed inset-y-0 left-0 bg-neu p-4 space-y-4 flex-col shadow-[4px_0_10px_-2px_rgba(209,217,230,0.6)] overflow-y-auto z-20">
            @include('partials.admin-sidebar-content')
        </aside>

        {{-- Overlay gelap saat sidebar mobile terbuka --}}
        <div x-show="sidebarOpen" x-cloak
             x-transition:enter="transition-opacity ease-linear duration-200"
             x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-150"
             x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             @click="sidebarOpen = false"
             class="fixed inset-0 bg-black/40 z-30 lg:hidden"></div>

        {{-- Sidebar MOBILE --}}
        <aside
            x-show="sidebarOpen"
            x-cloak
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="lg:hidden w-64 fixed inset-y-0 left-0 bg-neu p-4 space-y-4 flex flex-col shadow-[4px_0_10px_-2px_rgba(209,217,230,0.6)] overflow-y-auto z-40"
            @click.outside="sidebarOpen = false"
        >
            @include('partials.admin-sidebar-content')
        </aside>

        {{-- Konten --}}
        <div class="flex-1 flex flex-col min-h-screen lg:ml-64 min-w-0">
            {{-- Top Navbar --}}
            <header class="h-16 sm:h-20 bg-neu shadow-[0_4px_12px_#D1D9E6] flex items-center justify-between px-4 sm:px-8 gap-3 sm:gap-4 sticky top-0 z-10">
                <div class="flex items-center gap-3 min-w-0">
                    <button @click="sidebarOpen = true" class="lg:hidden w-9 h-9 shrink-0 rounded-lg shadow-[4px_4px_8px_#D1D9E6,-4px_-4px_8px_#FFFFFF] flex items-center justify-center text-brand-blue">
                        <x-heroicon-o-bars-3 class="w-5 h-5" />
                    </button>
                    <h1 class="text-lg sm:text-2xl font-extrabold text-blue-500 truncate">Maritime Dashboard</h1>
                </div>

                <div class="flex items-center gap-2 sm:gap-4 ml-auto shrink-0">
                    <div class="hidden sm:block w-px h-10 bg-gray-200"></div>
                    <div class="text-right hidden sm:block">
                        <p class="text-sm text-gray-800">Administrator</p>
                        <p class="text-[10px] font-bold text-blue-500 tracking-wider uppercase">SMC Ngemboh</p>
                    </div>
                    <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] border-2 border-neu overflow-hidden shrink-0">
                        <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400 text-xs">
                            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
                        </div>
                    </div>
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-6 lg:p-8 min-w-0">
                {{ $slot }}
            </main>
        </div>
    </div>

    @livewireScripts
    @stack('scripts')
</body>
</html>