<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCyclesTable extends Migration
{
    public function up()
    {
        Schema::create('cycles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->date('start');
            $table->date('end')->nullable();
            $table->string('pattern')->nullable();
            $table->string('days')->nullable();
            $table->json('links')->nullable(); // Para almacenar múltiples enlaces
            $table->json('media')->nullable(); // Para almacenar URLs de media
            $table->string('tag')->nullable(); // Para agregar etiquetas
            $table->string('frequency')->nullable(); // Frecuencia (e.g., weekly, monthly)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cycles');
    }
}
