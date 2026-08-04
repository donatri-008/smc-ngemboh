<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @foreach(['sambutan' => 'Sambutan', 'sejarah' => 'Sejarah', 'visi_misi' => 'Visi & Misi', 'lambang' => 'Lambang'] as $key => $label)
    @if(isset($contents[$key]))
    <x-ui.card>
        <h2 class="font-semibold text-gray-700 mb-3">{{ $label }}</h2>
        <p class="text-sm text-gray-500 leading-relaxed">{{ $contents[$key] }}</p>
    </x-ui.card>
    @endif
    @endforeach
</div>