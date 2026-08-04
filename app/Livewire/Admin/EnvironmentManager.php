<?php

namespace App\Livewire\Admin;

use App\Models\{EnvironmentInfo, ActivityLog};
use Livewire\Component;
use Livewire\WithPagination;

class EnvironmentManager extends Component
{
    use WithPagination;

    public $search = '';
    public $filterCategory = '';

    public $infoId;
    public $title;
    public $content;
    public $category = 'informasi';

    public $showModal = false;
    public $showDeleteModal = false;
    public $deleteId;

    protected $paginationTheme = 'tailwind';

    protected function rules()
    {
        return [
            'title'    => 'required|string|max:255',
            'content'  => 'required|string',
            'category' => 'required|in:informasi,peraturan',
        ];
    }

    public function updatingSearch() { $this->resetPage(); }

    public function render()
    {
        $infos = EnvironmentInfo::query()
            ->when($this->search, fn ($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->when($this->filterCategory, fn ($q) => $q->where('category', $this->filterCategory))
            ->latest()->paginate(10);

        return view('livewire.admin.environment-manager', compact('infos'))
            ->layout('layouts.admin');
    }

    public function create() { $this->resetForm(); $this->showModal = true; }

    public function edit($id)
    {
        $info = EnvironmentInfo::findOrFail($id);
        $this->infoId   = $info->id;
        $this->title    = $info->title;
        $this->content  = $info->content;
        $this->category = $info->category;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title'    => $this->title,
            'content'  => $this->content,
            'category' => $this->category,
        ];

        if ($this->infoId) {
            $info = EnvironmentInfo::findOrFail($this->infoId);
            $info->update($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'ubah', 'module' => 'info_lingkungan',
                'description' => "Mengubah info lingkungan \"{$info->title}\"",
            ]);
        } else {
            $info = EnvironmentInfo::create($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'tambah', 'module' => 'info_lingkungan',
                'description' => "Menambahkan info lingkungan baru \"{$info->title}\"",
            ]);
        }

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', 'Info lingkungan berhasil disimpan.');
    }

    public function confirmDelete($id) { $this->deleteId = $id; $this->showDeleteModal = true; }

    public function delete()
    {
        $info = EnvironmentInfo::findOrFail($this->deleteId);
        $title = $info->title;
        $info->delete();

        ActivityLog::create([
            'user_id' => auth()->id(), 'action' => 'hapus', 'module' => 'info_lingkungan',
            'description' => "Menghapus info lingkungan \"{$title}\"",
        ]);

        $this->showDeleteModal = false;
        session()->flash('success', 'Info lingkungan berhasil dihapus.');
    }

    private function resetForm()
    {
        $this->reset(['infoId', 'title', 'content']);
        $this->category = 'informasi';
        $this->resetErrorBag();
    }
}