<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Foto;  // ← ADD THIS IMPORT!
use App\Models\User;

class Album extends Model
{
    protected $table = 'album_foto';
    protected $primaryKey = 'id_album';
    
    protected $fillable = [
        'nama_album',
        'deskripsi',
        'tanggal_dibuat',
        'id_pembuat',
        'cover_photo',
        'is_active',
    ];

    protected $casts = [
        'tanggal_dibuat' => 'datetime',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship: Album has many Foto
     */
    public function photos()
    {
        return $this->hasMany(Foto::class, 'id_album', 'id_album');
    }

    /**
     * Relationship: Album has many active photos
     */
    public function activePhotos()
    {
        return $this->hasMany(Foto::class, 'id_album', 'id_album')
                    ->where('is_active', true)
                    ->ordered();
    }

    /**
     * Relationship: Album belongs to User (pembuat)
     */
    public function pembuat()
    {
        return $this->belongsTo(User::class, 'id_pembuat');
    }

    /**
     * Get cover photo URL
     */
    public function getCoverPhotoUrlAttribute()
    {
        // If has explicit cover_photo
        if ($this->cover_photo) {
            if (str_starts_with($this->cover_photo, 'http')) {
                return $this->cover_photo;
            }
            return asset('storage/' . $this->cover_photo);
        }

        // Use first photo as cover
        $firstPhoto = $this->activePhotos()->first();
        if ($firstPhoto) {
            return $firstPhoto->file_url;
        }

        return null;
    }

    /**
     * Scope: Only active albums
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: With photo count
     */
    public function scopeWithPhotoCount($query)
    {
        return $query->withCount(['photos' => function($q) {
            $q->where('is_active', true);
        }]);
    }
}
