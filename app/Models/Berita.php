<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';
    
    protected $fillable = [
        'id_kategori',
        'id_penulis',
        'judul',
        'slug',
        'konten',
        'ringkasan',
        'gambar_utama',
        'caption_gambar',
        'tanggal_publish',
        'views',
        'status',
        'is_active',
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime',
        'is_active' => 'boolean',
        'views' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship: Berita belongs to KategoriBerita
     */
    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'id_kategori', 'id_kategori');
    }

    /**
     * Relationship: Berita belongs to User (penulis)
     */
    public function penulis()
    {
        return $this->belongsTo(User::class, 'id_penulis');
    }

    /**
     * Get full image URL
     */
    public function getGambarUtamaUrlAttribute()
    {
        if (!$this->gambar_utama) {
            return null;
        }

        // If already full URL (placeholder, cloudinary, etc)
        if (str_starts_with($this->gambar_utama, 'http')) {
            return $this->gambar_utama;
        }

        // Local storage
        return asset('storage/' . $this->gambar_utama);
    }

    /**
     * Scope: Only published berita
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'Published')
                    ->where('tanggal_publish', '<=', now())
                    ->where('is_active', true);
    }

    /**
     * Scope: Only draft berita
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'Draft');
    }

    /**
     * Scope: Popular berita (by views)
     */
    public function scopePopular($query, $limit = 5)
    {
        return $query->published()
                    ->orderBy('views', 'desc')
                    ->take($limit);
    }

    /**
     * Scope: Latest berita
     */
    public function scopeLatest($query, $limit = 5)
    {
        return $query->published()
                    ->orderBy('tanggal_publish', 'desc')
                    ->take($limit);
    }
}
