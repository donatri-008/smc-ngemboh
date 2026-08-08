<div class="flex justify-center px-4">
    <div class="bg-neu shadow-neu-in rounded-full p-2 flex gap-1 sm:gap-2 w-full max-w-md sm:w-auto overflow-x-auto">
        <a href="{{ route('demographic.index') }}"
           class="flex-1 sm:flex-none text-center whitespace-nowrap px-4 sm:px-6 py-2 rounded-full text-xs sm:text-sm font-semibold text-[#4CC71C] transition-all duration-200
           {{ $active === 'demografi' ? 'bg-neu shadow-neu-out' : 'shadow-neu-in text-brand-green hover:bg-brand-green hover:text-white' }}">
            Data Demografi
        </a>
        <a href="{{ route('environment.index') }}"
           class="flex-1 sm:flex-none text-center whitespace-nowrap px-4 sm:px-6 py-2 rounded-full text-xs sm:text-sm font-semibold text-[#4CC71C] transition-all duration-200
           {{ $active === 'lingkungan' ? 'bg-neu shadow-neu-out' : 'shadow-neu-in text-brand-green hover:bg-brand-green hover:text-white' }}">
            Info Lingkungan
        </a>
    </div>
</div>