<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteAuthorQuoteTagsTable extends Migration
{
    public function up()
    {
        Schema::create('quote_author_quote_tags', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained('quote_authors')->onDelete('cascade');
            $table->foreignId('tag_id')->constrained('quote_tags')->onDelete('cascade');
            $table->timestamps(); 
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_author_quote_tags');
    }
}

