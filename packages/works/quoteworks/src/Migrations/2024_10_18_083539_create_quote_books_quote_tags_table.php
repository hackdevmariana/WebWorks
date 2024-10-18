<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteBooksQuoteTagsTable extends Migration
{
    public function up()
    {
        Schema::create('quote_books_quote_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('quote_books')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('quote_tags')->onDelete('cascade');
            $table->timestamps(); // Añadimos timestamps para rastrear cuándo se crean estas relaciones
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_books_quote_tags');
    }
}
