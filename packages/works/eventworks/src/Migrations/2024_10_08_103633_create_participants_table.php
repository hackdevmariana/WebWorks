<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->text('interests')->nullable();
            $table->foreignId('country_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });

        // Crear tablas pivote
        Schema::create('participant_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_tag_id')->constrained()->onDelete('cascade');
        });

        Schema::create('participant_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_category_id')->constrained()->onDelete('cascade');
        });



        Schema::create('city_participant', function (Blueprint $table) {
            $table->id();
            $table->foreignId('participant_id')->constrained()->onDelete('cascade');
            $table->foreignId('city_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('participants');
        Schema::dropIfExists('participant_tag');
        Schema::dropIfExists('participant_category');
        Schema::dropIfExists('city_participant');
    }
}
