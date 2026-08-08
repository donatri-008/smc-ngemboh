<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'slug', 'deskripsi', 'icon', 'gambar', 'konten'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> 7c2b0c38c7cbb0458913dc97ac2a87842c5a8228
