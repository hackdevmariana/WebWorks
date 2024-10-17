<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteSchoolsTable extends Migration
{
    public function up()
    {
        Schema::create('quote_schools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->json('links')->nullable(); // Campo opcional para enlaces relacionados (redes sociales, web, etc.)
            $table->text('description')->nullable();
            $table->string('active_stage')->nullable(); // Campo opcional que describe el periodo de actividad
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_schools');
    }
}
