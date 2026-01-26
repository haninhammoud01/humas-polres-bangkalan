<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

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
    ];

    protected $casts = [
        'tanggal_publish' => 'datetime',
        'views' => 'integer',
    ];

    // Relationships
    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'id_kategori', 'id_kategori');
    }

    public function penulis()
    {
        return $this->belongsTo(User::class, 'id_penulis', 'id_user');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'berita_tag', 'id_berita', 'id_tag');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'Published');
    }

    public function scopeTerbaru($query)
    {
        return $query->orderBy('tanggal_publish', 'desc');
    }
}
