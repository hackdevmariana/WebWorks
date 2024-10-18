<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteAuthorQuoteMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_author_quote_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_author_id')->constrained('quote_authors')->onDelete('cascade');
            $table->foreignId('quote_media_id')->constrained('quote_media')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quote_author_quote_media');
    }
}
