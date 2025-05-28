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
        Schema::create('tr_penetapan', function (Blueprint $table) {
            $table->id();
            $table->integer("wr_id")->index();
            $table->integer("tarif_id")->index();
            $table->unsignedInteger("periode");
            $table->unsignedInteger("tahun");
            $table->date("tgl_pembayaran");
            $table->decimal("jumlah",18,2);
            $table->boolean("status")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_penetapan');
    }
};
