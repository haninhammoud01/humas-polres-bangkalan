<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBerita extends Model
{
    use HasFactory;

    protected $table = 'kategori_berita';
    protected $primaryKey = 'id_kategori';

    protected $fillable = [
        'nama_kategori',
        'slug',
        'deskripsi',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke Berita
     */
    public function beritas()
    {
        return $this->hasMany(Berita::class, 'id_kategori', 'id_kategori');
    }

    /**
     * Get berita count
     */
    public function getBeritaCountAttribute()
    {
        return $this->beritas()->count();
    }

    /**
     * Scope untuk kategori aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
