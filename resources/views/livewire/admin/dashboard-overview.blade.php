<div class="space-y-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-700">Selamat datang, {{ auth()->user()->name }}</h1>
        <p class="text-sm text-gray-500">{{ now()->translatedFormat('l, d F Y') }}</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @foreach([
            ['label' => 'Total Artikel & Berita', 'value' => $totalArticles, 'icon' => 'newspaper'],
            ['label' => 'Total Produk', 'value' => $totalProducts, 'icon' => 'shopping-bag'],
            ['label' => 'Total Anggota Tim', 'value' => $totalTeam, 'icon' => 'users'],
            ['label' => 'Total Dokumen Legalitas', 'value' => $totalLegalities, 'icon' => 'document-check'],
        ] as $card)
        <div class="bg-neu rounded-2xl shadow-neu-out p-6 flex flex-col items-start gap-3">
            <div class="w-12 h-12 rounded-xl bg-neu shadow-neu-in flex items-center justify-center">
                <x-heroicon-o-{{ $card['icon'] }} class="w-6 h-6 text-indigo-500" />
            </div>
            <div class="text-3xl font-bold text-gray-700">{{ $card['value'] }}</div>
            <div class="text-sm text-gray-500">{{ $card['label'] }}</div>
        </div>
        @endforeach
    </div>

    <div class="bg-neu rounded-2xl shadow-neu-out p-6">
        <h2 class="font-semibold text-gray-700 mb-4">Aktivitas Kelola Data 6 Bulan Terakhir</h2>
        <canvas id="activity-chart" height="90"></canvas>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-neu rounded-2xl shadow-neu-out p-6">
            <h2 class="font-semibold text-gray-700 mb-4">Aktivitas Terbaru</h2>
            <ul class="space-y-4">
                @forelse($recentActivities as $log)
                <li class="flex justify-between items-center border-b border-gray-200/60 pb-2 last:border-0">
                    <div>
                        <p class="text-sm text-gray-700">{{ $log->description }}</p>
                        <p class="text-xs text-gray-400">oleh {{ $log->user->name ?? 'Admin' }}</p>
                    </div>
                    <span class="text-xs text-gray-400">{{ $log->created_at->diffForHumans() }}</span>
                </li>
                @empty
                <p class="text-sm text-gray-400">Belum ada aktivitas.</p>
                @endforelse
            </ul>
        </div>

        <div class="bg-neu rounded-2xl shadow-neu-out p-6 flex flex-col gap-4">
            <h2 class="font-semibold text-gray-700 mb-2">Shortcut Cepat</h2>
            <a href="{{ route('admin.articles') }}" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-4 py-3 text-sm font-medium text-gray-700 text-center transition">+ Tambah Artikel</a>
            <a href="{{ route('admin.products') }}" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-4 py-3 text-sm font-medium text-gray-700 text-center transition">+ Tambah Produk</a>
            <a href="{{ route('admin.team') }}" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-4 py-3 text-sm font-medium text-gray-700 text-center transition">+ Tambah Anggota Tim</a>
        </div>
    </div>
</div>

@push('scripts')
<script>
new Chart(document.getElementById('activity-chart'), {
    type: 'line',
    data: {
        labels: @json($chartLabels),
        datasets: [{
            label: 'Artikel/Berita Ditambahkan',
            data: @json($chartData),
            borderColor: '#6366f1',
            backgroundColor: 'rgba(99,102,241,0.15)',
            tension: 0.4,
            fill: true,
        }]
    },
    options: { plugins: { legend: { display: false } } }
});
</script>
@endpush