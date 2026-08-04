<?php

namespace App\Livewire\Admin;

use App\Models\{Statistic, ActivityLog};
use Livewire\Component;
use Livewire\WithPagination;

class StatisticManager extends Component
{
    use WithPagination;

    public $activeType = 'lingkungan';
    public $search = '';

    public $statId;
    public $kategori;
    public $label;
    public $value;
    public $tahun;
    public $deskripsi;

    public $showModal = false;
    public $showDeleteModal = false;
    public $deleteId;

    protected $paginationTheme = 'tailwind';

    protected function rules()
    {
        return [
            'kategori'  => 'required|string|max:255',
            'label'     => 'required|string|max:255',
            'value'     => 'required|numeric',
            'tahun'     => 'required|digits:4',
            'deskripsi' => 'nullable|string',
        ];
    }

    public function setTab($type) { $this->activeType = $type; $this->resetPage(); }
    public function updatingSearch() { $this->resetPage(); }

    public function render()
    {
        $stats = Statistic::where('type', $this->activeType)
            ->when($this->search, fn ($q) => $q->where('kategori', 'like', '%' . $this->search . '%'))
            ->orderByDesc('tahun')->paginate(10);

        return view('livewire.admin.statistic-manager', compact('stats'))
            ->layout('layouts.admin');
    }

    public function create() { $this->resetForm(); $this->showModal = true; }

    public function edit($id)
    {
        $stat = Statistic::findOrFail($id);
        $this->statId    = $stat->id;
        $this->kategori  = $stat->kategori;
        $this->label     = $stat->label;
        $this->value     = $stat->value;
        $this->tahun     = $stat->tahun;
        $this->deskripsi = $stat->deskripsi;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'type'      => $this->activeType,
            'kategori'  => $this->kategori,
            'label'     => $this->label,
            'value'     => $this->value,
            'tahun'     => $this->tahun,
            'deskripsi' => $this->deskripsi,
        ];

        if ($this->statId) {
            $stat = Statistic::findOrFail($this->statId);
            $stat->update($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'ubah', 'module' => 'statistik',
                'description' => "Mengubah data statistik \"{$stat->kategori}\" tahun {$stat->tahun}",
            ]);
        } else {
            $stat = Statistic::create($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'tambah', 'module' => 'statistik',
                'description' => "Menambahkan data statistik \"{$stat->kategori}\" tahun {$stat->tahun}",
            ]);
        }

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', 'Data statistik berhasil disimpan.');
    }

    public function confirmDelete($id) { $this->deleteId = $id; $this->showDeleteModal = true; }

    public function delete()
    {
        $stat = Statistic::findOrFail($this->deleteId);
        $kategori = $stat->kategori;
        $stat->delete();

        ActivityLog::create([
            'user_id' => auth()->id(), 'action' => 'hapus', 'module' => 'statistik',
            'description' => "Menghapus data statistik \"{$kategori}\"",
        ]);

        $this->showDeleteModal = false;
        session()->flash('success', 'Data statistik berhasil dihapus.');
    }

    private function resetForm()
    {
        $this->reset(['statId', 'kategori', 'label', 'value', 'tahun', 'deskripsi']);
        $this->resetErrorBag();
    }
}