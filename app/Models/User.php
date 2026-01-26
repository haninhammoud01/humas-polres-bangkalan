<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKey = 'id_user';

    protected $fillable = [
        'username',
        'password',
        'nama',
        'nrp',
        'pangkat',
        'jabatan',
        'role',
        'foto_profil',
        'email',
        'telepon',
        'status_aktif',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'status_aktif' => 'boolean',
        'password' => 'hashed',
    ];

    // Relationships
    public function berita()
    {
        return $this->hasMany(Berita::class, 'id_penulis', 'id_user');
    }

    public function albumFoto()
    {
        return $this->hasMany(AlbumFoto::class, 'id_pembuat', 'id_user');
    }

    public function galeriVideo()
    {
        return $this->hasMany(GaleriVideo::class, 'id_uploader', 'id_user');
    }

    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class, 'id_pembuat', 'id_user');
    }

    public function program()
    {
        return $this->hasMany(Program::class, 'id_penanggung_jawab', 'id_user');
    }

    public function dokumen()
    {
        return $this->hasMany(Dokumen::class, 'id_uploader', 'id_user');
    }
}
