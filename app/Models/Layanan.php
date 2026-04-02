<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $table = 'layanan';
    protected $primaryKey = 'id_layanan';
    
    protected $fillable = [
        'nama_layanan',
        'slug',
        'deskripsi_singkat',
        'deskripsi',
        'persyaratan',
        'prosedur',
        'biaya',
        'waktu_proses',
        'lokasi_pelayanan',
        'kontak',
        'icon_image',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get icon URL (handles local storage, /assets, and external URLs)
     */
    public function getIconUrlAttribute()
    {
        if (!$this->icon_image) {
            // Default fallback icon
            return asset('assets/icons/default-service.png');
        }

        // If starts with http (external URL like Cloudinary)
        if (str_starts_with($this->icon_image, 'http')) {
            return $this->icon_image;
        }

        // If starts with /assets (static assets)
        if (str_starts_with($this->icon_image, '/assets')) {
            return asset($this->icon_image);
        }

        // Local storage (e.g., "layanan/icons/abc.png")
        return asset('storage/' . $this->icon_image);
    }

    /**
     * Check if has custom icon
     */
    public function hasCustomIcon()
    {
        return !empty($this->icon_image);
    }

    /**
     * Get WhatsApp link
     */
    public function getWhatsappLinkAttribute()
    {
        if (!$this->kontak) {
            return null;
        }

        // Extract phone number from kontak
        $phone = preg_replace('/[^0-9]/', '', $this->kontak);
        
        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        return "https://wa.me/{$phone}";
    }

    /**
     * Scope: Only active layanan
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope: Ordered by urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan');
    }

    /**
     * Get biaya display (format currency if numeric)
     */
    public function getBiayaDisplayAttribute()
    {
        if (!$this->biaya) {
            return 'Gratis';
        }

        if (strtolower($this->biaya) === 'gratis' || $this->biaya === '0') {
            return 'Gratis';
        }

        // If numeric, format as Rupiah
        if (is_numeric(str_replace(['Rp', '.', ',', ' '], '', $this->biaya))) {
            $amount = (int) str_replace(['Rp', '.', ',', ' '], '', $this->biaya);
            return 'Rp ' . number_format($amount, 0, ',', '.');
        }

        return $this->biaya;
    }
}
