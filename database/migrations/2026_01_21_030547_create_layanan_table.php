<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('layanan', function (Blueprint $table) {
            $table->id('id_layanan');
            $table->string('nama_layanan');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->text('informasi_umum')->nullable();
            $table->text('persyaratan')->nullable();
            $table->text('prosedur')->nullable();
            $table->text('jam_operasional')->nullable();
            $table->string('biaya')->nullable();
            $table->text('lokasi')->nullable();
            $table->string('kontak')->nullable();
            $table->string('icon')->nullable();
            $table->text('gambar')->nullable();
            $table->text('catatan')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Seed data - SEMUA KOLOM HARUS LENGKAP
        DB::table('layanan')->insert([
            // SKCK
            [
                'nama_layanan' => 'SKCK',
                'slug' => 'skck',
                'deskripsi' => 'Surat Keterangan Catatan Kepolisian',
                'informasi_umum' => 'Pembuatan SKCK di Polres Bangkalan saat ini disarankan melalui aplikasi Super App Polri (online) untuk kemudahan.',
                'persyaratan' => "1. Fotokopi KTP/SIM\n2. Fotokopi KK\n3. Fotokopi Akta Kelahiran\n4. Pas foto 4x6 latar merah (6 lembar)\n5. Sidik jari\n6. Surat pengantar Kelurahan",
                'prosedur' => null,
                'jam_operasional' => 'Senin - Jumat: 08.00 - 15.00 WIB',
                'biaya' => 'Rp 30.000',
                'lokasi' => 'Polres Bangkalan & MPP Bangkalan, Jl. Halim Perdana Kusuma',
                'kontak' => null,
                'icon' => 'fa-id-card',
                'gambar' => null,
                'catatan' => null,
                'urutan' => 1,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // SAMSAT
            [
                'nama_layanan' => 'SAMSAT',
                'slug' => 'samsat',
                'deskripsi' => 'Kantor Bersama Samsat Bangkalan',
                'informasi_umum' => 'Layanan pembayaran pajak kendaraan bermotor dan perpanjangan STNK.',
                'persyaratan' => "1. E-KTP Asli\n2. STNK Asli\n3. BPKB (Asli/Fotokopi)",
                'prosedur' => null,
                'jam_operasional' => "Senin - Kamis: 08.00 - 12.00 / 15.00 WIB\nJumat: 08.00 - 11.00 WIB\nSabtu: 08.00 - 12.00 WIB",
                'biaya' => null,
                'lokasi' => 'Jl. Soekarno Hatta No.35/12, Bangkalan',
                'kontak' => '031-3094179',
                'icon' => 'fa-car',
                'gambar' => null,
                'catatan' => null,
                'urutan' => 2,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // SIM
            [
                'nama_layanan' => 'SIM',
                'slug' => 'sim',
                'deskripsi' => 'Perpanjangan Surat Izin Mengemudi',
                'informasi_umum' => 'Gedung pelayanan SIM resmi pindah ke Jl. Raya Suramadu, Burneh, Bangkalan (Simpang 3 Tangkel)',
                'persyaratan' => "1. Fotokopi KTP & SIM (3 lembar)\n2. SIM asli (masih berlaku)\n3. Surat sehat jasmani\n4. Surat tes psikologi",
                'prosedur' => null,
                'jam_operasional' => "Senin - Kamis: 08.00 - 12.00 WIB\nJumat: 08.00 - 10.00 WIB",
                'biaya' => 'SIM A: Rp 80.000 | SIM C: Rp 75.000',
                'lokasi' => 'Jl. Raya Suramadu, Burneh, Simpang 3 Tangkel',
                'kontak' => null,
                'icon' => 'fa-id-card-alt',
                'gambar' => null,
                'catatan' => null,
                'urutan' => 3,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Layanan 110
            [
                'nama_layanan' => 'Layanan 110',
                'slug' => 'layanan-110',
                'deskripsi' => 'Call Center Darurat 24 Jam',
                'informasi_umum' => 'Layanan 110 Polres Bangkalan adalah pusat panggilan darurat 24 jam gratis untuk melaporkan tindak kejahatan, kecelakaan, atau gangguan kamtibmas.',
                'persyaratan' => null,
                'prosedur' => null,
                'jam_operasional' => '24 JAM NONSTOP - Setiap Hari',
                'biaya' => null,
                'lokasi' => null,
                'kontak' => '110 (Bebas Pulsa) | WA: 081223456110',
                'icon' => 'fa-phone-volume',
                'gambar' => null,
                'catatan' => null,
                'urutan' => 4,
                'is_active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
