<?php

namespace App\Livewire\Admin;

use App\Models\{Product, ActivityLog};
use App\Traits\OptimizesImages;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ProductManager extends Component
{
    use WithPagination, WithFileUploads, OptimizesImages;

    public $search = '';
    public $filterKategori = '';

    public $productId;
    public $nama;
    public $deskripsi;
    public $harga;
    public $stok;
    public $kategori = 'lapak';
    public $gambar;
    public $existingGambar;

    public $showModal = false;
    public $showDeleteModal = false;
    public $deleteId;

    protected $paginationTheme = 'tailwind';

    protected function rules()
    {
        return [
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga'     => 'required|numeric|min:0',
            'stok'      => 'required|integer|min:0',
            'kategori'  => 'required|in:lapak,produk_luaran',
            'gambar'    => 'nullable|image|max:2048',
        ];
    }

    public function updatingSearch() { $this->resetPage(); }

    public function render()
    {
        $products = Product::query()
            ->when($this->search, fn ($q) => $q->where('nama', 'like', '%' . $this->search . '%'))
            ->when($this->filterKategori, fn ($q) => $q->where('kategori', $this->filterKategori))
            ->latest()->paginate(10);

        return view('livewire.admin.product-manager', compact('products'))
            ->layout('layouts.admin');
    }

    public function create() { $this->resetForm(); $this->showModal = true; }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->productId      = $product->id;
        $this->nama           = $product->nama;
        $this->deskripsi      = $product->deskripsi;
        $this->harga          = $product->harga;
        $this->stok           = $product->stok;
        $this->kategori       = $product->kategori;
        $this->existingGambar = $product->gambar;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'nama'      => $this->nama,
            'deskripsi' => $this->deskripsi,
            'harga'     => $this->harga,
            'stok'      => $this->stok,
            'kategori'  => $this->kategori,
        ];

        if ($this->gambar) {
            $data['gambar'] = $this->optimizeAndStore($this->gambar, 'products');
        }

        if ($this->productId) {
            $product = Product::findOrFail($this->productId);
            $stokLama = $product->stok;

            if ($this->gambar && $product->gambar) {
                Storage::disk('public')->delete($product->gambar);
            }

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

        $this->showModal = false;
        $this->resetForm();
        session()->flash('success', 'Produk berhasil disimpan.');
    }

    public function confirmDelete($id) { $this->deleteId = $id; $this->showDeleteModal = true; }

    public function delete()
    {
        $product = Product::findOrFail($this->deleteId);
        $nama = $product->nama;

        if ($product->gambar) {
            Storage::disk('public')->delete($product->gambar);
        }

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
        $this->reset(['productId', 'nama', 'deskripsi', 'harga', 'stok', 'gambar', 'existingGambar']);
        $this->kategori = 'lapak';
        $this->resetErrorBag();
    }
}