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
    Schema::create('fila_cache', function (Blueprint $table) {
        $table->id();
        $table->foreignId('hospital_id')->constrained('hospitais')->onDelete('cascade');
        $table->integer('quantidade')->default(0);
        $table->timestamp('atualizado_em')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fila_cache');
    }
};
