<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotePublisherQuoteLinksTable extends Migration
{
    public function up()
    {
        Schema::create('quote_publisher_quote_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('publisher_id')->constrained('quote_publishers')->onDelete('cascade');
            $table->foreignId('link_id')->constrained('quote_links')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_publisher_quote_links');
    }
}
