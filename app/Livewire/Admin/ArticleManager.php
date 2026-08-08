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
    use WithPagination, WithFileUploads, OptimizesImages;

    public $search = '';
    public $filterCategory = '';

    public $articleId;
    public $title;
    public $content;
    public $category = 'produk';
    public $thumbnail;
    public $existingThumbnail;
    public $galleryImages = [];
    public $existingGallery = [];
    public $published_at;

    public $showModal = false;
    public $showDeleteModal = false;
    public $deleteId;

    protected $paginationTheme = 'tailwind';

    protected function rules()
    {
        return [
            'title'          => 'required|string|max:255',
            'content'        => 'required|string',
            'category'       => 'required|in:produk,berita_acara',
            'thumbnail'      => 'nullable|image|max:10240',
            'galleryImages.*'=> 'nullable|image|max:10240',
            'published_at'   => 'nullable|date',
        ];
    }

    public function updatingSearch() { $this->resetPage(); }

    public function render()
    {
        $articles = Article::query()
            ->when($this->search, fn ($q) => $q->where('title', 'like', '%' . $this->search . '%'))
            ->when($this->filterCategory, fn ($q) => $q->where('category', $this->filterCategory))
            ->latest()->paginate(10);

        $articles->withPath(route('admin.articles'));

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
        $this->existingGallery   = $article->gallery ?? [];
        $this->published_at      = $article->published_at?->format('Y-m-d');
        $this->showModal = true;
    }

    public function removeExistingGalleryImage($index)
    {
        $path = $this->existingGallery[$index] ?? null;

        if ($path) {
            Storage::disk('public')->delete($path);
        }

        unset($this->existingGallery[$index]);
        $this->existingGallery = array_values($this->existingGallery);
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
            try {
                $data['thumbnail'] = $this->optimizeAndStore($this->thumbnail, 'articles');
                $data['status'] = 'sukses';
            } catch (\Throwable $e) {
                report($e);
                $data['status'] = 'gagal';
            }
        }

        // Gambar baru yang diupload digabung dengan gambar lama yang masih dipertahankan
        $newGalleryPaths = collect($this->galleryImages)
            ->map(fn ($image) => $this->optimizeAndStore($image, 'articles/gallery'))
            ->all();

        $data['gallery'] = array_values(array_merge($this->existingGallery, $newGalleryPaths));

        if ($this->articleId) {
            $article = Article::findOrFail($this->articleId);
            unset($data['slug']);

            if (isset($data['thumbnail']) && $article->thumbnail) {
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

        if (($data['status'] ?? null) === 'gagal') {
            session()->flash('success', 'Artikel tersimpan, tapi upload gambar gagal. Coba edit artikel ini dan upload ulang gambarnya.');
        } else {
            session()->flash('success', 'Artikel berhasil disimpan.');
        }
    }

    public function confirmDelete($id) { $this->deleteId = $id; $this->showDeleteModal = true; }

    public function delete()
    {
        $article = Article::findOrFail($this->deleteId);
        $title = $article->title;

        if ($article->thumbnail) {
            Storage::disk('public')->delete($article->thumbnail);
        }

        foreach ($article->gallery ?? [] as $path) {
            Storage::disk('public')->delete($path);
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
        $this->reset(['articleId', 'title', 'content', 'thumbnail', 'existingThumbnail', 'galleryImages', 'existingGallery', 'published_at']);
        $this->category = 'produk';
        $this->resetErrorBag();
    }
}