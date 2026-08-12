@extends('layouts.app')
@section('title', 'Artikel & Berita - Smart Maritim Community Ngemboh')

@section('content')
<div class="bg-section-blue">
<div class="max-w-6xl mx-auto px-4 sm:px-6 pt-6 sm:pt-10 pb-12 sm:pb-16">

    {{-- Header --}}
    <div class="text-center max-w-2xl mx-auto mb-8 sm:mb-10">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-brand-navy tracking-tight break-words">
            Artikel & Berita Terbaru
        </h1>
        <p class="text-ink text-sm sm:text-base mt-3 sm:mt-4 px-2">
            Ikuti informasi terbaru mengenai kegiatan, program, serta edukasi kami terkait dengan perkembangan Smart Maritime Community di Desa Ngemboh.
        </p>
    </div>

    {{-- Tabs & Search --}}
    <div class="flex flex-col md:flex-row items-stretch md:items-center justify-between gap-4 mb-8 sm:mb-10">
        <div class="bg-neu shadow-neu-in rounded-full p-2 flex items-center gap-2 w-full md:w-auto">
            <a href="{{ request()->fullUrlWithQuery(['category' => 'berita_acara']) }}"
               class="flex-1 md:flex-none text-center whitespace-nowrap px-3 sm:px-6 py-2 rounded-full text-sm sm:text-lg font-semibold transition-all duration-300
                      {{ request('category') === 'berita_acara'
                         ? 'bg-neu shadow-neu-out text-brand-green'
                         : 'shadow-neu-in text-brand-green hover:bg-brand-green hover:text-white' }}">
                Berita Kegiatan
            </a>
            <a href="{{ request()->fullUrlWithQuery(['category' => 'produk']) }}"
               class="flex-1 md:flex-none text-center whitespace-nowrap px-3 sm:px-6 py-2 rounded-full text-sm sm:text-lg font-semibold transition-all duration-300
                      {{ request('category') === 'produk'
                         ? 'bg-neu shadow-neu-out text-brand-green'
                         : 'shadow-neu-in text-brand-green hover:bg-brand-green hover:text-white' }}">
                Artikel Produk
            </a>
        </div>

        {{-- Search --}}
        <form action="{{ route('articles.index') }}" method="GET" class="relative w-full md:w-96" x-data>
            <input type="hidden" name="category" value="{{ request('category') }}">
            {{-- per_page ikut disertakan biar filter/pencarian tidak me-reset ukuran halaman --}}
            <input type="hidden" name="per_page" value="{{ request('per_page') }}">
            <x-heroicon-o-magnifying-glass class="w-5 h-5 text-brand-green absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none" />
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari artikel atau berita..."
                   x-on:input.debounce.500ms="$el.form.submit()"
                   class="w-full bg-neu shadow-neu-in rounded-full pl-12 pr-5 py-3 text-sm italic text-brand-green placeholder-brand-green outline-none border-none focus:ring-0">
        </form>
    </div>

    {{-- Grid Artikel --}}
    {{--
        Jumlah item per halaman ditentukan lewat query string "per_page" yang
        di-sync otomatis oleh script di bawah berdasarkan lebar layar
        (window.innerWidth), lalu divalidasi & dipakai di ArticleController@index.
    --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6 lg:gap-8 mb-12">
        @forelse($articles as $article)
        <a href="{{ route('articles.show', $article) }}"
        class="group bg-neu rounded-2xl overflow-hidden shadow-neu-lg flex flex-col
                transition-all duration-300 hover:-translate-y-1">

            <div class="relative overflow-hidden">
                @if($article->thumbnail)
                <img src="{{ Storage::url($article->thumbnail) }}"
                    class="w-full h-48 sm:h-52 lg:h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                @else
                <div class="w-full h-48 sm:h-52 lg:h-56 bg-neu-alt"></div>
                @endif

                <span class="absolute top-3 left-3 bg-brand-green text-white text-[10px] sm:text-[11px] font-bold uppercase tracking-wide px-3 py-1 rounded-full">
                    {{ $article->category === 'produk' ? 'Artikel' : 'Berita' }}
                </span>
            </div>

            <div class="p-5 sm:p-6 flex flex-col flex-1">
                <div class="flex items-center gap-2 mb-3">
                    <x-heroicon-o-calendar class="w-4 h-4 text-muted shrink-0" />
                    <p class="text-[12px] sm:text-[13px] font-semibold text-ink tracking-wide">
                        {{ $article->published_at?->translatedFormat('d F Y') }}
                    </p>
                </div>

                <h3 class="text-lg sm:text-xl font-semibold text-dark leading-snug mb-3 line-clamp-2 break-words transition-colors duration-300 group-hover:text-brand-blue">
                    {{ $article->title }}
                </h3>

                <p class="text-sm sm:text-base text-ink mb-6 line-clamp-3">
                    {{ Str::limit(strip_tags($article->content), 110) }}
                </p>

                <div class="mt-auto text-center bg-brand-green shadow-neu-out rounded-xl py-2.5 sm:py-3 text-base sm:text-lg font-semibold text-white
                            transition-all duration-300 group-hover:bg-brand-blue">
                    Baca Selengkapnya
                </div>
            </div>

        </a>
        @empty
            @if(request('search') || request('category'))
                <x-ui.empty-state
                    icon="magnifying-glass"
                    title="Artikel Tidak Ditemukan"
                    message="Tidak ada artikel yang cocok dengan pencarian atau filter kamu.">
                    <x-slot:action>
                        <a href="{{ route('articles.index') }}"
                           class="inline-flex items-center gap-2 px-6 py-2.5 rounded-full bg-brand-green text-white text-sm font-semibold shadow-neu-out transition-all duration-300 hover:bg-brand-blue">
                            Reset Pencarian
                        </a>
                    </x-slot:action>
                </x-ui.empty-state>
            @else
                <x-ui.empty-state
                    icon="newspaper"
                    title="Belum Ada Artikel"
                    message="Belum ada artikel atau berita yang dipublikasikan saat ini. Silakan cek kembali nanti." />
            @endif
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="pt-2">
        <div class="overflow-x-auto py-2">
            {{ $articles->appends(request()->query())->links('vendor.pagination.neu') }}
        </div>
    </div>
</div>
</div>

@push('scripts')
<script>
(function () {
    var BREAKPOINT = 768;
    var MOBILE_PER_PAGE = 6;
    var DESKTOP_PER_PAGE = 9;

    function desiredPerPage() {
        return window.innerWidth < BREAKPOINT ? MOBILE_PER_PAGE : DESKTOP_PER_PAGE;
    }

    function currentPerPage(params) {
        var val = parseInt(params.get('per_page'), 10);
        return isNaN(val) ? DESKTOP_PER_PAGE : val;
    }

    function syncPerPage() {
        var url = new URL(window.location.href);
        var params = url.searchParams;
        var desired = desiredPerPage();

        if (currentPerPage(params) === desired) {
            return;
        }

        params.set('per_page', desired);
        params.set('page', '1'); 
        window.location.href = url.toString();
    }

    document.addEventListener('DOMContentLoaded', syncPerPage);

    var resizeTimer;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(syncPerPage, 400);
    });
})();
</script>
@endpush
@endsection