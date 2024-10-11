<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreregistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('preregistrations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('slug')->unique();
            $table->string('email')->unique();
            $table->enum('mode', ['online', 'offline']); // Modo de asistencia
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending'); // Estado de la pre-registración
            $table->foreignId('event_id')->constrained()->onDelete('cascade'); // Relación con el evento
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('preregistrations');
    }
}
