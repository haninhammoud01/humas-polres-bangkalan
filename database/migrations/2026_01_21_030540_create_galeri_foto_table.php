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
            $table->unsignedBigInteger('id_album');
            $table->unsignedBigInteger('id_uploader');
            $table->text('path_foto');
            $table->bigInteger('ukuran_file')->nullable();
            $table->timestamp('tanggal_upload')->useCurrent();
            $table->timestamps();
            
            // Foreign keys
            $table->foreign('id_album')
                ->references('id_album')
                ->on('album_foto')  // ← HARUS sama dengan nama table di album migration
                ->onDelete('cascade');
                
            $table->foreign('id_uploader')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade');
        });
    }
};
