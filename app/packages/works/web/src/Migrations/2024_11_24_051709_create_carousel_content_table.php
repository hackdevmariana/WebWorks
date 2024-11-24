<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarouselContentTable extends Migration
{
    public function up(): void
    {
        Schema::create('carousel_content', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carousel_id');
            $table->unsignedBigInteger('content_id');
            $table->timestamps();

            $table->foreign('carousel_id')->references('id')->on('carousels')->onDelete('cascade');
            $table->foreign('content_id')->references('id')->on('contents')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carousel_content');
    }
}

