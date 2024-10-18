<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteAuthorQuoteBookTable extends Migration
{
    public function up()
    {
        Schema::create('quote_author_quote_books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_author_id')->constrained()->onDelete('cascade');
            $table->foreignId('quote_book_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_author_quote_books');
    }
}
