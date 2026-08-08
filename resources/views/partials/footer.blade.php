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
                <img src="{{ asset('assets/logo/utama/Logo Tutwuri.png') }}" alt="Kemendikbud" class="h-8 md:h-10 object-contain">
                <img src="{{ asset('assets/logo/utama/Logo Kampus Berdampak.png') }}" alt="Kampus Berdampak" class="h-8 md:h-10 object-contain">
                <img src="{{ asset('assets/logo/utama/Logo Belmawa.png') }}" alt="Belmawa" class="h-8 md:h-10 object-contain">
                <img src="{{ asset('assets/logo/utama/Logo Unesa.png') }}" alt="Universitas Negeri Surabaya" class="h-8 md:h-10 object-contain">
                <img src="{{ asset('assets/logo/utama/Logo Gresik.png') }}" alt="Pemkab Gresik" class="h-8 md:h-10 object-contain">
                <img src="{{ asset('assets/logo/utama/Logo DPM FIP.png') }}" alt="DPM FIP" class="h-8 md:h-10 object-contain">
                <img src="{{ asset('assets/logo/utama/Logo PPK Ormawa 2026.png') }}" alt="PPK Ormawa 2026" class="h-8 md:h-10 object-contain">
            </div>
        </div>
    </div>
</footer>