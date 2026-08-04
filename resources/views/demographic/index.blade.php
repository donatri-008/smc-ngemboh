@extends('layouts.app')
@section('title', 'Demografi Nelayan - Smart Maritim Community Ngemboh')

@section('content')
<div class="pt-10 space-y-8">
    <h1 class="text-2xl font-bold text-gray-700">Demografi Nelayan</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @forelse($stats as $kategori => $items)
        <x-ui.card>
            <h3 class="font-semibold text-gray-700 mb-4">{{ $kategori }}</h3>
            <canvas id="chart-{{ Str::slug($kategori) }}" height="90"></canvas>
            @if($items->first()->deskripsi)
            <p class="text-xs text-gray-500 mt-4">{{ $items->first()->deskripsi }}</p>
            @endif
        </x-ui.card>
        @empty
        <x-ui.empty-state message="Belum ada data demografi." />
        @endforelse
    </div>
</div>

@push('scripts')
<script>
@foreach($stats as $kategori => $items)
new Chart(document.getElementById('chart-{{ Str::slug($kategori) }}'), {
    type: 'bar',
    data: {
        labels: @json($items->pluck('label')),
        datasets: [{
            label: '{{ $kategori }}',
            data: @json($items->pluck('value')),
            backgroundColor: '#6366f1',
        }]
    },
    options: { plugins: { legend: { display: false } } }
});
@endforeach
</script>
@endpush
@endsection