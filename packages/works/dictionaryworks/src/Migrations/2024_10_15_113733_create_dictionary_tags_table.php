<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDictionaryTagsTable extends Migration
{
    public function up()
    {
        Schema::create('dictionary_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Tabla pivote para la relación muchos a muchos
        Schema::create('dictionary_tag_term', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tag_id')->constrained('dictionary_tags')->onDelete('cascade');
            $table->foreignId('term_id')->constrained('dictionary_terms')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dictionary_tag_term');
        Schema::dropIfExists('dictionary_tags');
    }
}
