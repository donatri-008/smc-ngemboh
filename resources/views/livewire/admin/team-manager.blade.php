<div class="space-y-6">
    @if (session('success'))
    <div class="bg-neu shadow-neu-in rounded-xl px-4 py-3 text-sm text-green-600">{{ session('success') }}</div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <h1 class="text-xl font-bold text-gray-700">Kelola Profil Tim</h1>
        <button wire:click="create" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-indigo-600 transition">
            + Tambah Anggota
        </button>
    </div>

    <div class="flex gap-3">
        @foreach(['BPH' => 'BPH', 'Penanggung Jawab' => 'Penanggung Jawab', 'PPK Ormawa' => 'PPK Ormawa'] as $key => $label)
        <button wire:click="setTab('{{ $key }}')"
                class="px-5 py-2 rounded-xl text-sm font-medium transition
                {{ $activeTab === $key ? 'bg-neu shadow-neu-in text-indigo-600' : 'bg-neu shadow-neu-out text-gray-500' }}">
            {{ $label }}
        </button>
        @endforeach
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        @forelse($members as $member)
        <div class="bg-neu rounded-2xl shadow-neu-out p-5 text-center space-y-3">
            @if($member->foto)
            <img src="{{ Storage::url($member->foto) }}" class="w-20 h-20 rounded-full object-cover mx-auto shadow-neu-in">
            @else
            <div class="w-20 h-20 rounded-full bg-neu shadow-neu-in mx-auto"></div>
            @endif
            <div>
                <p class="font-semibold text-gray-700 text-sm">{{ $member->nama }}</p>
                <p class="text-xs text-gray-500">{{ $member->jabatan }}</p>
            </div>
            <div class="flex justify-center gap-3">
                <button wire:click="edit({{ $member->id }})" class="text-indigo-500 hover:underline text-xs">Edit</button>
                <button wire:click="confirmDelete({{ $member->id }})" class="text-red-500 hover:underline text-xs">Hapus</button>
            </div>
        </div>
        @empty
        <p class="text-sm text-gray-400 col-span-full text-center py-6">Belum ada anggota di tim ini.</p>
        @endforelse
    </div>

    @if($showModal)
    <div class="fixed inset-0 bg-black/30 flex items-center justify-center z-50 p-4">
        <div class="bg-neu rounded-2xl shadow-neu-out p-6 w-full max-w-md space-y-4">
            <h2 class="font-semibold text-gray-700">{{ $teamId ? 'Edit Anggota' : 'Tambah Anggota' }}</h2>

            <div>
                <label class="text-xs text-gray-500">Nama</label>
                <input wire:model="nama" type="text" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                @error('nama') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="text-xs text-gray-500">Jabatan</label>
                <input wire:model="jabatan" type="text" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                @error('jabatan') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs text-gray-500">Kategori</label>
                    <select wire:model="tim" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                        <option value="BPH">BPH</option>
                        <option value="Penanggung Jawab">Penanggung Jawab</option>
                        <option value="PPK Ormawa">PPK Ormawa</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs text-gray-500">Urutan Tampil</label>
                    <input wire:model="urutan" type="number" class="w-full bg-neu shadow-neu-in rounded-xl px-4 py-2 text-sm outline-none">
                </div>
            </div>

            <div>
                <label class="text-xs text-gray-500">Foto</label>
                <input wire:model="foto" type="file" class="w-full text-sm">
                @error('foto') <span class="text-xs text-red-500">{{ $message }}</span> @enderror

                @if($foto)
                <img src="{{ $foto->temporaryUrl() }}" class="w-20 h-20 rounded-full object-cover mt-2 shadow-neu-in">
                @elseif($existingFoto)
                <img src="{{ Storage::url($existingFoto) }}" class="w-20 h-20 rounded-full object-cover mt-2 shadow-neu-in">
                @endif
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
            <p class="text-gray-700">Yakin ingin menghapus anggota ini?</p>
            <div class="flex justify-center gap-3">
                <button wire:click="$set('showDeleteModal', false)" class="px-4 py-2 text-sm text-gray-500">Batal</button>
                <button wire:click="delete" class="bg-neu rounded-xl shadow-neu-out active:shadow-neu-in px-5 py-2 text-sm font-medium text-red-500">Hapus</button>
            </div>
        </div>
    </div>
    @endif
</div>