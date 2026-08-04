<div class="space-y-6">
    @if (session('success'))
    <div class="bg-neu shadow-neu-in rounded-xl px-4 py-3 text-sm text-green-600">{{ session('success') }}</div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-xl font-bold text-gray-700">Kelola Data Statistik</h1>
        <button wire:click="create" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-indigo-600 transition">
            + Tambah Data
        </button>
    </div>

    <div class="flex gap-3">
        @foreach(['lingkungan' => 'Lingkungan', 'demografi' => 'Demografi Nelayan'] as $key => $label)
        <button wire:click="setTab('{{ $key }}')"
                class="px-5 py-2 rounded-xl text-sm font-medium transition
                {{ $activeType === $key ? 'bg-neu shadow-neu-in text-indigo-600' : 'bg-neu shadow-neu-out text-gray-500' }}">
            {{ $label }}
        </button>
        @endforeach
    </div>

    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari kategori..."
        class="bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm w-full sm:w-72 outline-none">

    <div class="bg-neu rounded-2xl shadow-neu-out p-4 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="text-left text-gray-500 border-b border-gray-200/60">
                    <th class="py-3 px-2">Kategori</th>
                    <th class="py-3 px-2">Label</th>
                    <th class="py-3 px-2">Nilai</th>
                    <th class="py-3 px-2">Tahun</th>
                    <th class="py-3 px-2 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($stats as $stat)
                <tr class="border-b border-gray-100 last:border-0">
                    <td class="py-3 px-2 text-gray-700 font-medium">{{ $stat->kategori }}</td>
                    <td class="py-3 px-2 text-gray-600">{{ $stat->label }}</td>
                    <td class="py-3 px-2 text-gray-600">{{ number_format($stat->value, 0, ',', '.') }}</td>
                    <td class="py-3 px-2 text-gray-500">{{ $stat->tahun }}</td>
                    <td class="py-3 px-2 text-right space-x-2">
                        <button wire:click="edit({{ $stat->id }})" class="text-indigo-500 hover:underline text-xs">Edit</button>
                        <button wire:click="confirmDelete({{ $stat->id }})" class="text-red-500 hover:underline text-xs">Hapus</button>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="py-6 text-center text-gray-400">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $stats->links() }}

    @if($showModal)
    <div class="fixed inset-0 bg-black/30 flex items-center justify-center z-50 p-4">
        <div class="bg-neu rounded-2xl shadow-neu-out p-6 w-full max-w-md space-y-4">
            <h2 class="font-semibold text-gray-700">
                {{ $statId ? 'Edit Data Statistik' : 'Tambah Data Statistik' }}
                ({{ $activeType === 'lingkungan' ? 'Lingkungan' : 'Demografi' }})
            </h2>

            <div>
                <label class="text-xs text-gray-500">Kategori</label>
                <input wire:model="kategori" type="text" placeholder="mis. Jumlah Nelayan / Kualitas Air"
                    class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                @error('kategori') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs text-gray-500">Label (sumbu chart)</label>
                    <input wire:model="label" type="text" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                    @error('label') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="text-xs text-gray-500">Nilai</label>
                    <input wire:model="value" type="number" step="0.01" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                    @error('value') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label class="text-xs text-gray-500">Tahun</label>
                <input wire:model="tahun" type="number" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                @error('tahun') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs text-gray-500">Deskripsi</label>
                <textarea wire:model="deskripsi" rows="3" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-2">
                <button wire:click="$set('showModal', false)" class="px-4 py-2 text-sm text-gray-500">Batal</button>
                <button wire:click="save" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-indigo-600">Simpan</button>
            </div>
        </div>
    </div>
    @endif

    @if($showDeleteModal)
    <div class="fixed inset-0 bg-black/30 flex items-center justify-center z-50 p-4">
        <div class="bg-neu rounded-2xl shadow-neu-out p-6 w-full max-w-sm space-y-4 text-center">
            <p class="text-gray-700">Yakin ingin menghapus data ini?</p>
            <div class="flex justify-center gap-3">
                <button wire:click="$set('showDeleteModal', false)" class="px-4 py-2 text-sm text-gray-500">Batal</button>
                <button wire:click="delete" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-red-500">Hapus</button>
            </div>
        </div>
    </div>
    @endif
</div>