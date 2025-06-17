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
        Schema::table('tr_penetapan', function (Blueprint $table) {
            $table->unsignedBigInteger('wr_id')->nullable()->after('pimpinan_id');

            $table->foreign('wr_id')->references('id')->on('tr_wajib_retribusi')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tr_penetapan', function (Blueprint $table) {    
            $table->dropForeign(['wr_id']);
            $table->dropColumn('wr_id');        
        }); 
    }
};
