<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropSlugFromContentsTable extends Migration
{
    public function up()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->dropColumn('slug'); // Elimina la columna 'slug'
        });
    }

    public function down()
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->string('slug')->unique(); // Vuelve a agregar 'slug' si es necesario
        });
    }
}
