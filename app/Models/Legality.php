<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legality extends Model
{
    use HasFactory;

    protected $fillable = ['nama_dokumen', 'kategori', 'nomor', 'file', 'status', 'tanggal_terbit'];

    protected $casts = [
        'tanggal_terbit' => 'date',
    ];
}