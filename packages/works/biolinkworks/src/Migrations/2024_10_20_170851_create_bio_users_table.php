<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBioUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bio_users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('name');
            $table->string('surname')->nullable();
            $table->text('biography')->nullable();
            $table->string('photo')->nullable(); // URL de la foto
            $table->string('alt')->nullable(); // Texto alternativo para la foto
            $table->string('background')->nullable(); // Imagen o color de fondo
            $table->string('calltoaction')->nullable(); // Llamada a la acción (CTA)
            $table->unsignedBigInteger('views')->default(0); // Número de vistas
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bio_users');
    }
}
