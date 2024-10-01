<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('section_headings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')->constrained('websites')->onDelete('cascade');
            $table->string('name'); // Nombre del encabezado (e.g., noticias, contacto, redes sociales)
            $table->string('title'); // Título que aparecerá en el frontend
            $table->enum('h', ['h1', 'h2', 'h3', 'h4', 'h5', 'h6']); // Tipo de encabezado (h1, h2, etc.)
            $table->string('class')->nullable(); // Clase CSS personalizada
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('section_headings');
    }
};
