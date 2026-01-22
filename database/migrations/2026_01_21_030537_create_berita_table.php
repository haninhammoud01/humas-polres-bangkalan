<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita', function (Blueprint $table) {
            $table->id('id_berita');
            $table->foreignId('id_kategori')->constrained('kategori_berita', 'id_kategori')->onDelete('cascade');
            $table->foreignId('id_penulis')->constrained('users', 'id_user')->onDelete('cascade');
            $table->string('judul', 255);
            $table->string('slug', 255)->unique();
            $table->text('konten');
            $table->text('ringkasan')->nullable();
            $table->string('gambar_utama')->nullable();
            $table->string('caption_gambar')->nullable();
            $table->dateTime('tanggal_publish')->nullable();
            $table->integer('views')->default(0);
            $table->enum('status', ['Draft', 'Published'])->default('Draft');
            $table->timestamps();
            
            // Index untuk optimasi
            $table->index('id_kategori');
            $table->index('id_penulis');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
