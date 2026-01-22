<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('galeri_video', function (Blueprint $table) {
            $table->id('id_video');
            $table->foreignId('id_uploader')->constrained('users', 'id_user')->onDelete('cascade');
            $table->string('judul_video', 200);
            $table->string('url_video');
            $table->string('thumbnail')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('durasi', 20)->nullable();
            $table->integer('views')->default(0);
            $table->timestamp('tanggal_upload')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('galeri_video');
    }
};
