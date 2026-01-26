<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $table = 'program';
    protected $primaryKey = 'id_program';

    protected $fillable = [
        'id_penanggung_jawab',
        'nama_program',
        'deskripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'lokasi',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    // Relationships
    public function penanggungJawab()
    {
        return $this->belongsTo(User::class, 'id_penanggung_jawab', 'id_user');
    }

    // Scopes
    public function scopeAktif($query)
    {
        return $query->where('status', 'Aktif');
    }
}
