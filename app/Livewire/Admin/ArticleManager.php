<?php

namespace App\Livewire\Admin;

use App\Models\{Article, ActivityLog};
use App\Traits\OptimizesImages;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ArticleManager extends Component
{
    use WithPagination, WithFileUploads;

    public $search = '';
    public $filterCategory = '';

    public $articleId;
    public $title;
    public $content;
    public $category = 'produk';
    public $thumbnail;
    public $existingThumbnail;
    public $published_at;

    public $showModal = false;
    public $showDeleteModal = false;
    public $deleteId;

    protected $paginationTheme = 'tailwind';

    protected function rules()
    {
        return [
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'category'     => 'required|in:produk,berita_acara',
            'thumbnail'    => 'nullable|image|max:2048',
            'published_at' => 'nullable|date',
        ];
    }

    public function updatingSearch() { $this->resetPage(); }

    public function render()
    {
        $articles = Article::query()
            ->when($this->search, fn ($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->when($this->filterCategory, fn ($q) => $q->where('category', $this->filterCategory))
            ->latest()->paginate(10);

        return view('livewire.admin.article-manager', compact('articles'))
            ->layout('layouts.admin');
    }

    public function create() { $this->resetForm(); $this->showModal = true; }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $this->articleId         = $article->id;
        $this->title             = $article->title;
        $this->content           = $article->content;
        $this->category          = $article->category;
        $this->existingThumbnail = $article->thumbnail;
        $this->published_at      = $article->published_at?->format('Y-m-d');
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title'        => $this->title,
            'slug'         => Str::slug($this->title) . '-' . Str::random(5),
            'content'      => $this->content,
            'category'     => $this->category,
            'published_at' => $this->published_at,
        ];

        if ($this->thumbnail) {
            $data['thumbnail'] = $this->optimizeAndStore($this->thumbnail, 'articles');
        }

        if ($this->articleId) {
            $article = Article::findOrFail($this->articleId);
            unset($data['slug']); // slug tetap, biar link lama tidak rusak

            if ($this->thumbnail && $article->thumbnail) {
                Storage::disk('public')->delete($article->thumbnail);
            }

            $article->update($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'ubah', 'module' => 'artikel',
                'description' => "Mengubah artikel \"{$article->title}\"",
            ]);
        } else {
            $article = Article::create($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'tambah', 'module' => 'artikel',
                'description' => "Menambahkan artikel baru \"{$article->title}\"",
            ]);
        }

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', 'Artikel berhasil disimpan.');
    }

    public function confirmDelete($id) { $this->deleteId = $id; $this->showDeleteModal = true; }

    public function delete()
    {
        $article = Article::findOrFail($this->deleteId);
        $title = $article->title;

        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        $article->delete();

        ActivityLog::create([
            'user_id' => auth()->id(), 'action' => 'hapus', 'module' => 'artikel',
            'description' => "Menghapus artikel \"{$title}\"",
        ]);

        $this->showDeleteModal = false;
        session()->flash('success', 'Artikel berhasil dihapus.');
    }

    private function resetForm()
    {
        $this->reset(['articleId', 'title', 'content', 'thumbnail', 'existingThumbnail', 'published_at']);
        $this->category = 'produk';
        $this->resetErrorBag();
    }
}