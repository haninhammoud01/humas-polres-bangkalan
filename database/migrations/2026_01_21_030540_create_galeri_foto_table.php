<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri_foto', function (Blueprint $table) {
            $table->id('id_foto');
            $table->foreignId('id_album')->constrained('album_foto', 'id_album')->onDelete('cascade');
            $table->foreignId('id_uploader')->constrained('users', 'id_user')->onDelete('cascade');
            $table->string('judul_foto', 200)->nullable();
            $table->string('path_foto');
            $table->text('deskripsi')->nullable();
            $table->integer('ukuran_file')->nullable();
            $table->timestamp('tanggal_upload')->useCurrent();
            $table->timestamps();
            
            $table->index('id_album');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_foto');
    }
};
