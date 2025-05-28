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
        Schema::create('ms_pendataan', function (Blueprint $table) {
            $table->id();
            $table->string("nama",250);
            $table->integer("kec_id")->index();
            $table->integer("kel_id")->index();
            $table->integer("rt_id")->index();
            $table->integer("rw_id")->index();
            $table->text("alamat");
            $table->string("kontak",25);
            $table->string("tarif_id",25)->index();
            $table->boolean("status")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ms_pendataan');
    }
};
