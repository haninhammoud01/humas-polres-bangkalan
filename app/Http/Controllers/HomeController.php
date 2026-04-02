<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Slider;
use App\Models\Layanan;
use App\Models\Album;
use App\Models\Pengumuman;

class HomeController extends Controller
{
    /**
     * Display homepage with all dynamic content
     */
    public function index()
    {
        // 1. Ambil Berita Terbaru
        $beritas = Berita::with(['kategori', 'penulis'])
                        ->where('status', 'Published')
                        ->where('tanggal_publish', '<=', now())
                        ->orderBy('tanggal_publish', 'desc')
                        ->take(3)
                        ->get();

        // 2. Ambil Slider
        $sliders = Slider::where('is_active', true)
                        ->orderBy('urutan')
                        ->get();

        // 3. Ambil Layanan
        $layanans = Layanan::where('is_active', true)
                          ->orderBy('urutan')
                          ->take(4)
                          ->get();

        // 4. Ambil Album Foto
        $albums = Album::with('photos')
                      ->where('is_active', true)
                      ->withCount('photos')
                      ->orderBy('tanggal_dibuat', 'desc')
                      ->take(6)
                      ->get();

        // 5. Ambil Pengumuman untuk Running Text (TANPA prioritas)
        try {
            $pengumumans = Pengumuman::where('status', 'Aktif') // Menggunakan status Aktif sesuai DB baru
                                    ->orderBy('tanggal', 'desc')
                                    ->take(5)
                                    ->get();
        } catch (\Exception $e) {
            \Log::error('Pengumuman query error: ' . $e->getMessage());
            $pengumumans = collect(); 
        }

        return view('welcome', compact(
            'beritas', 
            'sliders', 
            'layanans', 
            'albums', 
            'pengumumans'
        ));
    }
}
