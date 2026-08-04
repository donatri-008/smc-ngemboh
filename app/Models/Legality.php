<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Legality extends Model
{
    use HasFactory;
    
    protected $fillable = ['nama_dokumen', 'nomor', 'file', 'tanggal_terbit'];

    protected $casts = [
        'tanggal_terbit' => 'date',
    ];
}
