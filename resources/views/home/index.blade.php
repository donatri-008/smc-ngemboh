@extends('layouts.app')
@section('title', 'Beranda - Smart Maritim Community Ngemboh')

@section('content')

<section class="relative min-h-[420px] sm:min-h-[500px] lg:min-h-[560px] flex items-center justify-center px-4 sm:px-6 py-12 sm:py-16 bg-cover bg-center"
         style="background-image: url('{{ asset('assets/bg-beranda.webp') }}')">
    <div class="absolute inset-0 bg-black/10"></div>

    <div class="relative z-10 max-w-4xl w-full bg-white/15 backdrop-blur border border-white/40 shadow-xl rounded-3xl sm:rounded-[50px] px-6 sm:px-10 py-8 sm:py-10 text-center">
        <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-brand-navy tracking-tight">Smart Maritim Community</h1>
        <p class="text-base sm:text-lg md:text-xl lg:text-2xl font-semibold text-brand-navy mt-2">"Dari Unesa Untuk Maritim Indonesia"</p>

        <p class="text-sm sm:text-base md:text-lg text-black font-medium leading-relaxed mt-4 sm:mt-6 drop-shadow-sm">
            Desa Ngemboh merupakan salah satu desa pesisir yang berada di Kecamatan Ujungpangkah, Kabupaten Gresik,
            dengan sebagian besar wilayah berupa kawasan pesisir, tambak, dan perairan laut dangkal yang dimanfaatkan
            masyarakat sebagai area budidaya dan penangkapan ikan. Kondisi lingkungan perairan yang mendukung,
            menjadikan desa ini memiliki peluang besar dalam pengembangan komoditas budidaya, khususnya perna viridis.
        </p>
    </div>
</section>

{{-- Artikel & Berita --}}
<section id="artikel-berita" class="bg-section-blue py-10 sm:py-16 scroll-mt-40">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 md:px-12">
        <div class="relative mb-8 sm:mb-10">
            <div class="text-center max-w-2xl mx-auto space-y-3 sm:space-y-0">
                <h2 class="text-2xl sm:text-3xl font-bold text-brand-navy">Artikel & Berita</h2>
                <p class="text-ink text-sm sm:text-base mt-2">
                    Wawasan dan kabar terkini seputar kegiatan komunitas, inovasi maritim, dan perkembangan lingkungan di Desa Ngemboh.
                </p>
                {{-- Tombol versi mobile/tablet: tampil di bawah teks --}}
                <a href="{{ route('articles.index') }}"
                   class="md:hidden inline-flex items-center bg-brand-green rounded-full px-5 py-2 text-[11px] font-bold uppercase tracking-wide text-white
                          transition-all duration-300 hover:bg-brand-navy">
                    Lihat Semuanya
                </a>
            </div>
            {{-- Tombol versi desktop: absolute di kanan --}}
            <a href="{{ route('articles.index') }}"
               class="hidden md:inline-flex absolute right-0 top-1/2 -translate-y-1/2 items-center bg-brand-green rounded-full px-5 py-2 text-[11px] font-bold uppercase tracking-wide text-white
                      transition-all duration-300 hover:scale-105 hover:bg-brand-navy">
                Lihat Semuanya
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-5 sm:gap-8">
            @forelse($latestArticles as $article)
            <a href="{{ route('articles.show', $article) }}"
               class="group flex flex-col bg-neu rounded-2xl overflow-hidden shadow-neu-flat
                      transition-all duration-300 hover:-translate-y-1">
                <div class="relative overflow-hidden">
                    @if($article->thumbnail)
                    <img src="{{ Storage::url($article->thumbnail) }}" alt="{{ $article->title }}" class="w-full h-36 sm:h-44 object-cover transition-transform duration-500 group-hover:scale-110">
                    @else
                    <div class="w-full h-36 sm:h-44 bg-neu-alt"></div>
                    @endif
                    <span class="absolute top-3 left-3 bg-brand-green text-white text-[10px] sm:text-[11px] font-bold uppercase tracking-wide px-2.5 sm:px-3 py-1 rounded-full">
                        {{ $article->category === 'produk' ? 'Artikel' : 'Berita' }}
                    </span>
                </div>
                <div class="p-4 sm:p-5 flex flex-col flex-1">
                    <p class="text-xs sm:text-[13px] font-semibold text-ink tracking-wide">{{ $article->published_at?->translatedFormat('d M Y') }}</p>
                    <p class="font-semibold text-dark text-lg sm:text-xl mt-2 line-clamp-2 transition-colors duration-300 group-hover:text-brand-blue">{{ $article->title }}</p>
                    <p class="text-sm sm:text-base text-ink mt-1 mb-4 sm:mb-5 line-clamp-2">{{ Str::limit(strip_tags($article->content), 90) }}</p>

                    <div class="mt-auto text-center bg-brand-green shadow-neu-out rounded-xl py-2.5 sm:py-3 text-sm sm:text-base font-semibold text-white
                                transition-all duration-300 group-hover:bg-brand-blue">
                        Baca Selengkapnya
                    </div>
                </div>
            </a>
            @empty
            <x-ui.empty-state
                icon="newspaper"
                title="Belum Ada Artikel"
                message="Artikel dan berita terbaru dari komunitas akan tampil di sini." />
            @endforelse
        </div>
    </div>
