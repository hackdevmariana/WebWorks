<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDictionaryTermSuggestionsTable extends Migration
{
    public function up()
    {
        Schema::create('dictionary_term_suggestions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('term_id')->constrained('dictionary_terms')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users'); // Usuario que hizo la sugerencia
            $table->text('suggestion'); // Sugerencia del usuario
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dictionary_term_suggestions');
    }
}
