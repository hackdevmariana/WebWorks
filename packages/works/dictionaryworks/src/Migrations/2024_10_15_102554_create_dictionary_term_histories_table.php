<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDictionaryTermHistoriesTable extends Migration
{
    public function up()
    {
        Schema::create('dictionary_term_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('term_id')->constrained('dictionary_terms')->onDelete('cascade');
            $table->text('change_description'); // Descripción del cambio
            $table->foreignId('user_id')->constrained('users'); // Usuario que realizó el cambio
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dictionary_term_histories');
    }
}
