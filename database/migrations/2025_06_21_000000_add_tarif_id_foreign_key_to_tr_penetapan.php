<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTarifIdForeignKeyToTrPenetapan extends Migration
{
    public function up()
    {
        Schema::table('tr_penetapan', function (Blueprint $table) {
            if (!Schema::hasColumn('tr_penetapan', 'tarif_id')) {
                $table->unsignedBigInteger('tarif_id')->nullable()->after('pimpinan_id');
            } else {
                // Modify column type to unsignedBigInteger if needed
                $table->unsignedBigInteger('tarif_id')->nullable()->change();
            }
        });

        Schema::table('tr_penetapan', function (Blueprint $table) {
            $table->foreign('tarif_id')->references('id')->on('ms_tarif')->onDelete('restrict');
        });
    }

    public function down()
    {
        Schema::table('tr_penetapan', function (Blueprint $table) {
            $table->dropForeign(['tarif_id']);
            // Optionally drop the column if it was added by this migration
            // $table->dropColumn('tarif_id');
        });
    }
}
