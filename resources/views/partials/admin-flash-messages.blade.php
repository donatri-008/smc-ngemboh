@if (session('success'))
<div x-data="{ show: true }"
     x-init="setTimeout(() => show = false, 4000)"
     x-show="show"
     x-cloak
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 -translate-x-10"
     x-transition:enter-end="opacity-100 translate-x-0"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="opacity-100 translate-x-0"
     x-transition:leave-end="opacity-0 -translate-x-10"
     class="fixed top-24 right-6 z-[9999] flex items-center gap-3 bg-[#F9F9FF] shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] rounded-2xl pl-4 pr-5 py-4 max-w-sm">
    <div class="w-8 h-8 rounded-full bg-[#4CC71C] flex items-center justify-center shrink-0">
        <x-heroicon-o-check class="w-5 h-5 text-white" />
    </div>
    <p class="text-sm font-semibold text-[#181C23]">{{ session('success') }}</p>
</div>
@endif

@if (session('error'))
<div x-data="{ show: true }"
    x-init="setTimeout(() => show = false, 4000)"
    x-show="show"
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 -translate-x-10"
    x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 -translate-x-10"
    class="fixed top-24 right-6 z-[9999] flex items-center gap-3 bg-[#F9F9FF] shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] rounded-2xl pl-4 pr-5 py-4 max-w-sm">
    <div class="w-8 h-8 rounded-full bg-[#FF383C] flex items-center justify-center shrink-0">
        <x-heroicon-o-x-mark class="w-5 h-5 text-white" />
    </div>
    <p class="text-sm font-semibold text-[#181C23]">{{ session('error') }}</p>
</div>
@endif