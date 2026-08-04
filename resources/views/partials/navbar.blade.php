<nav class="bg-neu shadow-neu-out px-6 md:px-12 py-3 flex items-center justify-between sticky top-0 z-40">
    <a href="{{ route('home') }}" class="font-bold text-2xl text-brand-blue">Logo</a>

    <div class="hidden md:flex items-center gap-8 text-base">
        <a href="{{ route('home') }}"
           class="pb-1 {{ request()->routeIs('home') ? 'text-brand-blue font-bold border-b-2 border-brand-blue' : 'text-ink font-normal' }}">
            Beranda
        </a>
        <a href="{{ route('articles.index') }}"
           class="{{ request()->routeIs('articles.*') ? 'text-brand-blue font-bold' : 'text-ink font-normal' }}">
            Artikel & Berita
        </a>
        <a href="{{ route('environment.index') }}"
           class="{{ request()->routeIs('environment.*') ? 'text-brand-blue font-bold' : 'text-ink font-normal' }}">
            Data & Informasi
        </a>
        <a href="{{ route('shop.index') }}"
           class="{{ request()->routeIs('shop.*') ? 'text-brand-blue font-bold' : 'text-ink font-normal' }}">
            Belanja
        </a>
        <a href="{{ route('about.index') }}"
           class="{{ request()->routeIs('about.*') ? 'text-brand-blue font-bold' : 'text-ink font-normal' }}">
            Tentang Kami
        </a>
    </div>

    <a href="{{ route('cart.index') }}"
       class="w-9 h-9 rounded-full bg-brand-green shadow-neu-out flex items-center justify-center">
        <x-heroicon-o-shopping-cart class="w-5 h-5 text-white" />
    </a>
</nav>