<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'content', 'thumbnail', 'category', 'published_at', 'status', 'gallery'];

    protected $casts = [
        'published_at' => 'datetime',
        'gallery' => 'array',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}