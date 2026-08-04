<?php

namespace App\Livewire\Admin;

use App\Models\{Partner, ActivityLog};
use App\Traits\OptimizesImages;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class PartnerManager extends Component
{
    use WithPagination, WithFileUploads, OptimizesImages;

    public $search = '';

    public $partnerId;
    public $nama;
    public $link;
    public $logo;
    public $existingLogo;

    public $showModal = false;
    public $showDeleteModal = false;
    public $deleteId;

    protected $paginationTheme = 'tailwind';

    protected function rules()
    {
        return [
            'nama' => 'required|string|max:255',
            'link' => 'nullable|url',
            'logo' => ($this->partnerId ? 'nullable' : 'required') . '|image|max:2048',
        ];
    }

    public function updatingSearch() { $this->resetPage(); }

    public function render()
    {
        $partners = Partner::query()
            ->when($this->search, fn ($q) => $q->where('nama', 'like', '%' . $this->search . '%'))
            ->latest()->paginate(10);

        return view('livewire.admin.partner-manager', compact('partners'))
            ->layout('layouts.admin');
    }

    public function create() { $this->resetForm(); $this->showModal = true; }

    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        $this->partnerId   = $partner->id;
        $this->nama        = $partner->nama;
        $this->link        = $partner->link;
        $this->existingLogo = $partner->logo;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nama' => $this->nama,
            'link' => $this->link,
        ];

        if ($this->logo) {
            $data['logo'] = $this->optimizeAndStore($this->logo, 'partners', maxWidth: 400, quality: 90);
        }

        if ($this->partnerId) {
            $partner = Partner::findOrFail($this->partnerId);

            if ($this->logo && $partner->logo) {
                Storage::disk('public')->delete($partner->logo);
            }

            $partner->update($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'ubah', 'module' => 'mitra',
                'description' => "Mengubah data mitra \"{$partner->nama}\"",
            ]);
        } else {
            $partner = Partner::create($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'tambah', 'module' => 'mitra',
                'description' => "Menambahkan mitra baru \"{$partner->nama}\"",
            ]);
        }

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', 'Data mitra berhasil disimpan.');
    }

    public function confirmDelete($id) { $this->deleteId = $id; $this->showDeleteModal = true; }

    public function delete()
    {
        $partner = Partner::findOrFail($this->deleteId);
        $nama = $partner->nama;

        if ($partner->logo) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();

        ActivityLog::create([
            'user_id' => auth()->id(), 'action' => 'hapus', 'module' => 'mitra',
            'description' => "Menghapus mitra \"{$nama}\"",
        ]);

        $this->showDeleteModal = false;
        session()->flash('success', 'Data mitra berhasil dihapus.');
    }

    private function resetForm()
    {
        $this->reset(['partnerId', 'nama', 'link', 'logo', 'existingLogo']);
        $this->resetErrorBag();
    }
}