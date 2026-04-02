<?php

namespace App\Services;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageOptimizationService
{
    /**
     * Optimize and save image
     * 
     * @param $file UploadedFile
     * @param string $folder Target folder (e.g., 'foto_berita', 'foto_galeri')
     * @param array $options ['width' => 800, 'height' => 800, 'quality' => 75]
     * @return string Filename
     */
    public function optimizeAndSave($file, string $folder, array $options = [])
    {
        // Default options
        $width = $options['width'] ?? 800;
        $height = $options['height'] ?? 800;
        $quality = $options['quality'] ?? 75; // 75% quality untuk ~5KB
        $ratio = $options['ratio'] ?? '1:1'; // 1:1, 16:9, 4:3, etc
        $format = $options['format'] ?? 'jpg'; // jpg, webp, png

        // Generate unique filename
        $filename = time() . '_' . Str::random(10) . '.' . $format;
        $filepath = public_path($folder . '/' . $filename);

        // Ensure folder exists
        if (!file_exists(public_path($folder))) {
            mkdir(public_path($folder), 0755, true);
        }

        // Load image
        $image = Image::make($file);

        // Process based on ratio
        if ($ratio === '1:1') {
            // Square crop (center)
            $image = $this->cropSquare($image, $width);
        } elseif ($ratio === '16:9') {
            $image = $this->cropRatio($image, 16, 9, $width);
        } elseif ($ratio === '4:3') {
            $image = $this->cropRatio($image, 4, 3, $width);
        } else {
            // Just resize maintaining aspect ratio
            $image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        // Save with compression
        $image->save($filepath, $quality, $format);

        return $filename;
    }

    /**
     * Crop image to square (1:1)
     */
    protected function cropSquare($image, int $size)
    {
        $originalWidth = $image->width();
        $originalHeight = $image->height();
        
        // Calculate crop size (use the smaller dimension)
        $cropSize = min($originalWidth, $originalHeight);
        
        // Calculate position to center crop
        $x = ($originalWidth - $cropSize) / 2;
        $y = ($originalHeight - $cropSize) / 2;
        
        // Crop and resize
        return $image->crop($cropSize, $cropSize, (int)$x, (int)$y)
                     ->resize($size, $size);
    }

    /**
     * Crop image to specific ratio
     */
    protected function cropRatio($image, int $widthRatio, int $heightRatio, int $targetWidth)
    {
        $originalWidth = $image->width();
        $originalHeight = $image->height();
        
        // Calculate target dimensions
        $targetHeight = ($targetWidth * $heightRatio) / $widthRatio;
        
        // Calculate crop dimensions based on original aspect ratio
        $originalRatio = $originalWidth / $originalHeight;
        $targetRatio = $widthRatio / $heightRatio;
        
        if ($originalRatio > $targetRatio) {
            // Original is wider - crop width
            $cropHeight = $originalHeight;
            $cropWidth = $originalHeight * $targetRatio;
            $x = ($originalWidth - $cropWidth) / 2;
            $y = 0;
        } else {
            // Original is taller - crop height
            $cropWidth = $originalWidth;
            $cropHeight = $originalWidth / $targetRatio;
            $x = 0;
            $y = ($originalHeight - $cropHeight) / 2;
        }
        
        // Crop and resize
        return $image->crop((int)$cropWidth, (int)$cropHeight, (int)$x, (int)$y)
                     ->resize($targetWidth, (int)$targetHeight);
    }

    /**
     * Delete old image
     */
    public function deleteImage(string $folder, string $filename)
    {
        $filepath = public_path($folder . '/' . $filename);
        
        if (file_exists($filepath)) {
            unlink($filepath);
            return true;
        }
        
        return false;
    }

    /**
     * Validate image file
     */
    public function validateImage($file, int $maxSizeMB = 10)
    {
        $errors = [];
        
        // Check if file exists
        if (!$file) {
            $errors[] = 'File tidak ditemukan';
            return $errors;
        }
        
        // Check file size (in MB)
        $fileSizeMB = $file->getSize() / 1024 / 1024;
        if ($fileSizeMB > $maxSizeMB) {
            $errors[] = "Ukuran file terlalu besar. Maksimal {$maxSizeMB}MB";
        }
        
        // Check mime type
        $allowedMimes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
        if (!in_array($file->getMimeType(), $allowedMimes)) {
            $errors[] = 'Format file tidak didukung. Gunakan JPG, PNG, atau WebP';
        }
        
        // Check dimensions (optional - prevent too small images)
        try {
            $image = Image::make($file);
            if ($image->width() < 200 || $image->height() < 200) {
                $errors[] = 'Dimensi gambar terlalu kecil. Minimal 200x200 pixel';
            }
        } catch (\Exception $e) {
            $errors[] = 'File bukan gambar yang valid';
        }
        
        return $errors;
    }

    /**
     * Get optimized file size in KB
     */
    public function getOptimizedSize(string $folder, string $filename)
    {
        $filepath = public_path($folder . '/' . $filename);
        
        if (file_exists($filepath)) {
            $sizeKB = filesize($filepath) / 1024;
            return round($sizeKB, 2);
        }
        
        return 0;
    }

    /**
     * Batch optimize images (for existing images)
     */
    public function batchOptimize(string $folder, array $options = [])
    {
        $path = public_path($folder);
        $optimized = [];
        
        if (!file_exists($path)) {
            return $optimized;
        }
        
        $files = glob($path . '/*.{jpg,jpeg,png,webp}', GLOB_BRACE);
        
        foreach ($files as $file) {
            try {
                $image = Image::make($file);
                $filename = basename($file);
                
                // Re-optimize
                $width = $options['width'] ?? 800;
                $quality = $options['quality'] ?? 75;
                
                if ($options['ratio'] ?? '1:1' === '1:1') {
                    $image = $this->cropSquare($image, $width);
                }
                
                $image->save($file, $quality);
                
                $optimized[] = [
                    'filename' => $filename,
                    'size_kb' => $this->getOptimizedSize($folder, $filename),
                ];
            } catch (\Exception $e) {
                // Skip invalid images
                continue;
            }
        }
        
        return $optimized;
    }
}
