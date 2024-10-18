<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookPublishersTable extends Migration
{
    public function up()
    {
        Schema::create('book_publishers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publisher_id')->constrained('quote_publishers')->onDelete('cascade');
            $table->foreignId('book_id')->constrained('quote_books')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('book_publishers');
    }
}
