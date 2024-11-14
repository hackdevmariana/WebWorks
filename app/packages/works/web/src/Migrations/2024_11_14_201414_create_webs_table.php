<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('webs', function (Blueprint $table) {
            $table->id();
            $table->string('url')->unique(); // Cambia 'web' a 'url' para mayor claridad
            $table->string('home')->nullable(); // Puede ser opcional si algunas webs no tienen una página inicial definida
            $table->string('title')->index(); // Index para búsquedas rápidas en el título
            $table->text('description')->nullable(); // Cambia a 'text' si la descripción es larga
            $table->string('keywords')->nullable();
            $table->string('favicon')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('webs');
    }
};
