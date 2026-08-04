@extends('layouts.app')
@section('title', 'Info Lingkungan - Smart Maritim Community Ngemboh')

@section('content')
<div class="pt-10 space-y-10">
    <h1 class="text-2xl font-bold text-gray-700">Info Lingkungan</h1>

    {{-- Info & Peraturan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach(['informasi' => 'Informasi', 'peraturan' => 'Peraturan'] as $key => $label)
        <x-ui.card class="space-y-4">
            <h2 class="font-semibold text-gray-700">{{ $label }}</h2>
            @forelse($infos->where('category', $key) as $info)
            <div class="bg-neu rounded-xl shadow-neu-in p-4">
                <p class="font-medium text-gray-700 text-sm">{{ $info->title }}</p>
                <p class="text-xs text-gray-500 mt-1">{{ Str::limit(strip_tags($info->content), 120) }}</p>
            </div>
            @empty
            <x-ui.empty-state message="Belum ada data." />
            @endforelse
        </x-ui.card>
        @endforeach
    </div>

    {{-- Statistik --}}
    <div class="space-y-6">
        <h2 class="text-xl font-bold text-gray-700">Data Statistik Lingkungan</h2>
        @forelse($stats as $kategori => $items)
        <x-ui.card>
            <h3 class="font-semibold text-gray-700 mb-4">{{ $kategori }}</h3>
            <canvas id="chart-{{ Str::slug($kategori) }}" height="90"></canvas>
        </x-ui.card>
        @empty
        <x-ui.empty-state message="Belum ada data statistik." />
        @endforelse
    </div>
</div>

@push('scripts')
<script>
@foreach($stats as $kategori => $items)
new Chart(document.getElementById('chart-{{ Str::slug($kategori) }}'), {
    type: 'line',
    data: {
        labels: @json($items->pluck('label')),
        datasets: [{
            label: '{{ $kategori }}',
            data: @json($items->pluck('value')),
            borderColor: '#6366f1',
            backgroundColor: 'rgba(99,102,241,0.15)',
            tension: 0.4,
            fill: true,
        }]
    },
    options: { plugins: { legend: { display: false } } }
});
@endforeach
</script>
@endpush
@endsection