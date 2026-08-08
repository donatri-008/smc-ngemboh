<div class="max-w-5xl mx-auto space-y-6">
@foreach($sambutans as $item)
<div class="bg-white rounded-2xl shadow-[0_4px_20px_-2px_rgba(0,0,0,0.06)] border border-[#F1F5F9] p-8">

    {{-- Judul --}}
    <div class="ml-72 mb-6">
        <p class="text-xs font-bold uppercase tracking-wide text-brand-blue">
            Sambutan {{ $item->jabatan }}
        </p>

        <h3 class="text-3xl font-bold text-[#1E293B] mt-2">
            {{ $item->nama }}
        </h3>
    </div>

    {{-- Foto + Isi --}}
    <div class="flex items-start gap-10">

        {{-- Foto --}}
        <div class="w-56 flex-shrink-0 flex justify-center">
            @if($item->foto)
                <img
                    src="{{ asset('assets/' . $item->foto) }}"
                    class="w-56 h-56 rounded-full object-cover border-4 border-gray-200 shadow-lg">
            @endif
        </div>

        {{-- Isi Sambutan --}}
        <div class="flex-1 max-w-4xl ml-8">
            <p class="text-[15px] text-[#64748B] leading-8 whitespace-pre-line text-justify">
                {{ $item->isi_sambutan }}
            </p>
        </div>

    </div>

</div>
@endforeach
</div>
