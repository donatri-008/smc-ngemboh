@extends('layouts.app')
@section('title', 'Data Demografi - Smart Maritim Community Ngemboh')

@section('content')
<div class="bg-section-blue">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 pt-10 sm:pt-16 pb-8 sm:pb-10 text-center space-y-3 sm:space-y-4">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-brand-navy tracking-tight break-words">Data Demografi</h1>
        <p class="text-sm sm:text-base text-ink max-w-xl mx-auto">Pemaparan terkait data kependudukan dan kondisi sosial masyarakat Desa Ngemboh sebagai gambaran karakteristik wilayah</p>
        @include('partials.data-tab-switcher', ['active' => 'demografi'])
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 space-y-10 sm:space-y-12 pb-16">
        {{-- Ringkasan Demografi --}}
        <section class="space-y-5 sm:space-y-6">
            <h2 class="text-xl sm:text-2xl font-bold text-blue-700 flex items-center gap-2">
                <x-heroicon-o-chart-bar-square class="w-5 h-5 sm:w-6 sm:h-6" /> Ringkasan Demografi
            </h2>

            @php
                $statIcons = [
                    'penduduk' => 'users',
                    'nelayan' => 'lifebuoy',
                    'pendapatan_nelayan' => 'banknotes',
                    'anggota_smc' => 'user-group',
                    'pembudidaya_kerang_hijau' => 'beaker',
                ];
            @endphp

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-3 sm:gap-4">
                @foreach($summary as $key => $item)
                <div class="bg-white rounded-2xl shadow-sm p-4 sm:p-6 text-center space-y-2">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-full bg-blue-50 flex items-center justify-center mx-auto shadow-inner">
                        <x-dynamic-component :component="'heroicon-o-' . ($statIcons[$key] ?? 'chart-bar')" class="w-4 h-4 sm:w-5 sm:h-5 text-[#4CC71C]" />
                    </div>
                    <p class="text-xl sm:text-2xl md:text-3xl font-bold text-blue-700 break-words">
                        @if($item['value'] === null) - @elseif($key === 'pendapatan_nelayan') Rp{{ number_format($item['value'],0,',','.') }} @else {{ number_format($item['value'],0,',','.') }} @endif
                    </p>
                    <p class="text-[11px] sm:text-xs text-gray-500">{{ $item['label'] }} @if($item['unit'])@endif</p>
                </div>
                @endforeach
            </div>
        </section>

        {{-- Distribusi Data --}}
        <section class="space-y-5 sm:space-y-6">
            <h2 class="text-xl sm:text-2xl font-bold text-blue-700 flex items-center gap-2">
                <x-heroicon-o-chart-pie class="w-5 h-5 sm:w-6 sm:h-6" /> Distribusi Data
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 sm:gap-6">
                <div class="bg-white rounded-2xl shadow-sm p-5 sm:p-8 space-y-5 sm:space-y-6">
                    <h3 class="font-bold text-blue-700 text-sm sm:text-base">Anggota SMC</h3>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-5 sm:gap-10">
                        <div class="w-[120px] h-[120px] sm:w-[150px] sm:h-[150px] shrink-0">
                            <canvas id="chart-anggota-smc"></canvas>
                        </div>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="w-3 h-3 rounded-full bg-[#4CC71C] shrink-0"></span>
                            <span class="text-gray-500">Anggota SMC</span>
                            <span class="font-medium text-gray-700">{{ $anggotaSmcCount }} Keluarga</span>
                        </div>
                    </div>
                    <div class="bg-slate-50 rounded-xl p-4 text-xs text-gray-500 leading-relaxed">
                        SMC (Smart Maritime Community) di Desa Ngemboh terdiri dari {{ $anggotaSmcCount }} keluarga yang tergabung dalam beberapa kelompok kerja.
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-5 sm:p-8 space-y-5 sm:space-y-6">
                    <h3 class="font-bold text-blue-700 text-sm sm:text-base">Komposisi Demografi</h3>
                    <div class="space-y-4">
                        @php $max = collect($summary)->max(fn($i) => $i['value'] ?? 0) ?: 1; @endphp
                        @foreach($summary as $key => $item)
                        <div class="space-y-1">
                            <div class="flex flex-wrap justify-between gap-x-2 text-xs text-gray-600">
                                <span>{{ $item['label'] }}</span>
                                <span>{{ $item['value'] !== null ? number_format($item['value'],0,',','.') . ' ' . $item['unit'] : 'Belum tersedia' }}</span>
                            </div>
                            <div class="w-full h-2 bg-gray-200 rounded-full">
                                <div class="h-2 bg-[#4CC71C] rounded-full" style="width: {{ $item['value'] ? min(100, ($item['value']/$max)*100) : 0 }}%"></div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- Daftar Kelompok SMC --}}
        <section class="space-y-5 sm:space-y-6">
            <h2 class="text-xl sm:text-2xl font-bold text-blue-700 flex items-center gap-2">
                <x-heroicon-o-users class="w-5 h-5 sm:w-6 sm:h-6" /> Daftar Kelompok SMC
            </h2>

            @php
                $anggotaSmc = \App\Models\DemographicEntry::where('kategori', 'anggota_smc')
                    ->orderBy('nama')
                    ->get()
                    ->groupBy('data_spesifik');
            @endphp

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5 sm:gap-6">
                @forelse($anggotaSmc as $kelompok => $anggota)
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    {{-- Header kelompok --}}
                    <div class="bg-blue-50 px-5 sm:px-8 py-4 sm:py-6 border-b border-gray-200">
                        <h3 class="text-blue-700 font-medium text-sm sm:text-base">{{ $kelompok }}</h3>
                    </div>

                    @php
                        $rows = (int) ceil($anggota->count() / 3);
                        $rowsMobile = (int) ceil($anggota->count() / 2);
                    @endphp
                    <div class="px-5 sm:px-8 py-2 max-h-72 overflow-y-auto">
                        {{-- Mobile: 2 kolom --}}
                        <div class="sm:hidden grid gap-x-4" style="grid-template-columns: repeat(2, minmax(0, 1fr)); grid-template-rows: repeat({{ $rowsMobile }}, minmax(0, 1fr)); grid-auto-flow: column;">
                            @foreach($anggota as $index => $a)
                            <p class="py-3 text-sm text-gray-600 border-t border-gray-100 truncate {{ $index % $rowsMobile === 0 ? 'border-t-0' : '' }}"
                            title="{{ $index + 1 }}. {{ $a->nama }}">
                                {{ $index + 1 }}. {{ $a->nama }}
                            </p>
                            @endforeach
                        </div>
                        {{-- sm ke atas: 3 kolom seperti semula --}}
                        <div class="hidden sm:grid gap-x-4" style="grid-template-columns: repeat(3, minmax(0, 1fr)); grid-template-rows: repeat({{ $rows }}, minmax(0, 1fr)); grid-auto-flow: column;">
                            @foreach($anggota as $index => $a)
                            <p class="py-4 text-sm text-gray-600 border-t border-gray-100 truncate {{ $index % $rows === 0 ? 'border-t-0' : '' }}"
                            title="{{ $index + 1 }}. {{ $a->nama }}">
                                {{ $index + 1 }}. {{ $a->nama }}
                            </p>
                            @endforeach
                        </div>
                    </div>
                </div>
                @empty
                <x-ui.empty-state message="Belum ada data kelompok SMC." />
                @endforelse
            </div>
        </section>
    </div>
</div>

@push('scripts')
<script>
new Chart(document.getElementById('chart-anggota-smc'), {
    type: 'doughnut',
    data: {
        labels: ['Anggota SMC'],
        datasets: [{ data: [{{ $anggotaSmcCount ?: 1 }}], backgroundColor: ['#4CC71C'], borderWidth: 0 }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        cutout: '70%',
        plugins: { legend: { display: false } }
    }
});
</script>
@endpush
@endsection