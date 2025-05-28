<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ms_tarif', function (Blueprint $table) {
            $table->string('jenis')->nullable()->after('nama');
            $table->string('zona')->nullable()->after('jenis');
            $table->string('lokasi')->nullable()->after('zona');
            $table->string('uraian')->nullable()->after('lokasi');
            $table->string('dasar')->nullable()->after('uraian');
        });
    }

    public function down(): void
    {
        Schema::table('ms_tarif', function (Blueprint $table) {
            $table->dropColumn(['jenis', 'zona', 'lokasi', 'uraian', 'dasar']);
        });
    }
}; 