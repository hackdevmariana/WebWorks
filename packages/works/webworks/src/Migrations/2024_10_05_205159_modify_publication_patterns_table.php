<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPublicationPatternsTable extends Migration
{
    public function up()
    {
        Schema::table('publication_patterns', function (Blueprint $table) {
            // Cambiar las columnas a tipo JSON
            $table->json('day_of_the_week')->nullable()->change();
            $table->json('day_of_the_month')->nullable()->change();
            $table->json('specific_day')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('publication_patterns', function (Blueprint $table) {
            // Revertir las columnas a su estado original si es necesario
            $table->integer('day_of_the_week')->nullable()->change();
            $table->integer('day_of_the_month')->nullable()->change();
            $table->date('specific_day')->nullable()->change();
        });
    }
}
