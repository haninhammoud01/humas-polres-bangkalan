<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Add is_active to slider if not exists
        if (!Schema::hasColumn('slider', 'is_active')) {
            Schema::table('slider', function (Blueprint $table) {
                $table->boolean('is_active')->default(true);
            });
        }

        // Add columns to album_foto if not exist
        if (!Schema::hasColumn('album_foto', 'is_active')) {
            Schema::table('album_foto', function (Blueprint $table) {
                $table->boolean('is_active')->default(true);
            });
        }

        if (!Schema::hasColumn('album_foto', 'tanggal_dibuat')) {
            Schema::table('album_foto', function (Blueprint $table) {
                $table->timestamp('tanggal_dibuat')->nullable();
            });
        }

        // Update existing records
        DB::statement('UPDATE slider SET is_active = true WHERE is_active IS NULL');
        DB::statement('UPDATE album_foto SET is_active = true WHERE is_active IS NULL');
        DB::statement('UPDATE album_foto SET tanggal_dibuat = created_at WHERE tanggal_dibuat IS NULL');
    }

    public function down()
    {
        Schema::table('slider', function (Blueprint $table) {
            $table->dropColumn('is_active');
        });

        Schema::table('album_foto', function (Blueprint $table) {
            $table->dropColumn(['is_active', 'tanggal_dibuat']);
        });
    }
};
