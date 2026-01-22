<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('album_foto', function (Blueprint $table) {
            $table->id('id_album');
            $table->foreignId('id_pembuat')->constrained('users', 'id_user')->onDelete('cascade');
            $table->string('nama_album', 200);
            $table->text('deskripsi')->nullable();
            $table->string('cover_album')->nullable();
            $table->timestamp('tanggal_dibuat')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('album_foto');
    }
};

