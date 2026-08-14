{{-- resources/views/partials/footer.blade.php --}}
<footer class="bg-neu shadow-neu-footer">
    <div class="max-w-6xl mx-auto px-6 py-10 flex flex-col md:flex-row items-center justify-between gap-8">

        <div class="text-center md:text-left">
            <p class="font-bold text-lg md:text-xl text-brand-navy">Smart Maritim Community Ngemboh</p>
            <p class="text-sm md:text-base text-ink mt-1">&copy; {{ now()->year }} Smart Maritim Community Ngemboh. All rights reserved.</p>
        </div>

        <div class="text-center w-full md:w-auto">
            <p class="font-semibold text-brand-navy mb-3 text-sm md:text-base">Bagian dari</p>
            <div class="flex flex-wrap items-center justify-center gap-4 md:gap-5">
                <img src="{{ asset('assets/logo/utama/Logo Tutwuri.webp') }}" alt="Kemendikbud" width="120" height="120" loading="lazy" decoding="async" class="h-8 md:h-10 w-auto object-contain">
                <img src="{{ asset('assets/logo/utama/Logo Kampus Berdampak.webp') }}" alt="Kampus Berdampak" width="120" height="120" loading="lazy" decoding="async" class="h-8 md:h-10 w-auto object-contain">
                <img src="{{ asset('assets/logo/utama/Logo Belmawa.webp') }}" alt="Belmawa" width="120" height="120" loading="lazy" decoding="async" class="h-8 md:h-10 w-auto object-contain">
                <img src="{{ asset('assets/logo/utama/Logo Unesa.webp') }}" alt="Universitas Negeri Surabaya" width="120" height="120" loading="lazy" decoding="async" class="h-8 md:h-10 w-auto object-contain">
                <img src="{{ asset('assets/logo/utama/Logo Gresik.webp') }}" alt="Pemkab Gresik" width="120" height="120" loading="lazy" decoding="async" class="h-8 md:h-10 w-auto object-contain">
                <img src="{{ asset('assets/logo/utama/Logo DPM FIP.webp') }}" alt="DPM FIP" width="120" height="120" loading="lazy" decoding="async" class="h-8 md:h-10 w-auto object-contain">
                <img src="{{ asset('assets/logo/utama/Logo PPK Ormawa 2026.webp') }}" alt="PPK Ormawa 2026" width="120" height="120" loading="lazy" decoding="async" class="h-8 md:h-10 w-auto object-contain">
            </div>
        </div>
    </div>
</footer>