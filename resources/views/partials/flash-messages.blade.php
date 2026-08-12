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
    x-transition:enter-start="opacity-0 -translate-y-4 sm:translate-y-0 sm:-translate-x-10"
    x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0 sm:translate-x-0"
    x-transition:leave-end="opacity-0 -translate-y-4 sm:translate-y-0 sm:-translate-x-10"
    class="fixed top-20 inset-x-4 sm:inset-x-auto sm:top-24 sm:right-6 z-50 flex items-center gap-3 bg-neu shadow-neu-flat rounded-2xl pl-4 pr-4 sm:pr-5 py-3 sm:py-4 w-auto sm:max-w-sm"
>
    <div class="w-7 h-7 sm:w-8 sm:h-8 rounded-full flex items-center justify-center shrink-0"
        :class="type === 'success' ? 'bg-brand-green' : 'bg-red-500'">
        <x-heroicon-o-check class="w-4 h-4 sm:w-5 sm:h-5 text-white" x-show="type === 'success'" />
        <x-heroicon-o-x-mark class="w-4 h-4 sm:w-5 sm:h-5 text-white" x-show="type === 'error'" />
    </div>
    <p class="text-xs sm:text-sm font-semibold text-ink break-words" x-text="message"></p>
</div>