<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;

    protected $fillable = ['type', 'kategori', 'label', 'value', 'tahun', 'deskripsi'];

    protected $casts = [
        'value' => 'decimal:2',
    ];
}
