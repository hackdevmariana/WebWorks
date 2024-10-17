<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteAuthorsTable extends Migration
{
    public function up()
    {
        Schema::create('quote_authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname')->nullable();
            $table->string('slug')->unique();
            $table->json('media')->nullable();
            $table->json('areas_of_study')->nullable();
            $table->json('school')->nullable();
            $table->json('urls')->nullable();
            $table->json('birth')->nullable();
            $table->json('death')->nullable();
            $table->text('biography')->nullable();
            $table->json('published_books')->nullable();
            $table->json('links_to_articles')->nullable();
            $table->string('author_slug')->nullable();
            $table->integer('views')->default(0);
            $table->timestamps();
        });

        // Hemos eliminado las tablas pivote de QuoteBooks y QuoteMedia.
    }

    public function down()
    {
        // Simplemente se elimina la tabla de 'quote_authors' en el método down.
        Schema::dropIfExists('quote_authors');
    }
}
