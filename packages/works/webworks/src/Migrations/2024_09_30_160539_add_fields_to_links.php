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
        Schema::table('links', function (Blueprint $table) {
            // Añadir columnas que faltan
            $table->foreignId('website_id')->constrained()->onDelete('cascade')->after('id');
            $table->string('text')->after('website_id');  // Texto del enlace
            $table->string('url')->after('text');  // URL del enlace
            $table->string('icon')->nullable()->after('url');  // Icono asociado al enlace
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('links', function (Blueprint $table) {
            // Eliminar las columnas que se han añadido
            $table->dropForeign(['website_id']);
            $table->dropColumn(['website_id', 'text', 'url', 'icon']);
        });
    }
};
