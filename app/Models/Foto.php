<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    protected $table = 'foto';
    protected $primaryKey = 'id_foto';
    
    protected $fillable = [
        'id_album',
        'file_path',
        'keterangan',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relationship: Foto belongs to Album
     */
    public function album()
    {
        return $this->belongsTo(Album::class, 'id_album', 'id_album');
    }

    /**
     * Get full URL for file_path
     */
    public function getFileUrlAttribute()
    {
        if (!$this->file_path) {
            return null;
        }

        // If already full URL
        if (str_starts_with($this->file_path, 'http')) {
            return $this->file_path;
        }

        // Local storage
        return asset('storage/' . $this->file_path);
    }

    /**
     * Scope: Only active photos
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Order by urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan')->orderBy('created_at');
    }
}
