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
        Schema::table('screens', function (Blueprint $table) {
            // Añadir columnas que faltan
            $table->foreignId('website_id')->constrained()->onDelete('cascade')->after('id');  // Relación con la web
            $table->string('screen')->after('website_id');  // Nombre del tamaño de la pantalla
            $table->integer('width')->after('screen');  // Ancho de la pantalla
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('screens', function (Blueprint $table) {
            // Eliminar las columnas que se han añadido
            $table->dropForeign(['website_id']);
            $table->dropColumn(['website_id', 'screen', 'width']);
        });
    }
};
