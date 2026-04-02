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
        Schema::create('menu_navigasi', function (Blueprint $table) {
            $table->id('id_menu');
            $table->string('nama_menu', 100);
            $table->string('url', 255);
            $table->string('icon', 50)->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->enum('target', ['_self', '_blank'])->default('_self');
            $table->timestamps();
        });

        // Insert default menu
        DB::table('menu_navigasi')->insert([
            [
                'nama_menu' => 'Tentang Kami',
                'url' => '/profil',
                'icon' => 'fa-building',
                'urutan' => 1,
                'is_active' => true,
                'target' => '_self',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Informasi Publik',
                'url' => '/berita',
                'icon' => 'fa-newspaper',
                'urutan' => 2,
                'is_active' => true,
                'target' => '_self',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Layanan',
                'url' => '/layanan',
                'icon' => 'fa-concierge-bell',
                'urutan' => 3,
                'is_active' => true,
                'target' => '_self',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Pengumuman',
                'url' => '/pengumuman',
                'icon' => 'fa-bullhorn',
                'urutan' => 4,
                'is_active' => true,
                'target' => '_self',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_menu' => 'Galeri',
                'url' => '/galeri',
                'icon' => 'fa-images',
                'urutan' => 5,
                'is_active' => true,
                'target' => '_self',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu_navigasi');
    }
};
