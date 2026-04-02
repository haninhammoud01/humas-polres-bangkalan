<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';
    
    protected $fillable = [
        'id_pembuat',
        'judul',
        'isi_pengumuman',
        'tanggal_pengumuman',
        'prioritas',
        'media',
        'is_active',
    ];

    protected $casts = [
        'tanggal_pengumuman' => 'datetime',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship: Pengumuman belongs to User (pembuat)
     */
    public function pembuat()
    {
        return $this->belongsTo(User::class, 'id_pembuat');
    }

    /**
     * Get full media URL
     */
    public function getMediaUrlAttribute()
    {
        if (!$this->media) {
            return null;
        }

        // If already full URL
        if (str_starts_with($this->media, 'http')) {
            return $this->media;
        }

        // Local storage
        return asset('storage/' . $this->media);
    }

    /**
     * Get media type (image or video)
     */
    public function getMediaTypeAttribute()
    {
        if (!$this->media) {
            return null;
        }

        $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $videoExtensions = ['mp4', 'mov', 'avi', 'wmv', 'flv'];

        $extension = strtolower(pathinfo($this->media, PATHINFO_EXTENSION));

        if (in_array($extension, $imageExtensions)) {
            return 'image';
        }

        if (in_array($extension, $videoExtensions)) {
            return 'video';
        }

        return 'file';
    }

    /**
     * Check if media is image
     */
    public function isImage()
    {
        return $this->media_type === 'image';
    }

    /**
     * Check if media is video
     */
    public function isVideo()
    {
        return $this->media_type === 'video';
    }

    /**
     * Scope: Only active pengumuman
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: High priority
     */
    public function scopeHighPriority($query)
    {
        return $query->where('prioritas', 'High');
    }

    /**
     * Scope: Latest pengumuman
     */
    public function scopeLatest($query, $limit = 5)
    {
        return $query->active()
                    ->orderBy('tanggal_pengumuman', 'desc')
                    ->take($limit);
    }

    /**
     * Get prioritas badge color
     */
    public function getPrioritasColorAttribute()
    {
        return match($this->prioritas) {
            'High' => 'danger',
            'Medium' => 'warning',
            'Low' => 'secondary',
            default => 'secondary',
        };
    }
}
