<div class="space-y-6 sm:space-y-8 max-w-6xl">
    <div>
        <p class="text-xs sm:text-sm font-bold text-blue-500 tracking-widest uppercase mb-1">Dashboard</p>
        <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-blue-500">Admin Overview: SMC Ngemboh</h1>
    </div>

    {{-- Bento Stats Grid --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-6">
        @foreach([
            ['label' => 'Total Artikel', 'value' => $totalArticles, 'icon' => 'newspaper'],
            ['label' => 'Total Produk', 'value' => $totalProducts, 'icon' => 'shopping-cart'],
            ['label' => 'Total Anggota Tim', 'value' => $totalTeam, 'icon' => 'user-group'],
            ['label' => 'Total Dokumen Legal', 'value' => $totalLegalities, 'icon' => 'folder'],
        ] as $card)
        <x-ui.stat-card :label="$card['label']" :value="$card['value']" :icon="$card['icon']" value-size="text-2xl sm:text-4xl" />
        @endforeach
    </div>

    {{-- Activity --}}
    <div class="bg-neu rounded-2xl sm:rounded-[40px] shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] p-4 sm:p-8 space-y-4 sm:space-y-8">
        <h2 class="text-lg sm:text-2xl font-semibold text-blue-500">Aktivitas Terbaru</h2>

        {{-- Mobile: stacked cards --}}
        <div class="sm:hidden space-y-3">
            @forelse($recentActivities as $log)
            <div class="rounded-2xl shadow-[inset_4px_4px_8px_#D1D9E6,inset_-4px_-4px_8px_#FFFFFF] p-4 space-y-3">
                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center shrink-0">
                        <x-dynamic-component :component="'heroicon-o-' . $this->activityIcon($log->module)" class="w-4 h-4 text-brand-green" />
                    </div>
                    <span class="text-gray-900 text-sm leading-snug flex-1 min-w-0 break-words">{{ $log->description }}</span>
                    <span class="inline-block px-2.5 py-1 rounded-full text-[10px] font-bold text-white bg-brand-green shrink-0">
                        Sukses
                    </span>
                </div>
                <div class="flex items-center justify-between text-xs text-gray-500 pl-11">
                    <span class="truncate">{{ $log->user->name ?? 'Admin' }}</span>
                    <span class="shrink-0 ml-2">{{ $log->created_at->format('H.i') }}</span>
                </div>
            </div>
            @empty
            <x-ui.table-empty-state
                icon="clock"
                title="Belum Ada Aktivitas"
                message="Riwayat aktivitas admin akan muncul di sini setelah ada perubahan data." />
            @endforelse
        </div>

        {{-- Tablet/desktop: table with horizontal scroll safety net --}}
        <div class="hidden sm:block p-1 rounded-2xl shadow-[inset_4px_4px_8px_#D1D9E6,inset_-4px_-4px_8px_#FFFFFF] overflow-x-auto">
            <table class="w-full text-sm min-w-[560px]">
                <thead>
                    <tr class="bg-blue-50 rounded-xl">
                        <th class="text-left font-bold text-gray-700 px-4 py-4 rounded-l-xl">Update Type</th>
                        <th class="text-left font-bold text-gray-700 px-4 py-4">Pengguna</th>
                        <th class="text-left font-bold text-gray-700 px-4 py-4">Waktu</th>
                        <th class="text-left font-bold text-gray-700 px-4 py-4 rounded-r-xl">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentActivities as $log)
                    <tr class="border-t border-gray-200/60">
                        <td class="px-4 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg shadow-[6px_6px_12px_#D1D9E6,-6px_-6px_12px_#FFFFFF] flex items-center justify-center shrink-0">
                                    <x-dynamic-component :component="'heroicon-o-' . $this->activityIcon($log->module)" class="w-4 h-4 text-brand-green" />
                                </div>
                                <span class="text-gray-900">{{ $log->description }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-4 text-gray-600 whitespace-nowrap">{{ $log->user->name ?? 'Admin' }}</td>
                        <td class="px-4 py-4 text-gray-600 whitespace-nowrap">{{ $log->created_at->format('H.i') }}</td>
                        <td class="px-4 py-4">
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold text-white bg-brand-green">
                                Sukses
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">
                            <x-ui.table-empty-state
                                icon="clock"
                                title="Belum Ada Aktivitas"
                                message="Riwayat aktivitas admin akan muncul di sini setelah ada perubahan data." />
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>