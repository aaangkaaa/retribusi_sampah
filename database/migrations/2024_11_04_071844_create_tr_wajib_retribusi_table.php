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
        Schema::create('tr_wajib_retribusi', function (Blueprint $table) {
            $table->id();
            $table->string("npwr",128)->unique();
            $table->string("nama",255);
            $table->string("alamat",255);
            $table->integer("rt_id")->index();
            $table->string("kontak",50);
            $table->integer("tarif_id")->index();
            $table->boolean("status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tr_wajib_retribusi');
    }
};
