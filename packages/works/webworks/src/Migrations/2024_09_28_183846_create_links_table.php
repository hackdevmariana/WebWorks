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
        // Solo crea la tabla si no existe
        if (!Schema::hasTable('links')) {
            Schema::create('links', function (Blueprint $table) {
                $table->id();
                $table->foreignId('website_id')->constrained()->onDelete('cascade'); // Relación con la web
                $table->string('text');  // Texto del enlace
                $table->string('url');  // URL del enlace
                $table->string('icon')->nullable();  // Icono asociado al enlace
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
