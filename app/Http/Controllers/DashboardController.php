<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung jumlah data untuk statistik
        $totalBerita = \App\Models\Berita::count();
        $totalPengumuman = \App\Models\Pengumuman::count();
        
        // Ambil 5 berita terakhir untuk notifikasi ringkas di dashboard
        $recentBeritas = \App\Models\Berita::latest('tanggal_publish')->take(5)->get();

        return view('dashboard', compact('totalBerita', 'totalPengumuman', 'recentBeritas'));
    }
}
