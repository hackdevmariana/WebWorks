<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteCollaborationsTable extends Migration
{
    public function up()
    {
        Schema::create('quote_collaborations', function (Blueprint $table) {
            $table->id();
            $table->string('type_of_collaboration');
            $table->text('description')->nullable();
            $table->year('year')->nullable();
            $table->timestamps();
        });

        // Tabla de relación muchos a muchos con QuoteAuthor
        Schema::create('quote_author_quote_collaboration', function (Blueprint $table) {
            $table->foreignId('quote_author_id')->constrained('quote_authors')->onDelete('cascade');
            $table->foreignId('quote_collaboration_id')->constrained('quote_collaborations')->onDelete('cascade');
            $table->primary(['quote_author_id', 'quote_collaboration_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_author_quote_collaboration');
        Schema::dropIfExists('quote_collaborations');
    }
}
