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
        Schema::create('ms_tarif', function (Blueprint $table) {
            $table->id();
            $table->string("nama",128);
            $table->decimal('nilai', 18, 2);
            $table->string('jenis')->nullable()->after('nama');
            $table->string('zona')->nullable()->after('jenis');
            $table->string('lokasi')->nullable()->after('zona');
            $table->string('uraian')->nullable()->after('lokasi');
            $table->string('dasar')->nullable()->after('uraian');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_tarif');
    }
};
