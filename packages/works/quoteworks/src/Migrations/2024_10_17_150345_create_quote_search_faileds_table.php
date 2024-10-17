<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteSearchFailedsTable extends Migration
{
    public function up()
    {
        Schema::create('quote_search_faileds', function (Blueprint $table) {
            $table->id();
            $table->string('url');  // URL que falló durante la búsqueda
            $table->string('origin')->nullable();  // Origen de la búsqueda (opcional, puede ser el sistema que hizo la solicitud)
            $table->integer('repetitions')->default(1);  // Número de veces que falló la misma búsqueda
            $table->text('error_message')->nullable();  // Mensaje de error asociado con el fallo (opcional)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_search_faileds');
    }
}
