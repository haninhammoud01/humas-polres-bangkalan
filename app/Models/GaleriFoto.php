<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriFoto extends Model
{
    use HasFactory;

    protected $table = 'galeri_foto';
    protected $primaryKey = 'id_foto';

    protected $fillable = [
        'id_album',
        'id_uploader',
        'judul_foto',
        'path_foto',
        'deskripsi',
        'ukuran_file',
        'tanggal_upload',
    ];

    protected $casts = [
        'tanggal_upload' => 'datetime',
        'ukuran_file' => 'integer',
    ];

    // Relationships
    public function album()
    {
        return $this->belongsTo(AlbumFoto::class, 'id_album', 'id_album');
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'id_uploader', 'id_user');
    }
}
