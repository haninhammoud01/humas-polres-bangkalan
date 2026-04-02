<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Pengumuman;
use App\Models\Layanan;
use App\Models\GaleriFoto;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // ============================================================
        // STATISTICS CARDS
        // ============================================================

        $stats = [
            'total_berita' => Berita::count(),
            'total_pengumuman' => Pengumuman::count(),
            'total_foto' => GaleriFoto::count(),
            'total_layanan' => Layanan::count(),
        ];

        // Berita bulan ini
        $stats['berita_bulan_ini'] = Berita::whereMonth('tanggal_publish', Carbon::now()->month)
            ->whereYear('tanggal_publish', Carbon::now()->year)
            ->count();

        // ============================================================
        // CHART DATA - BERITA PER BULAN (6 BULAN TERAKHIR)
        // ============================================================

        $chartData = [];
        $chartLabels = [];

        for ($i = 5; $i >= 0; $i--) {

            $date = Carbon::now()->subMonths($i);

            $chartLabels[] = $date->translatedFormat('F Y');

            $chartData[] = Berita::whereMonth('tanggal_publish', $date->month)
                ->whereYear('tanggal_publish', $date->year)
                ->count();
        }

        // ============================================================
        // RECENT ACTIVITIES
        // ============================================================

        // Berita terbaru
        $recentBerita = Berita::with('penulis')
            ->select('id_berita', 'judul', 'id_penulis', 'tanggal_publish', 'created_at')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'berita', 
                    'icon' => 'fa-newspaper',
                    'color' => 'primary',
                    'title' => 'Berita baru dipublikasikan',
                    'description' => $item->judul,
                    'user' => $item->penulis->nama ?? 'Admin',
                    'time' => $item->created_at,
                ];
            });

        // Pengumuman terbaru
        $recentPengumuman = Pengumuman::with('pembuat')
            ->select('id_pengumuman', 'judul', 'id_pembuat', 'created_at')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'type' => 'pengumuman',
                    'icon' => 'fa-bullhorn',
                    'color' => 'warning',
                    'title' => 'Pengumuman baru ditambahkan',
                    'description' => $item->judul,
                    'user' => $item->pembuat->nama ?? 'Admin',
                    'time' => $item->created_at,
                ];
            });

        // Gabungkan activity
        $recentActivities = $recentBerita
            ->concat($recentPengumuman)
            ->sortByDesc('time')
            ->take(10)
            ->values();

        // ============================================================
        // QUICK STATS FOR CARDS
        // ============================================================

        $quickStats = [
            [
                'title' => 'Total Berita',
                'value' => $stats['total_berita'],
                'icon' => 'fa-newspaper',
                'color' => 'primary',
                'change' => '+' . $stats['berita_bulan_ini'] . ' bulan ini',
                'link' => route('admin.berita.index'),
            ],
            [
                'title' => 'Total Pengumuman',
                'value' => $stats['total_pengumuman'],
                'icon' => 'fa-bullhorn',
                'color' => 'warning',
                'change' => 'Semua pengumuman',
                'link' => route('admin.pengumuman.index'),
            ],
            [
                'title' => 'Total Foto',
                'value' => $stats['total_foto'],
                'icon' => 'fa-camera',
                'color' => 'success',
                'change' => 'Galeri foto',
                'link' => route('admin.album.index'),
            ],
            [
                'title' => 'Total Layanan',
                'value' => $stats['total_layanan'],
                'icon' => 'fa-concierge-bell',
                'color' => 'info',
                'change' => 'Layanan publik',
                'link' => route('admin.layanan.index'),
            ],
        ];

        return view('admin.dashboard', compact(
            'stats',
            'chartData',
            'chartLabels',
            'recentActivities',
            'quickStats'
        ));
    }
}
