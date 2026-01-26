<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilPolres extends Model
{
    use HasFactory;

    protected $table = 'profil_polres';
    protected $primaryKey = 'id_profil';

    protected $fillable = [
        'sambutan_kapolres',
        'visi',
        'misi',
        'sejarah',
        'struktur_organisasi',
        'tugas_fungsi',
        'alamat',
        'telepon',
        'email',
        'fax',
        'facebook',
        'twitter',
        'instagram',
        'youtube',
    ];

    // Static method untuk get profil (karena hanya 1 record)
    public static function getProfil()
    {
        return self::first();
    }
}
