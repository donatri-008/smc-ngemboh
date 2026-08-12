<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;

trait OptimizesImages
{
    /**
     * Resize (kalau lebih lebar dari $maxWidth) + compress ke format WebP,
     * lalu simpan ke storage public. Return path relatif untuk disimpan ke DB.
     */
    protected function optimizeAndStore(UploadedFile $file, string $folder, int $maxWidth = 1200, int $quality = 75): string
    {
        ini_set('memory_limit', '512M');

        $manager = ImageManager::usingDriver(Driver::class);
        $image = $manager->decodeSplFileInfo($file);

        $image->orient();

        if ($image->width() > $maxWidth) {
            $image->scale(width: $maxWidth);
        }

        $filename = $folder . '/' . Str::random(20) . '.webp';

        $encoded = $image->encodeUsingFormat(Format::WEBP, quality: $quality);

        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }
}
