<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorLinksTable extends Migration
{
    public function up()
    {
        Schema::create('author_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained()->onDelete('cascade');
            $table->foreignId('link_id')->constrained('quote_links')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('author_links');
    }
}
