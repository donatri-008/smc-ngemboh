<?php

namespace App\Livewire\Admin;

use App\Models\{TeamProfile, ActivityLog};
use App\Traits\OptimizesImages;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class TeamManager extends Component
{
    use WithFileUploads, OptimizesImages;

    public $activeTab = 'tim1';

    public $teamId;
    public $nama;
    public $jabatan;
    public $tim = 'tim1';
    public $urutan = 0;
    public $foto;
    public $existingFoto;

    public $showModal = false;
    public $showDeleteModal = false;
    public $deleteId;

    protected function rules()
    {
        return [
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'tim'     => 'required|in:tim1,tim2,tim3',
            'urutan'  => 'nullable|integer|min:0',
            'foto'    => 'nullable|image|max:2048',
        ];
    }

    public function setTab($tab) { $this->activeTab = $tab; }

    public function render()
    {
        $members = TeamProfile::where('tim', $this->activeTab)->orderBy('urutan')->get();
        return view('livewire.admin.team-manager', compact('members'))
            ->layout('layouts.admin');
    }

    public function create()
    {
        $this->resetForm();
        $this->tim = $this->activeTab;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $member = TeamProfile::findOrFail($id);
        $this->teamId       = $member->id;
        $this->nama         = $member->nama;
        $this->jabatan      = $member->jabatan;
        $this->tim          = $member->tim;
        $this->urutan       = $member->urutan;
        $this->existingFoto = $member->foto;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nama'    => $this->nama,
            'jabatan' => $this->jabatan,
            'tim'     => $this->tim,
            'urutan'  => $this->urutan ?? 0,
        ];

        if ($this->foto) {
            $data['foto'] = $this->optimizeAndStore($this->foto, 'team', maxWidth: 600);
        }

        if ($this->teamId) {
            $member = TeamProfile::findOrFail($this->teamId);

            if ($this->foto && $member->foto) {
                Storage::disk('public')->delete($member->foto);
            }

            $member->update($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'ubah', 'module' => 'profil_tim',
                'description' => "Mengubah data anggota tim \"{$member->nama}\"",
            ]);
        } else {
            $member = TeamProfile::create($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'tambah', 'module' => 'profil_tim',
                'description' => "Menambahkan anggota tim baru \"{$member->nama}\" ke " . strtoupper($member->tim),
            ]);
        }

        $this->activeTab = $data['tim'];
        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', 'Data anggota tim berhasil disimpan.');
    }

    public function confirmDelete($id) { $this->deleteId = $id; $this->showDeleteModal = true; }

    public function delete()
    {
        $member = TeamProfile::findOrFail($this->deleteId);
        $nama = $member->nama;

        if ($member->foto) {
            Storage::disk('public')->delete($member->foto);
        }

        $member->delete();

        ActivityLog::create([
            'user_id' => auth()->id(), 'action' => 'hapus', 'module' => 'profil_tim',
            'description' => "Menghapus anggota tim \"{$nama}\"",
        ]);

        $this->showDeleteModal = false;
        session()->flash('success', 'Anggota tim berhasil dihapus.');
    }

    private function resetForm()
    {
        $this->reset(['teamId', 'nama', 'jabatan', 'urutan', 'foto', 'existingFoto']);
        $this->resetErrorBag();
    }
}