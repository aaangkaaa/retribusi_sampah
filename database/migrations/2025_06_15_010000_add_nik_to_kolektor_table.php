<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migrasi untuk menambahkan kolom nik pada tabel kolektor
     */
    public function up(): void
    {
        Schema::table('kolektor', function (Blueprint $table) {
            $table->string('nik', 50)->after('nama')->nullable()->index();
        });
    }

    /**
     * Membatalkan migrasi dengan menghapus kolom nik dari tabel kolektor
     */
    public function down(): void
    {
        Schema::table('kolektor', function (Blueprint $table) {
            $table->dropColumn('nik');
        });
    }
};
