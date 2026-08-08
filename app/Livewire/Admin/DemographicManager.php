<?php

namespace App\Livewire\Admin;

use App\Models\{DemographicEntry, ActivityLog};
use Livewire\Component;
use Livewire\WithPagination;

class DemographicManager extends Component
{
    use WithPagination;

    public $search = '';

    public $entryId;
    public $nama;
    public $kategori = 'penduduk';
    public $data_spesifik;

    public $showModal = false;
    public $showDeleteModal = false;
    public $deleteId;
    public $deleteNama;

    protected $paginationTheme = 'tailwind';

    protected function rules()
    {
        $config = DemographicEntry::KATEGORI[$this->kategori] ?? null;

        $dataRule = match ($config['field_type'] ?? 'text') {
            'number' => 'required|numeric|min:0',
            'select' => 'required|in:' . implode(',', $config['field_options'] ?? []),
            default  => 'required|string|max:255',
        };

        return [
            'nama'          => 'required|string|max:255',
            'kategori'      => 'required|in:' . implode(',', array_keys(DemographicEntry::KATEGORI)),
            'data_spesifik' => $dataRule,
        ];
    }

    public function updatingSearch() { $this->resetPage(); }

    public function updatedKategori()
    {
        $this->data_spesifik = null;
        $this->resetErrorBag('data_spesifik');
    }

    public function render()
    {
        $entries = DemographicEntry::query()
            ->when($this->search, fn ($q) => $q->where('nama', 'like', '%' . $this->search . '%'))
            ->latest()->paginate(10);

        $summary = DemographicEntry::summary();

        return view('livewire.admin.demographic-manager', compact('entries', 'summary'))
            ->layout('layouts.admin');
    }

    public function create() { $this->resetForm(); $this->showModal = true; }

    public function edit($id)
    {
        $entry = DemographicEntry::findOrFail($id);
        $this->entryId      = $entry->id;
        $this->nama         = $entry->nama;
        $this->kategori     = $entry->kategori;
        $this->data_spesifik = $entry->data_spesifik;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nama'          => $this->nama,
            'kategori'      => $this->kategori,
            'data_spesifik' => $this->data_spesifik,
        ];

        if ($this->entryId) {
            $entry = DemographicEntry::findOrFail($this->entryId);
            $entry->update($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'ubah', 'module' => 'data_demografis',
                'description' => "Mengubah data demografi \"{$entry->nama}\"",
            ]);
        } else {
            $entry = DemographicEntry::create($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'tambah', 'module' => 'data_demografis',
                'description' => "Menambahkan data demografi baru \"{$entry->nama}\"",
            ]);
        }

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', 'Data demografi berhasil disimpan.');
    }

    public function confirmDelete($id)
    {
        $entry = DemographicEntry::findOrFail($id);
        $this->deleteId = $id;
        $this->deleteNama = $entry->nama;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $entry = DemographicEntry::findOrFail($this->deleteId);
        $nama = $entry->nama;
        $entry->delete();

        ActivityLog::create([
            'user_id' => auth()->id(), 'action' => 'hapus', 'module' => 'data_demografis',
            'description' => "Menghapus data demografi \"{$nama}\"",
        ]);

        $this->showDeleteModal = false;
        session()->flash('success', 'Data demografi berhasil dihapus.');
    }

    private function resetForm()
    {
        $this->reset(['entryId', 'nama', 'data_spesifik', 'deleteId', 'deleteNama']);
        $this->kategori = 'penduduk';
        $this->resetErrorBag();
    }
}