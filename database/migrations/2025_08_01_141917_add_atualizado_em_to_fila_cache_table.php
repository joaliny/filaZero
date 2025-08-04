<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('fila_cache', function (Blueprint $table) {
        $table->timestamp('atualizado_em')->nullable()->after('hospital_id');
    });
}

public function down()
{
    Schema::table('fila_cache', function (Blueprint $table) {
        $table->dropColumn('atualizado_em');
    });
}

};


    /**
     * Reverse the migrations.
     */
