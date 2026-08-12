<div id="sambutan" class="max-w-5xl mx-auto space-y-4 sm:space-y-6 scroll-mt-40 px-1 sm:px-0">
@foreach($sambutans as $item)
<div class="bg-white rounded-2xl shadow-[0_4px_20px_-2px_rgba(0,0,0,0.06)] border border-[#F1F5F9] p-4 sm:p-6 md:p-8">

    {{-- Foto + Isi: stack di mobile, sejajar mulai md --}}
    <div class="flex flex-col md:flex-row items-center md:items-start gap-4 sm:gap-6 md:gap-10">

        {{-- Foto --}}
        <div class="w-28 h-28 sm:w-36 sm:h-36 md:w-48 md:h-48 lg:w-56 lg:h-56 flex-shrink-0">
            @if($item->foto)
            <img
                src="{{ asset($item->foto) }}"
                alt="{{ $item->nama }}"
                class="w-full h-full rounded-full object-cover border-4 border-gray-200 shadow-lg">
            @else
            <div class="w-full h-full rounded-full bg-gray-100 border-4 border-gray-200"></div>
            @endif
        </div>

        {{-- Judul + Isi --}}
        <div class="flex-1 min-w-0 w-full text-center md:text-left">
            <p class="text-[10px] sm:text-xs font-bold uppercase tracking-wide text-brand-navy">
                Sambutan {{ $item->jabatan }}
            </p>
            <h3 class="text-lg sm:text-xl md:text-2xl lg:text-3xl font-bold text-[#1E293B] mt-1 sm:mt-2">
                {{ $item->nama }}
            </h3>

            <p class="text-sm sm:text-[15px] text-[#64748B] leading-6 sm:leading-7 md:leading-8 whitespace-pre-line text-left md:text-justify mt-3 sm:mt-5 md:mt-6">
                {{ $item->isi_sambutan }}
            </p>
        </div>

    </div>

</div>
@endforeach
</div>