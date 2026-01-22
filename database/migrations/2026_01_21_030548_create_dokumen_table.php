<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dokumen', function (Blueprint $table) {
            $table->id('id_dokumen');
            $table->foreignId('id_uploader')->constrained('users', 'id_user')->onDelete('cascade');
            $table->string('judul_dokumen', 200);
            $table->text('deskripsi')->nullable();
            $table->string('path_file');
            $table->string('jenis_dokumen', 50)->nullable();
            $table->integer('ukuran_file')->nullable();
            $table->integer('download_count')->default(0);
            $table->timestamp('tanggal_upload')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dokumen');
    }
};
