<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpeakersTable extends Migration
{
    public function up()
    {
        Schema::create('speakers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('slug')->unique();
            $table->text('biography')->nullable();
            $table->text('books')->nullable(); // Libros relacionados
            $table->timestamps();
        });

        // Tabla pivote entre speakers y events
        Schema::create('event_speaker', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            $table->foreignId('speaker_id')->constrained()->onDelete('cascade');
        });

        // Tabla pivote entre speakers y links
        Schema::create('link_speaker', function (Blueprint $table) {
            $table->id();
            $table->foreignId('link_id')->constrained()->onDelete('cascade');
            $table->foreignId('speaker_id')->constrained()->onDelete('cascade');
        });

        // Tabla pivote entre speakers y media
        Schema::create('media_speaker', function (Blueprint $table) {
            $table->id();
            $table->foreignId('media_id')->constrained()->onDelete('cascade');
            $table->foreignId('speaker_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('media_speaker');
        Schema::dropIfExists('link_speaker');
        Schema::dropIfExists('event_speaker');
        Schema::dropIfExists('speakers');
    }
}
