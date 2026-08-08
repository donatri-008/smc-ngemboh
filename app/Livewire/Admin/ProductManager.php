<?php

namespace App\Livewire\Admin;

use App\Models\{Product, ProductImage, ActivityLog};
use App\Traits\OptimizesImages;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ProductManager extends Component
{
    use WithPagination, WithFileUploads, OptimizesImages;

    public $search = '';

    public $productId;
    public $nama;
    public $deskripsi;
    public $harga;
    public $stok;
    public $gambar = [];
    public $existingImages = [];

    public $showModal = false;
    public $showDeleteModal = false;
    public $deleteId;
    public $deleteNama;

    protected $paginationTheme = 'tailwind';

    protected function rules()
    {
        return [
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga'     => 'required|numeric|min:0',
            'stok'      => 'required|integer|min:0',
            'gambar.*'  => 'nullable|image|max:2048',
        ];
    }

    public function updatingSearch() { $this->resetPage(); }

    public function render()
    {
        $products = Product::query()
            ->when($this->search, fn ($q) => $q->where('nama', 'like', '%' . $this->search . '%'))
            ->latest()->paginate(10);

        return view('livewire.admin.product-manager', compact('products'))
            ->layout('layouts.admin');
    }

    public function create()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $this->productId      = $product->id;
        $this->nama            = $product->nama;
        $this->deskripsi       = $product->deskripsi;
        $this->harga            = $product->harga;
        $this->stok             = $product->stok;
        $this->existingImages   = $product->images;
        $this->showModal = true;
    }

    // Hapus satu foto dari galeri 
    public function removeExistingImage($imageId)
    {
        $image = ProductImage::find($imageId);
        if (! $image || $image->product_id != $this->productId) {
            return;
        }

        Storage::disk('public')->delete($image->path);
        $image->delete();

        $product = Product::find($this->productId);
        $cover = $product->images()->orderBy('urutan')->first();
        $product->update(['gambar' => $cover?->path]);

        $this->existingImages = $product->images()->orderBy('urutan')->get();
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nama'      => $this->nama,
            'deskripsi' => $this->deskripsi,
            'harga'     => $this->harga,
            'stok'      => $this->stok,
        ];

        if ($this->productId) {
            $product = Product::findOrFail($this->productId);
            $stokLama = $product->stok;
            $product->update($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'ubah', 'module' => 'produk',
                'description' => $stokLama != $this->stok
                    ? "Mengubah data produk \"{$product->nama}\" (stok {$stokLama} → {$this->stok})"
                    : "Mengubah data produk \"{$product->nama}\"",
            ]);
        } else {
            $product = Product::create($data);

            ActivityLog::create([
                'user_id' => auth()->id(), 'action' => 'tambah', 'module' => 'produk',
                'description' => "Menambahkan produk baru \"{$product->nama}\"",
            ]);
        }

        // Simpan foto baru ke galeri (bisa lebih dari satu sekaligus)
        $urutanTerakhir = $product->images()->max('urutan') ?? 0;
        foreach ($this->gambar as $file) {
            $urutanTerakhir++;
            $path = $this->optimizeAndStore($file, 'products');
            $product->images()->create(['path' => $path, 'urutan' => $urutanTerakhir]);
        }

        $cover = $product->images()->orderBy('urutan')->first();
        $product->update(['gambar' => $cover?->path]);

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', 'Produk berhasil disimpan.');
    }

    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->deleteNama = Product::find($id)?->nama;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $product = Product::findOrFail($this->deleteId);
        $nama = $product->nama;

        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
        }
        $product->images()->delete();
        $product->delete();

        ActivityLog::create([
            'user_id' => auth()->id(), 'action' => 'hapus', 'module' => 'produk',
            'description' => "Menghapus produk \"{$nama}\"",
        ]);

        $this->showDeleteModal = false;
        session()->flash('success', 'Produk berhasil dihapus.');
    }

    private function resetForm()
    {
        $this->reset(['productId', 'nama', 'deskripsi', 'harga', 'stok', 'gambar', 'existingImages']);
        $this->resetErrorBag();
    }
}