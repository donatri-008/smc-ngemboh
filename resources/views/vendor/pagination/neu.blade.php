@if ($paginator->hasPages())
<nav class="flex items-center justify-center gap-3 mt-4">

    {{-- Prev --}}
    @if ($paginator->onFirstPage())
        <span class="w-10 h-10 rounded-full bg-neu shadow-neu-out flex items-center justify-center opacity-40">
            <x-heroicon-o-chevron-left class="w-4 h-4 text-brand-blue" />
        </span>
    @else
        <a href="{{ $paginator->previousPageUrl() }}"
           class="w-10 h-10 rounded-full bg-neu shadow-neu-out flex items-center justify-center transition hover:scale-105">
            <x-heroicon-o-chevron-left class="w-4 h-4 text-brand-blue" />
        </a>
    @endif

    {{-- Halaman --}}
    @foreach ($elements as $element)
        @if (is_string($element))
            <span class="w-10 h-10 flex items-center justify-center text-ink">{{ $element }}</span>
        @endif

        @if (is_array($element))
            @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                    <span class="w-10 h-10 rounded-full bg-brand-green shadow-neu-out flex items-center justify-center text-white font-semibold">
                        {{ $page }}
                    </span>
                @else
                    <a href="{{ $url }}"
                       class="w-10 h-10 rounded-full bg-neu shadow-neu-out flex items-center justify-center text-ink font-semibold transition hover:scale-105">
                        {{ $page }}
                    </a>
                @endif
            @endforeach
        @endif
    @endforeach

    {{-- Next --}}
    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
           class="w-10 h-10 rounded-full bg-neu shadow-neu-out flex items-center justify-center transition hover:scale-105">
            <x-heroicon-o-chevron-right class="w-4 h-4 text-brand-blue" />
        </a>
    @else
        <span class="w-10 h-10 rounded-full bg-neu shadow-neu-out flex items-center justify-center opacity-40">
            <x-heroicon-o-chevron-right class="w-4 h-4 text-brand-blue" />
        </span>
    @endif
</nav>
@endif