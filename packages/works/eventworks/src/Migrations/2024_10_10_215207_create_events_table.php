<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->integer('days');
            $table->time('time')->nullable();
            $table->decimal('price', 8, 2)->nullable(); // Precio opcional
            $table->foreignId('organizer_id')->nullable()->constrained()->onDelete('set null'); // Organizador opcional
            $table->json('links')->nullable(); // Lista de links en JSON
            $table->string('weather')->nullable();
            $table->integer('capacity')->nullable();
            $table->json('tags')->nullable();
            $table->string('status')->default('active');
            $table->string('type');
            $table->boolean('virtual')->default(false);
            $table->foreignId('cycle_id')->nullable()->constrained()->onDelete('set null'); // Ciclo opcional
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}
