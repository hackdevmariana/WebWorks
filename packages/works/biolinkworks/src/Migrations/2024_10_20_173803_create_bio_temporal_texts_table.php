<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBioTemporalTextsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bio_temporal_texts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('title');
            $table->text('text');
            $table->date('start'); // Campo de fecha para la fecha de inicio
            $table->date('end');   // Campo de fecha para la fecha de finalización
            
            // Foreign key hacia la tabla bio_users
            $table->foreignId('bio_user_id')->constrained('bio_users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bio_temporal_texts');
    }
}
