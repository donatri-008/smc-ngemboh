<div id="sambutan" class="max-w-5xl mx-auto space-y-5 sm:space-y-6 scroll-mt-40">
@foreach($sambutans as $item)
<div class="bg-white rounded-2xl shadow-[0_4px_20px_-2px_rgba(0,0,0,0.06)] border border-[#F1F5F9] p-5 sm:p-8">

    {{-- Foto + Isi: stack di mobile, sejajar di desktop --}}
    <div class="flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-10">

        {{-- Foto --}}
        <div class="w-32 h-32 sm:w-44 sm:h-44 md:w-56 md:h-56 flex-shrink-0">
            @if($item->foto)
            <img
                src="{{ asset($item->foto) }}"
                class="w-full h-full rounded-full object-cover border-4 border-gray-200 shadow-lg">
            @else
            <div class="w-full h-full rounded-full bg-gray-100 border-4 border-gray-200"></div>
            @endif
        </div>

        {{-- Judul + Isi --}}
        <div class="flex-1 min-w-0 text-center md:text-left">
            <p class="text-[11px] sm:text-xs font-bold uppercase tracking-wide text-brand-blue">
                Sambutan {{ $item->jabatan }}
            </p>
            <h3 class="text-xl sm:text-2xl md:text-3xl font-bold text-[#1E293B] mt-1 sm:mt-2">
                {{ $item->nama }}
            </h3>

            <p class="text-sm sm:text-[15px] text-[#64748B] leading-7 sm:leading-8 whitespace-pre-line text-justify mt-4 sm:mt-6">
                {{ $item->isi_sambutan }}
            </p>
        </div>

    </div>

</div>
@endforeach
</div>/div>

</div>
@endforeach
</div>