</section>

{{-- Produk Unggulan --}}
<section id="produk-unggulan"  class="bg-section-blue py-10 sm:py-16 scroll-mt-40">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 md:px-12">
        <div class="relative mb-8 sm:mb-10">
            <div class="text-center max-w-2xl mx-auto space-y-3 sm:space-y-0">
                <h2 class="text-2xl sm:text-3xl font-bold text-brand-navy">Produk Unggulan Kami</h2>
                <p class="text-ink text-sm sm:text-base mt-2">Dukung ekonomi lokal dengan membeli produk berkualitas tinggi hasil olahan langsung komunitas kami.</p>
                <a href="{{ route('shop.index') }}"
                   class="md:hidden inline-flex items-center bg-brand-green rounded-full px-5 py-2 text-[11px] font-bold uppercase tracking-wide text-white
                          transition-all duration-300 hover:bg-brand-navy">
                    Lihat Semuanya
                </a>
            </div>
            <a href="{{ route('shop.index') }}"
               class="hidden md:inline-flex absolute right-0 top-1/2 -translate-y-1/2 items-center bg-brand-green rounded-full px-5 py-2 text-[11px] font-bold uppercase tracking-wide text-white
                      transition-all duration-300 hover:scale-105 hover:bg-brand-navy">
                Lihat Semuanya
            </a>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
            @forelse($featuredProducts as $product)
            <div class="group bg-neu shadow-neu-flat rounded-2xl p-2.5 sm:p-3 transition-all duration-300 hover:-translate-y-1">
                <a href="{{ route('shop.show', $product) }}" class="block overflow-hidden rounded-2xl">
                    @if($product->gambar)
                    <img src="{{ Storage::url($product->gambar) }}" class="w-full h-28 sm:h-40 object-cover rounded-2xl bg-white transition-transform duration-500 group-hover:scale-110">
                    @else
                    <div class="w-full h-28 sm:h-40 bg-white rounded-2xl"></div>
                    @endif
                </a>
                <div class="px-1.5 sm:px-2 pt-2.5 sm:pt-3 space-y-1">
                    <p class="text-sm sm:text-base text-dark truncate">{{ $product->nama }}</p>
                    <p class="text-sm sm:text-base font-bold text-brand-blue pb-1.5 sm:pb-2">Rp{{ number_format($product->harga, 0, ',', '.') }}</p>
                    <form
                        x-data="{ loading: false }"
                        x-on:submit.prevent="
                            const tokenEl = document.querySelector('meta[name=csrf-token]');
                            if (! tokenEl) {
                                window.showToast('error', 'CSRF token tidak ditemukan. Muat ulang halaman.');
                                return;
                            }
                            loading = true;
                            fetch($el.action, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': tokenEl.content,
                                    'Accept': 'application/json',
                                },
                                body: new FormData($el),
                            })
                            .then(res => res.json())
                            .then(data => {
                                loading = false;
                                window.showToast(data.success ? 'success' : 'error', data.message);
                                if (data.success) {
                                    window.dispatchEvent(new CustomEvent('cart-updated', { detail: { count: data.cart_count } }));
                                }
                            })
                            .catch(() => {
                                loading = false;
                                window.showToast('error', 'Gagal menambahkan produk ke keranjang.');
                            });
                        "
                        action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <button type="submit" :disabled="loading"
                                class="w-full bg-neu shadow-neu-in rounded-xl py-1.5 sm:py-2 text-xs sm:text-sm font-semibold text-brand-green
                                       transition-all duration-300 hover:bg-brand-green hover:text-white active:scale-95 disabled:opacity-60">
                            <span x-show="!loading">Tambah</span>
                            <span x-show="loading" x-cloak>Memproses...</span>
                        </button>
                    </form>
                </div>
            </div>
            @empty
            <x-ui.empty-state
                icon="shopping-bag"
                title="Belum Ada Produk"
                message="Produk unggulan dari komunitas akan segera hadir." />
            @endforelse
        </div>
    </div>
</section>

{{-- Program SMC --}}
<section id="program-smc" class="bg-section-blue py-10 sm:py-16 scroll-mt-40">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 md:px-12">
        <div class="text-center max-w-2xl mx-auto mb-6 sm:mb-10">
            <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-brand-navy uppercase">Program SMC</h2>
            <p class="text-ink text-xs sm:text-sm md:text-base mt-2">Inisiatif yang menggerakkan perubahan di komunitas Desa Ngemboh.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-5 md:gap-6">
            @forelse($programs->take(4) as $program)
            <a href="{{ route('program.show', $program) }}?from=home"
               class="group block bg-neu shadow-neu-in rounded-2xl p-5 sm:p-6 md:p-8 transition-all duration-300 hover:scale-[1.01] hover:shadow-neu-out">
                <h3 class="text-base sm:text-lg md:text-xl font-bold text-brand-green transition-colors duration-300 group-hover:text-brand-blue">{{ $program->nama }}</h3>
                <p class="text-xs sm:text-sm md:text-base text-ink mt-2 leading-relaxed">{{ $program->deskripsi }}</p>
            </a>
            @empty
            <x-ui.empty-state
                icon="sparkles"
                title="Belum Ada Program"
                message="Program pemberdayaan komunitas akan ditampilkan di sini." />
            @endforelse
        </div>
    </div>
</section>

@endsection