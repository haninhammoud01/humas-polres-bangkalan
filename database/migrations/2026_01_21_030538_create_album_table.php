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
        Schema::create('album_foto', function (Blueprint $table) {  // ← HARUS album_foto
            $table->id('id_album');
            $table->string('nama_album');
            $table->text('deskripsi')->nullable();
            $table->timestamp('tanggal_dibuat')->useCurrent();
            $table->unsignedBigInteger('id_pembuat');
            $table->timestamps();
            
            // Foreign key to users
            $table->foreign('id_pembuat')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('album_foto');  // ← HARUS album_foto
    }
};

