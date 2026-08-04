<?php

namespace App\Livewire\Admin;

use App\Models\{Legality, ActivityLog};
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class LegalityManager extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';

    public $legalityId;
    public $nama_dokumen;
    public $nomor;
    public $tanggal_terbit;
    public $file;
    public $existingFile;

    public $showModal = false;
    public $showDeleteModal = false;
    public $deleteId;

    protected $paginationTheme = 'tailwind';

    protected function rules()
    {
        return [
            'nama_dokumen'   => 'required|string|max:255',
            'nomor'          => 'nullable|string|max:255',
            'tanggal_terbit' => 'nullable|date',
            'file'           => ($this->legalityId ? 'nullable' : 'required') . '|file|mimes:pdf,jpg,jpeg,png|max:4096',
        ];
    }

    public function updatingSearch() { $this->resetPage(); }

    public function render()
    {
        $legalities = Legality::query()
            ->when($this->search, fn ($q) => $q->where('nama_dokumen', 'like', '%' . $this->search . '%'))
            ->latest()->paginate(10);

        return view('livewire.admin.legality-manager', compact('legalities'))
            ->layout('layouts.admin');
    }

    public function create() { $this->resetForm(); $this->showModal = true; }

    public function edit($id)
    {
        $legality = Legality::findOrFail($id);
        $this->legalityId     = $legality->id;
        $this->nama_dokumen   = $legality->nama_dokumen;
        $this->nomor          = $legality->nomor;
        $this->tanggal_terbit = $legality->tanggal_terbit?->format('Y-m-d');
        $this->existingFile   = $legality->file;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nama_dokumen'   => $this->nama_dokumen,
            'nomor'          => $this->nomor,
            'tanggal_terbit' => $this->tanggal_terbit,
        ];

        if ($this->file) {
            $data['file'] = $this->file->store('legalities', 'public');
        }

        if ($this->legalityId) {
            $legality = Legality::findOrFail($this->legalityId);

            if ($this->file && $legality->file) {
                Storage::disk('public')->delete($legality->file);
            }

            $legality->update($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'ubah', 'module' => 'legalitas',
                'description' => "Mengubah dokumen legalitas \"{$legality->nama_dokumen}\"",
            ]);
        } else {
            $legality = Legality::create($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'tambah', 'module' => 'legalitas',
                'description' => "Menambahkan dokumen legalitas baru \"{$legality->nama_dokumen}\"",
            ]);
        }

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', 'Dokumen legalitas berhasil disimpan.');
    }

    public function confirmDelete($id) { $this->deleteId = $id; $this->showDeleteModal = true; }

    public function delete()
    {
        $legality = Legality::findOrFail($this->deleteId);
        $nama = $legality->nama_dokumen;

        if ($legality->file) {
            Storage::disk('public')->delete($legality->file);
        }

        $legality->delete();

        ActivityLog::create([
            'user_id' => auth()->id(), 'action' => 'hapus', 'module' => 'legalitas',
            'description' => "Menghapus dokumen legalitas \"{$nama}\"",
        ]);

        $this->showDeleteModal = false;
        session()->flash('success', 'Dokumen legalitas berhasil dihapus.');
    }

    private function resetForm()
    {
        $this->reset(['legalityId', 'nama_dokumen', 'nomor', 'tanggal_terbit', 'file', 'existingFile']);
        $this->resetErrorBag();
    }
}