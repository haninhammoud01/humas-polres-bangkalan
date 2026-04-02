<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuNavigasi extends Model
{
    use HasFactory;

    protected $table = 'menu_navigasi';
    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'nama_menu',
        'url',
        'icon',
        'urutan',
        'is_active',
        'target',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    /**
     * Scope untuk menu aktif saja
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk urutan
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc');
    }
}
