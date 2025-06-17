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
        Schema::table('tr_wajib_retribusi', function (Blueprint $table) {
            // Modify rt_id column to unsignedBigInteger to match ms_rt.id
            $table->unsignedBigInteger('rt_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_wajib_retribusi', function (Blueprint $table) {
            // Revert rt_id column to integer
            $table->integer('rt_id')->change();
        });
    }
};
