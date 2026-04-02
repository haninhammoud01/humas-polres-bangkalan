<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilPolres extends Model
{
    protected $table = 'profil_polres';
    protected $primaryKey = 'id_profil';
    
    protected $fillable = [
        'nama_instansi',
        'alamat',
        'telepon',
        'email',
        'fax',
        'website',
        'logo',
        'gedung_image',
        'visi',
        'misi',
        'motto',
        'sejarah',
        'tugas_pokok',
        'fungsi',
        'struktur_organisasi_text',
        'struktur_organisasi_image',
        'nama_kapolres',
        'pangkat_kapolres',
        'nrp_kapolres',
        'foto_kapolres',
        'sambutan_kapolres',
        'wilayah_hukum',
        'luas_wilayah',
        'jumlah_kecamatan',
        'jumlah_desa',
        'facebook_url',
        'instagram_url',
        'twitter_url',
        'youtube_url',
        'tiktok_url',
        'maps_embed_url',
        'latitude',
        'longitude',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'jumlah_kecamatan' => 'integer',
        'jumlah_desa' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get singleton instance (auto-create if not exists)
     */
    public static function getInstance()
    {
        $profil = self::first();

        if (!$profil) {
            $profil = self::create([
                'nama_instansi' => 'Polres Bangkalan',
                'is_active' => true,
            ]);
        }

        return $profil;
    }

    /**
     * Get logo URL
     */
    public function getLogoUrlAttribute()
    {
        if (!$this->logo) {
            return asset('assets/images/logo.png'); // Fallback
        }

        if (str_starts_with($this->logo, 'http')) {
            return $this->logo;
        }

        return asset('storage/' . $this->logo);
    }

    /**
     * Get gedung image URL
     */
    public function getGedungImageUrlAttribute()
    {
        if (!$this->gedung_image) {
            return null;
        }

        if (str_starts_with($this->gedung_image, 'http')) {
            return $this->gedung_image;
        }

        return asset('storage/' . $this->gedung_image);
    }

    /**
     * Get foto kapolres URL
     */
    public function getFotoKapolresUrlAttribute()
    {
        if (!$this->foto_kapolres) {
            return null;
        }

        if (str_starts_with($this->foto_kapolres, 'http')) {
            return $this->foto_kapolres;
        }

        return asset('storage/' . $this->foto_kapolres);
    }

    /**
     * Get struktur organisasi image URL
     */
    public function getStrukturOrganisasiImageUrlAttribute()
    {
        if (!$this->struktur_organisasi_image) {
            return null;
        }

        if (str_starts_with($this->struktur_organisasi_image, 'http')) {
            return $this->struktur_organisasi_image;
        }

        return asset('storage/' . $this->struktur_organisasi_image);
    }

    /**
     * Check if has struktur organisasi (text or image)
     */
    public function hasStrukturOrganisasi()
    {
        return $this->struktur_organisasi_text || $this->struktur_organisasi_image;
    }

    /**
     * Get misi as array (split by newline)
     */
    public function getMisiArrayAttribute()
    {
        if (!$this->misi) {
            return [];
        }

        return array_filter(explode("\n", $this->misi));
    }

    /**
     * Get fungsi as array (split by newline)
     */
    public function getFungsiArrayAttribute()
    {
        if (!$this->fungsi) {
            return [];
        }

        return array_filter(explode("\n", $this->fungsi));
    }
}
