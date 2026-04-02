<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GaleriFoto extends Model
{
    // Sesuaikan dengan nama tabel di database Anda
    protected $table = 'galeri_foto'; 
    protected $primaryKey = 'id_foto';

    protected $fillable = [
        'id_album',
        'file_path',
        'keterangan'
    ];

    public function album()
    {
        return $this->belongsTo(Album::class, 'id_album', 'id_album');
    }
}
