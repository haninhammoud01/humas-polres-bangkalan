<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('berita_tag', function (Blueprint $table) {
            $table->foreignId('id_berita')->constrained('berita', 'id_berita')->onDelete('cascade');
            $table->foreignId('id_tag')->constrained('tag', 'id_tag')->onDelete('cascade');
            $table->primary(['id_berita', 'id_tag']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berita_tag');
    }
};
