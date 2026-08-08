<div
    x-data="{ show: false, type: 'success', message: '' }"
    x-on:toast.window="
        type = $event.detail.type;
        message = $event.detail.message;
        show = true;
        clearTimeout(window.__toastTimeoutId);
        window.__toastTimeoutId = setTimeout(() => show = false, 3000);
    "
    x-init="
        @if (session('success')) window.showToast('success', @js(session('success'))); @endif
        @if (session('error')) window.showToast('error', @js(session('error'))); @endif
    "
    x-show="show"
    x-cloak
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 -translate-x-10"
    x-transition:enter-end="opacity-100 translate-x-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-x-0"
    x-transition:leave-end="opacity-0 -translate-x-10"
    class="fixed top-24 right-6 z-50 flex items-center gap-3 bg-neu shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] rounded-2xl pl-4 pr-5 py-4 max-w-sm"
>
    <div class="w-8 h-8 rounded-full flex items-center justify-center shrink-0"
        :class="type === 'success' ? 'bg-brand-green' : 'bg-red-500'">
        <x-heroicon-o-check class="w-5 h-5 text-white" x-show="type === 'success'" />
        <x-heroicon-o-x-mark class="w-5 h-5 text-white" x-show="type === 'error'" />
    </div>
    <p class="text-sm font-semibold text-ink" x-text="message"></p>
</div>