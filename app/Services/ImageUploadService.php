<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageUploadService
{
    /**
     * Simpan upload image sebagai .webp (kompres + optional resize) ke Storage disk (default: public).
     *
     * - Semua output jadi .webp untuk raster image (jpeg/png/gif/webp).
     * - SVG otomatis disimpan original (karena tidak bisa dikonversi ke raster dengan GD).
     * - Kalau server tidak punya GD WebP (imagewebp tidak ada), otomatis fallback: simpan original.
     */
    public function storeAsWebp(
        UploadedFile $file,
        string $directory,
        string $disk = 'public',
        int $quality = 80,
        int $maxWidth = 2000,
        int $maxHeight = 2000,
    ): string {
        $directory = trim($directory, '/');

        // SVG tidak kita konversi (butuh renderer lain), simpan apa adanya.
        $ext = strtolower((string) $file->getClientOriginalExtension());
        $mime = strtolower((string) $file->getMimeType());
        if ($ext === 'svg' || $mime === 'image/svg+xml') {
            return $file->store($directory, $disk);
        }

        // Kalau GD tidak support WebP, fallback simpan original biar tidak error.
        if (!function_exists('imagewebp')) {
            return $file->store($directory, $disk);
        }

        $realPath = $file->getRealPath();
        if ($realPath === false || $realPath === null) {
            return $file->store($directory, $disk);
        }

        $img = $this->createGdImageResource($realPath, $mime);
        if ($img === null) {
            return $file->store($directory, $disk);
        }

        // Resize kalau kebesaran
        $img = $this->resizeToFit($img, $maxWidth, $maxHeight);

        // Pastikan folder ada
        Storage::disk($disk)->makeDirectory($directory);

        $filename = (string) Str::uuid() . '.webp';
        $relativePath = $directory !== '' ? ($directory . '/' . $filename) : $filename;

        // Disk public pada Laravel umumnya local, jadi path() aman.
        $absolutePath = Storage::disk($disk)->path($relativePath);

        $quality = max(0, min(100, $quality));
        $ok = @imagewebp($img, $absolutePath, $quality);

        imagedestroy($img);

        if (!$ok) {
            // fallback: simpan original
            return $file->store($directory, $disk);
        }

        return $relativePath;
    }

    private function createGdImageResource(string $path, string $mimeLower): ?\GdImage
    {
        // Kalau mime tidak kebaca, coba tebak dari file
        if ($mimeLower === '') {
            $guessed = @mime_content_type($path);
            $mimeLower = strtolower((string) $guessed);
        }

        $img = null;

        switch ($mimeLower) {
            case 'image/jpeg':
            case 'image/jpg':
                $img = @imagecreatefromjpeg($path);
                if ($img instanceof \GdImage) {
                    $img = $this->applyExifOrientation($img, $path);
                }
                break;

            case 'image/png':
                $img = @imagecreatefrompng($path);
                if ($img instanceof \GdImage) {
                    // Preserve alpha
                    imagealphablending($img, false);
                    imagesavealpha($img, true);
                }
                break;

            case 'image/gif':
                $img = @imagecreatefromgif($path);
                break;

            case 'image/webp':
                if (function_exists('imagecreatefromwebp')) {
                    $img = @imagecreatefromwebp($path);
                }
                break;

            default:
                // Kalau mime aneh / bukan raster yang kita dukung, return null => fallback store original
                return null;
        }

        return ($img instanceof \GdImage) ? $img : null;
    }

    private function resizeToFit(\GdImage $src, int $maxWidth, int $maxHeight): \GdImage
    {
        $w = imagesx($src);
        $h = imagesy($src);

        if ($w <= 0 || $h <= 0) {
            return $src;
        }

        $maxWidth = max(1, $maxWidth);
        $maxHeight = max(1, $maxHeight);

        // Tidak perlu resize kalau sudah kecil
        if ($w <= $maxWidth && $h <= $maxHeight) {
            return $src;
        }

        $ratio = min($maxWidth / $w, $maxHeight / $h);
        $newW = max(1, (int) floor($w * $ratio));
        $newH = max(1, (int) floor($h * $ratio));

        $dst = imagecreatetruecolor($newW, $newH);

        // Preserve alpha (untuk PNG/WebP source yang transparan)
        imagealphablending($dst, false);
        imagesavealpha($dst, true);

        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newW, $newH, $w, $h);

        imagedestroy($src);

        return $dst;
    }

    private function applyExifOrientation(\GdImage $img, string $path): \GdImage
    {
        if (!function_exists('exif_read_data')) {
            return $img;
        }

        $exif = @exif_read_data($path);
        $orientation = (int) ($exif['Orientation'] ?? 1);

        if ($orientation === 1) {
            return $img;
        }

        // imagerotate: derajat searah jarum jam negatif
        $angle = match ($orientation) {
            3 => 180,
            6 => -90,
            8 => 90,
            default => 0,
        };

        if ($angle === 0) {
            return $img;
        }

        $rotated = @imagerotate($img, $angle, 0);
        if (!($rotated instanceof \GdImage)) {
            return $img;
        }

        // Preserve alpha
        imagealphablending($rotated, false);
        imagesavealpha($rotated, true);

        imagedestroy($img);

        return $rotated;
    }
}
