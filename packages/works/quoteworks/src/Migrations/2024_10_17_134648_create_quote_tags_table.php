<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteTagsTable extends Migration
{
    public function up()
    {
        Schema::create('quote_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable(); // Descripción opcional para el tag
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_tags');
    }
}
