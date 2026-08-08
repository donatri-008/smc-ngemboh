<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'deskripsi', 'harga', 'stok', 'gambar', 'kategori'];

    protected $casts = [
        'harga' => 'decimal:2',
    ];

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('urutan');
    }
}
