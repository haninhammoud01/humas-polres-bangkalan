<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Berita;
use App\Models\User;
use App\Models\KategoriBerita;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'Admin')->first();
        $kategori = KategoriBerita::first();
        
        $beritaList = [
            [
                'judul' => 'Polres Bangkalan Gelar Operasi Patuh 2026',
                'konten' => 'Polres Bangkalan menggelar Operasi Patuh 2026 untuk meningkatkan keselamatan berlalu lintas di wilayah Bangkalan...',
                'ringkasan' => 'Operasi patuh untuk tingkatkan keselamatan berlalu lintas',
            ],
            [
                'judul' => 'Sosialisasi Protokol Kesehatan di Pasar Tradisional',
                'konten' => 'Tim Humas Polres Bangkalan melakukan sosialisasi protokol kesehatan kepada pedagang dan pengunjung pasar...',
                'ringkasan' => 'Sosialisasi prokes untuk cegah penyebaran penyakit',
            ],
            [
                'judul' => 'Polres Bangkalan Salurkan Bantuan untuk Korban Bencana',
                'konten' => 'Polres Bangkalan menyalurkan bantuan kemanusiaan kepada korban bencana alam di wilayah Bangkalan...',
                'ringkasan' => 'Bantuan kemanusiaan untuk korban bencana alam',
            ],
        ];
        
        foreach ($beritaList as $berita) {
            Berita::create([
                'id_kategori' => $kategori->id_kategori,
                'id_penulis' => $admin->id_user,
                'judul' => $berita['judul'],
                'slug' => Str::slug($berita['judul']),
                'konten' => $berita['konten'],
                'ringkasan' => $berita['ringkasan'],
                'tanggal_publish' => now(),
                'status' => 'Published',
            ]);
        }
    }
}
