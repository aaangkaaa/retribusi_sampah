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
        Schema::table('tr_pembayaran', function (Blueprint $table) {
            $table->renameColumn('penetapan_id', 'wr_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_pembayaran', function (Blueprint $table) {
            $table->renameColumn('wr_id', 'penetapan_id');
        });
    }
};
