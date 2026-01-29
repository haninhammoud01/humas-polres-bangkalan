<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil Berita Terbaru (Status Published)
        $beritaTerbaru = \App\Models\Berita::published()->latest('tanggal_publish')->take(3)->get();
        
        // 2. Ambil Pengumuman (Status Aktif & Terbaru)
        // Menggunakan scope yang sudah ada di Model
        $pengumumanTerbaru = \App\Models\Pengumuman::aktif()->terbaru()->get();

        // 3. Variabel Placeholder (sementara kosong)
        $sliders = collect([]);

        return view('public.home', compact('sliders', 'beritaTerbaru', 'pengumumanTerbaru'));
    }
}
