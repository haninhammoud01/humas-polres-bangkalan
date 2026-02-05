<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Slider;
use App\Models\Pengumuman;
use App\Models\Layanan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the welcome/home page
     */
    public function index()
    {
        // Ambil 3 berita terbaru yang sudah published
        $beritas = Berita::where('status', 'Published')
                         ->orderBy('tanggal_publish', 'desc')
                         ->take(3)
                         ->get();
        
        // Ambil slider yang aktif
        $sliders = Slider::where('status', 'Aktif')
                        ->orderBy('urutan', 'asc')
                        ->get();
        
        // Ambil pengumuman yang aktif
        $pengumumans = Pengumuman::where('status', 'Aktif')
                                 ->orderBy('tanggal', 'desc')
                                 ->take(5)
                                 ->get();
        
        // Ambil layanan
        $layanans = Layanan::orderBy('urutan', 'asc')
                          ->take(4)
                          ->get();
        
        return view('welcome', compact('beritas', 'sliders', 'pengumumans', 'layanans'));
    }
}
