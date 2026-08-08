<?php

namespace App\Livewire\Admin;

use App\Models\{Program, ActivityLog};
use Livewire\Component;

class ProgramManager extends Component
{
    public $programId;
    public $nama;
    public $deskripsi;
    public $icon;

    public $showModal = false;
    public $showDeleteModal = false;
    public $deleteId;

    protected function rules()
    {
        return [
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'icon'      => 'nullable|string|max:100', // nama heroicon, mis. "academic-cap"
        ];
    }

    public function render()
    {
        $programs = Program::latest()->get();
        return view('livewire.admin.program-manager', compact('programs'))
            ->layout('layouts.admin');
    }

    public function create() { $this->resetForm(); $this->showModal = true; }

    public function edit($id)
    {
        $program = Program::findOrFail($id);
        $this->programId = $program->id;
        $this->nama      = $program->nama;
        $this->deskripsi = $program->deskripsi;
        $this->icon      = $program->icon;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nama'      => $this->nama,
            'deskripsi' => $this->deskripsi,
            'icon'      => $this->icon,
        ];

        if ($this->programId) {
            $program = Program::findOrFail($this->programId);
            $program->update($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'ubah', 'module' => 'program',
                'description' => "Mengubah program \"{$program->nama}\"",
            ]);
        } else {
            $program = Program::create($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'tambah', 'module' => 'program',
                'description' => "Menambahkan program baru \"{$program->nama}\"",
            ]);
        }

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', 'Program berhasil disimpan.');
    }

    public function confirmDelete($id) { $this->deleteId = $id; $this->showDeleteModal = true; }

    public function delete()
    {
        $program = Program::findOrFail($this->deleteId);
        $nama = $program->nama;
        $program->delete();

        ActivityLog::create([
            'user_id' => auth()->id(), 'action' => 'hapus', 'module' => 'program',
            'description' => "Menghapus program \"{$nama}\"",
        ]);

        $this->showDeleteModal = false;
        session()->flash('success', 'Program berhasil dihapus.');
    }

    private function resetForm()
    {
        $this->reset(['programId', 'nama', 'deskripsi', 'icon']);
        $this->resetErrorBag();
    }
}
