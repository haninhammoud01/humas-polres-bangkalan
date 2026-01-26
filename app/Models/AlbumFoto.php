<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumFoto extends Model
{
    use HasFactory;

    protected $table = 'album_foto';
    protected $primaryKey = 'id_album';

    protected $fillable = [
        'id_pembuat',
        'nama_album',
        'deskripsi',
        'cover_album',
        'tanggal_dibuat',
    ];

    protected $casts = [
        'tanggal_dibuat' => 'datetime',
    ];

    // Relationships
    public function pembuat()
    {
        return $this->belongsTo(User::class, 'id_pembuat', 'id_user');
    }

    public function foto()
    {
        return $this->hasMany(GaleriFoto::class, 'id_album', 'id_album');
    }
}
