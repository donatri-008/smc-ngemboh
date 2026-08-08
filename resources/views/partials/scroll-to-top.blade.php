<button
    x-data="{ show: false }"
    x-init="window.addEventListener('scroll', () => { show = window.scrollY > 400 })"
    x-show="show"
    x-cloak
    x-on:click="window.scrollTo({ top: 0, behavior: 'smooth' })"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0 translate-y-3"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-3"
    class="fixed bottom-6 right-4 sm:right-6 z-50 w-11 h-11 sm:w-12 sm:h-12 rounded-full bg-brand-green shadow-[6px_6px_12px_rgba(0,0,0,0.15)] flex items-center justify-center transition-all duration-300 hover:scale-110 hover:bg-brand-blue active:scale-95"
    aria-label="Kembali ke atas">
    <x-heroicon-o-chevron-up class="w-5 h-5 sm:w-6 sm:h-6 text-white" />
</button>