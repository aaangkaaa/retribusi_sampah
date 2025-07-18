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
        Schema::create('trd_pembayaran', function (Blueprint $table) {
            $table->id();
            $table->integer('pembayaran_id');
            $table->integer('penetapan_id');
            $table->decimal('total_pembayaran', 18, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trd_pembayaran');
    }
};
