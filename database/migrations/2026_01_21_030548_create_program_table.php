<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('program', function (Blueprint $table) {
            $table->id('id_program');
            $table->foreignId('id_penanggung_jawab')->constrained('users', 'id_user')->onDelete('cascade');
            $table->string('nama_program', 200);
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('lokasi', 200)->nullable();
            $table->enum('status', ['Aktif', 'Selesai', 'Ditunda'])->default('Aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('program');
    }
};
