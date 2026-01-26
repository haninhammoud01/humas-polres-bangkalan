<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';

    protected $fillable = [
        'id_pembuat',
        'judul',
        'isi_pengumuman',
        'tanggal',
        'prioritas',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];

    // Relationships
    public function pembuat()
    {
        return $this->belongsTo(User::class, 'id_pembuat', 'id_user');
    }

    // Scopes
    public function scopeAktif($query)
    {
        return $query->where('status', 'Aktif');
    }

    public function scopeTerbaru($query)
    {
        return $query->orderBy('tanggal', 'desc');
    }
}
