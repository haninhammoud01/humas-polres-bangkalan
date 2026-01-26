<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriBerita;

class KategoriBeritaSeeder extends Seeder
{
    public function run(): void
    {
        $kategoris = [
            [
                'nama_kategori' => 'Berita Terkini',
                'slug' => 'berita-terkini',
                'deskripsi' => 'Berita terbaru dan terkini dari Polres Bangkalan',
            ],
            [
                'nama_kategori' => 'Berita Layanan',
                'slug' => 'berita-layanan',
                'deskripsi' => 'Informasi layanan kepolisian kepada masyarakat',
            ],
            [
                'nama_kategori' => 'Berita Edukasi',
                'slug' => 'berita-edukasi',
                'deskripsi' => 'Edukasi keamanan dan tertib berlalu lintas',
            ],
            [
                'nama_kategori' => 'Berita Kriminal',
                'slug' => 'berita-kriminal',
                'deskripsi' => 'Informasi tindak kriminalitas dan penanganannya',
            ],
            [
                'nama_kategori' => 'Berita Lalu Lintas',
                'slug' => 'berita-lalu-lintas',
                'deskripsi' => 'Informasi lalu lintas dan kecelakaan',
            ],
        ];

        foreach ($kategoris as $kategori) {
            KategoriBerita::create($kategori);
        }
    }
}
