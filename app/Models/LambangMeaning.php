<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LambangMeaning extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'isi', 'icon', 'posisi', 'urutan'];
}