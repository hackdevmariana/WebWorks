<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDictionaryTermRelationsTable extends Migration
{
    public function up()
    {
        Schema::create('dictionary_term_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('term_id')->constrained('dictionary_terms')->onDelete('cascade');
            $table->foreignId('related_term_id')->constrained('dictionary_terms')->onDelete('cascade');
            $table->enum('relation_type', ['synonym', 'antonym', 'hyponym', 'hypernym']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dictionary_term_relations');
    }
}
