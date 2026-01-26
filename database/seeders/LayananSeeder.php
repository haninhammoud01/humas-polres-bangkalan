<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Layanan;

class LayananSeeder extends Seeder
{
    public function run(): void
    {
        $layanans = [
            [
                'nama_layanan' => 'Pembuatan SIM',
                'deskripsi' => 'Layanan pembuatan Surat Izin Mengemudi baru dan perpanjangan',
                'persyaratan' => "1. KTP Asli\n2. Foto 4x6 (3 lembar)\n3. Surat Keterangan Sehat dari Dokter\n4. Mengikuti tes tertulis dan praktik",
                'prosedur' => "1. Daftar online atau datang langsung\n2. Melengkapi persyaratan\n3. Mengikuti tes tertulis\n4. Mengikuti tes praktik\n5. Foto dan tanda tangan\n6. Pengambilan SIM",
                'waktu_layanan' => 'Senin - Jumat: 08.00 - 14.00 WIB',
                'biaya' => 'Sesuai Peraturan Kapolri',
                'urutan' => 1,
            ],
            [
                'nama_layanan' => 'Pembuatan SKCK',
                'deskripsi' => 'Layanan pembuatan Surat Keterangan Catatan Kepolisian',
                'persyaratan' => "1. KTP Asli\n2. Kartu Keluarga Asli\n3. Pas Foto 4x6 (6 lembar)\n4. Akta Kelahiran/Ijazah",
                'prosedur' => "1. Mengisi formulir\n2. Melengkapi persyaratan\n3. Pemeriksaan berkas\n4. Sidik jari\n5. Foto\n6. Pengambilan SKCK",
                'waktu_layanan' => 'Senin - Jumat: 08.00 - 14.00 WIB',
                'biaya' => 'Rp 30.000',
                'urutan' => 2,
            ],
            [
                'nama_layanan' => 'Lapor Polisi',
                'deskripsi' => 'Layanan pelaporan tindak pidana atau kehilangan',
                'persyaratan' => "1. KTP Pelapor\n2. Kronologi kejadian\n3. Bukti pendukung (jika ada)",
                'prosedur' => "1. Datang ke kantor polisi\n2. Menemui petugas jaga\n3. Menceritakan kronologi\n4. Membuat BAP (Berita Acara Pemeriksaan)\n5. Menerima surat tanda laporan",
                'waktu_layanan' => '24 Jam',
                'biaya' => 'Gratis',
                'urutan' => 3,
            ],
            [
                'nama_layanan' => 'Izin Keramaian',
                'deskripsi' => 'Layanan perizinan kegiatan yang mengumpulkan massa',
                'persyaratan' => "1. Surat permohonan\n2. KTP Penanggung jawab\n3. Proposal kegiatan\n4. Denah lokasi",
                'prosedur' => "1. Mengajukan surat permohonan\n2. Melengkapi persyaratan\n3. Survey lokasi\n4. Verifikasi berkas\n5. Penerbitan izin",
                'waktu_layanan' => 'Senin - Jumat: 08.00 - 14.00 WIB',
                'biaya' => 'Gratis',
                'urutan' => 4,
            ],
        ];

        foreach ($layanans as $layanan) {
            Layanan::create($layanan);
        }
    }
}
