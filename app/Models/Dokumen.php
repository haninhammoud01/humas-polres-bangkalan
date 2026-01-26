<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    use HasFactory;

    protected $table = 'dokumen';
    protected $primaryKey = 'id_dokumen';

    protected $fillable = [
        'id_uploader',
        'judul_dokumen',
        'deskripsi',
        'path_file',
        'jenis_dokumen',
        'ukuran_file',
        'download_count',
        'tanggal_upload',
    ];

    protected $casts = [
        'tanggal_upload' => 'datetime',
        'ukuran_file' => 'integer',
        'download_count' => 'integer',
    ];

    // Relationships
    public function uploader()
    {
        return $this->belongsTo(User::class, 'id_uploader', 'id_user');
    }

    // Methods
    public function incrementDownload()
    {
        $this->increment('download_count');
    }
}
