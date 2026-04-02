<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $table = 'slider';
    protected $primaryKey = 'id_slider';
    
    protected $fillable = [
        'judul',
        'deskripsi',
        'file_path',
        'link',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get full file URL
     */
    public function getFileUrlAttribute()
    {
        if (!$this->file_path) {
            return null;
        }

        // If already full URL (cloudinary, placeholder, etc)
        if (str_starts_with($this->file_path, 'http')) {
            return $this->file_path;
        }

        // Local storage
        return asset('storage/' . $this->file_path);
    }

    /**
     * Scope: Only active sliders
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Ordered by urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan');
    }
}
