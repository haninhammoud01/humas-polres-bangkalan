<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profil_polres', function (Blueprint $table) {
            $table->id('id_profil');
            
            // Basic Info
            $table->string('nama_instansi');
            $table->text('alamat');
            $table->string('telepon', 50)->nullable();
            $table->string('email')->nullable();
            $table->string('website')->nullable();
            $table->string('fax', 50)->nullable();
            
            // Logo & Images
            $table->string('logo')->nullable();
            $table->string('gedung_image')->nullable();
            
            // Visi Misi
            $table->text('visi')->nullable();
            $table->text('misi')->nullable();
            $table->text('motto')->nullable();
            
            // Sejarah & Profil
            $table->text('sejarah')->nullable();
            $table->text('tugas_pokok')->nullable();
            $table->text('fungsi')->nullable();
            
            // Struktur Organisasi
            $table->text('struktur_organisasi_text')->nullable();
            $table->string('struktur_organisasi_image')->nullable(); // Cloudinary URL for bagan
            
            // Pimpinan
            $table->string('nama_kapolres')->nullable();
            $table->string('pangkat_kapolres')->nullable();
            $table->string('nrp_kapolres')->nullable();
            $table->string('foto_kapolres')->nullable();
            $table->text('sambutan_kapolres')->nullable();
            
            // Wilayah Hukum
            $table->text('wilayah_hukum')->nullable();
            $table->string('luas_wilayah')->nullable();
            $table->integer('jumlah_kecamatan')->nullable();
            $table->integer('jumlah_desa')->nullable();
            
            // Social Media
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('tiktok_url')->nullable();
            
            // Maps
            $table->string('maps_embed_url')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            
            // Meta
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profil_polres');
    }
};
