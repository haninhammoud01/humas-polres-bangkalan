<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriVideo extends Model
{
    use HasFactory;

    protected $table = 'galeri_video';
    protected $primaryKey = 'id_video';

    protected $fillable = [
        'id_uploader',
        'judul_video',
        'url_video',
        'thumbnail',
        'deskripsi',
        'durasi',
        'views',
        'tanggal_upload',
    ];

    protected $casts = [
        'tanggal_upload' => 'datetime',
        'views' => 'integer',
    ];

    // Relationships
    public function uploader()
    {
        return $this->belongsTo(User::class, 'id_uploader', 'id_user');
    }
}
