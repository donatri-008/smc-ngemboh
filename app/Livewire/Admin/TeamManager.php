<?php

namespace App\Livewire\Admin;

use App\Models\{TeamProfile, ActivityLog};
use App\Traits\OptimizesImages;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class TeamManager extends Component
{
    use WithPagination, WithFileUploads, OptimizesImages;

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

    protected $paginationTheme = 'tailwind';

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

    public function render()
    {
        $members = TeamProfile::orderBy('tim')->orderBy('urutan')->paginate(10);
        $members->withPath(route('admin.team'));

        return view('livewire.admin.team-manager', compact('members'))
            ->layout('layouts.admin');
    }

    public function create()
    {
        $this->resetForm();
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
        $this->tim = 'tim1';
        $this->resetErrorBag();
    }
}
