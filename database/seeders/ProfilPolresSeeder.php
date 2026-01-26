<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfilPolres;

class ProfilPolresSeeder extends Seeder
{
    public function run(): void
    {
        ProfilPolres::create([
            'sambutan_kapolres' => 'Assalamualaikum Warahmatullahi Wabarakatuh.

Selamat datang di website resmi Polres Bangkalan. Website ini hadir sebagai bentuk komitmen kami dalam memberikan pelayanan informasi yang transparan dan akuntabel kepada masyarakat.

Melalui website ini, masyarakat dapat mengakses berbagai informasi tentang layanan kepolisian, program-program yang kami jalankan, serta berita terkini seputar keamanan dan ketertiban di wilayah Bangkalan.

Kami berharap website ini dapat menjadi jembatan komunikasi yang efektif antara Polres Bangkalan dengan seluruh lapisan masyarakat.

Wassalamualaikum Warahmatullahi Wabarakatuh.

AKBP [...]
Kapolres Bangkalan',
            
            'visi' => 'Terwujudnya pelayanan keamanan dan ketertiban masyarakat yang profesional, modern, dan terpercaya',
            
            'misi' => "1. Memberikan perlindungan, pengayoman, dan pelayanan kepada masyarakat
2. Menegakkan hukum secara profesional dan proporsional
3. Memelihara keamanan dan ketertiban masyarakat
4. Membangun kemitraan dengan masyarakat dan stakeholder
5. Meningkatkan kapasitas SDM Polri yang profesional",
            
            'sejarah' => 'Polres Bangkalan merupakan salah satu satuan kewilayahan Polda Jawa Timur yang bertugas melaksanakan tugas kepolisian di wilayah Kabupaten Bangkalan.

Polres Bangkalan dibentuk berdasarkan Surat Keputusan Kapolri dan telah mengalami berbagai perkembangan seiring dengan dinamika keamanan dan ketertiban di wilayah Bangkalan.

Dengan semangat pengabdian kepada negara dan masyarakat, Polres Bangkalan terus berupaya memberikan pelayanan terbaik dalam menjaga keamanan, ketertiban, dan penegakan hukum.',
            
            'tugas_fungsi' => "Tugas Pokok:
Melaksanakan tugas kepolisian yang meliputi pemeliharaan keamanan dan ketertiban masyarakat, penegakan hukum, perlindungan, pengayoman, dan pelayanan kepada masyarakat.

Fungsi:
1. Pelaksanaan kegiatan penyelidikan dan penyidikan tindak pidana
2. Pelaksanaan identifikasi, laboratorium forensik, dan psikologi
3. Pelaksanaan pembinaan fungsi intelijen, reserse kriminal, lalu lintas, dan sabhara
4. Pelaksanaan fungsi bantuan dan kerja sama dengan instansi lain
5. Pelaksanaan administrasi dan pembinaan SDM",
            
            'alamat' => 'Jl. Soekarno Hatta No. 1, Bangkalan, Jawa Timur 69116',
            'telepon' => '(031) 3095110',
            'email' => 'info@polresbangkalan.id',
            'fax' => '(031) 3095111',
            'facebook' => 'polresbangkalan',
            'twitter' => '@polresbangkalan',
            'instagram' => '@polresbangkalan',
            'youtube' => 'Polres Bangkalan Official',
        ]);
    }
}
