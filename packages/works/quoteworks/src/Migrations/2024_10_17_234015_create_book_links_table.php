<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookLinksTable extends Migration
{
    public function up()
    {
        Schema::create('book_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('quote_books')->onDelete('cascade');
            $table->foreignId('link_id')->constrained('quote_links')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('book_links');
    }
}