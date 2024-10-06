<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContentIdToHeroesTable extends Migration
{
    public function up()
    {
        Schema::table('heroes', function (Blueprint $table) {
            $table->unsignedBigInteger('content_id')->nullable(); // Añadimos la columna
        });
    }

    public function down()
    {
        Schema::table('heroes', function (Blueprint $table) {
            $table->dropColumn('content_id'); // Revertimos el cambio
        });
    }
}
