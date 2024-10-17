<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteCollectionsTable extends Migration
{
    public function up()
    {
        Schema::create('quote_collections', function (Blueprint $table) {
            $table->id();
            $table->string('collection');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Tabla pivote para la relación con QuoteBook
        Schema::create('quote_collection_quote_book', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')->constrained('quote_collections')->onDelete('cascade');
            $table->foreignId('book_id')->constrained('quote_books')->onDelete('cascade');
            $table->timestamps();
        });

        // Tabla pivote para la relación con QuotePublisher
        Schema::create('quote_collection_quote_publisher', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')->constrained('quote_collections')->onDelete('cascade');
            $table->foreignId('publisher_id')->constrained('quote_publishers')->onDelete('cascade');
            $table->timestamps();
        });

        // Tabla pivote para la relación con QuoteAuthor
        Schema::create('quote_collection_quote_author', function (Blueprint $table) {
            $table->id();
            $table->foreignId('collection_id')->constrained('quote_collections')->onDelete('cascade');
            $table->foreignId('author_id')->constrained('quote_authors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_collection_quote_author');
        Schema::dropIfExists('quote_collection_quote_publisher');
        Schema::dropIfExists('quote_collection_quote_book');
        Schema::dropIfExists('quote_collections');
    }
}
