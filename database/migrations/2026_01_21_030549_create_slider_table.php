<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('slider', function (Blueprint $table) {
            $table->id('id_slider');
            $table->string('judul', 200)->nullable();
            $table->string('gambar');
            $table->string('link')->nullable();
            $table->integer('urutan')->default(0);
            $table->enum('status', ['Aktif', 'Nonaktif'])->default('Aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slider');
    }
};
