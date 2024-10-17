<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteLinksTable extends Migration
{
    public function up()
    {
        Schema::create('quote_links', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('url');
            $table->string('alt')->nullable(); // Texto alternativo para el enlace
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_links');
    }
}
