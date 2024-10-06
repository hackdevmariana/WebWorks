<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarouselContentTable extends Migration
{
    public function up()
    {
        Schema::create('carousel_content', function (Blueprint $table) {
            $table->id();
            $table->foreignId('carousel_id')->constrained('carousels')->onDelete('cascade'); // Referencia a la tabla 'carousels'
            $table->foreignId('content_id')->constrained('contents')->onDelete('cascade'); // Referencia a la tabla 'contents'
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carousel_content');
    }
}
