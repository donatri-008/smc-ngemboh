<?php

namespace App\Livewire\Admin;

use App\Models\{EnvironmentInfo, ActivityLog};
use Livewire\Component;
use Livewire\WithPagination;

class EnvironmentManager extends Component
{
    use WithPagination;

    public $search = '';

    public $infoId;
    public $title;
    public $content;

    public $showModal = false;
    public $showDeleteModal = false;
    public $deleteId;
    public $deleteTitle;

    protected $paginationTheme = 'tailwind';

    protected function rules()
    {
        return [
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
        ];
    }

    public function updatingSearch() { $this->resetPage(); }

    public function render()
    {
        $infos = EnvironmentInfo::query()
            ->when($this->search, fn ($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->latest()->paginate(10);

        $totalDeskripsi = EnvironmentInfo::count();

        return view('livewire.admin.environment-manager', compact('infos', 'totalDeskripsi'))
            ->layout('layouts.admin');
    }

    public function create() { $this->resetForm(); $this->showModal = true; }

    public function edit($id)
    {
        $info = EnvironmentInfo::findOrFail($id);
        $this->infoId  = $info->id;
        $this->title   = $info->title;
        $this->content = $info->content;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title'    => $this->title,
            'content'  => $this->content,
            'category' => 'informasi',
        ];

        if ($this->infoId) {
            $info = EnvironmentInfo::findOrFail($this->infoId);
            $info->update($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'ubah', 'module' => 'info_lingkungan',
                'description' => "Mengubah deskripsi lingkungan \"{$info->title}\"",
            ]);
        } else {
            $info = EnvironmentInfo::create($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'tambah', 'module' => 'info_lingkungan',
                'description' => "Menambahkan deskripsi lingkungan baru \"{$info->title}\"",
            ]);
        }

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', 'Deskripsi lingkungan berhasil disimpan.');
    }

    public function confirmDelete($id)
    {
        $info = EnvironmentInfo::findOrFail($id);
        $this->deleteId = $id;
        $this->deleteTitle = $info->title;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $info = EnvironmentInfo::findOrFail($this->deleteId);
        $title = $info->title;
        $info->delete();

        ActivityLog::create([
            'user_id' => auth()->id(), 'action' => 'hapus', 'module' => 'info_lingkungan',
            'description' => "Menghapus deskripsi lingkungan \"{$title}\"",
        ]);

        $this->showDeleteModal = false;
        session()->flash('success', 'Deskripsi lingkungan berhasil dihapus.');
    }

    private function resetForm()
    {
        $this->reset(['infoId', 'title', 'content', 'deleteId', 'deleteTitle']);
        $this->resetErrorBag();
    }
}