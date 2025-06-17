<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migrasi untuk membuat tabel kolektor
     */
    public function up(): void
    {
        Schema::create('kolektor', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('kel_id')->index(); // Foreign key ke tabel ms_kelurahan
            $table->string('nama'); // Nama kolektor
            $table->string('status'); // Status kolektor
            $table->timestamps(); // created_at dan updated_at

            // Mendefinisikan foreign key constraint dengan onDelete restrict
            $table->foreign('kel_id')->references('id')->on('ms_kelurahan')->onDelete('restrict');
        });
    }

    /**
     * Membatalkan migrasi dengan menghapus tabel kolektor
     */
    public function down(): void
    {
        Schema::dropIfExists('kolektor');
    }
};
