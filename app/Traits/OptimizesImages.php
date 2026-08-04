<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

trait OptimizesImages
{
    /**
     * Resize (kalau lebih lebar dari $maxWidth) + compress ke format WebP,
     * lalu simpan ke storage public. Return path relatif untuk disimpan ke DB.
     */
    protected function optimizeAndStore(UploadedFile $file, string $folder, int $maxWidth = 1200, int $quality = 75): string
    {
        $manager = new ImageManager(new Driver());
        $image = $manager->read($file->getRealPath());

        if ($image->width() > $maxWidth) {
            $image->scale(width: $maxWidth);
        }

        $filename = $folder . '/' . Str::random(20) . '.webp';

        Storage::disk('public')->put($filename, (string) $image->toWebp($quality));

        return $filename;
    }
}