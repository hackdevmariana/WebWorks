<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteBooksTable extends Migration
{
    public function up()
    {
        Schema::create('quote_books', function (Blueprint $table) {
            $table->id();
            $table->string('title_in_spanish');
            $table->string('slug')->unique();
            $table->string('original_title')->nullable();
            $table->string('original_language')->nullable();
            $table->string('author')->nullable();
            $table->string('translator')->nullable();
            $table->string('publisher')->nullable();
            $table->integer('number_of_pages')->nullable();
            $table->date('publication_date')->nullable();
            $table->decimal('weight', 8, 2)->nullable(); // Asumiendo que el peso es un decimal
            $table->string('dimensions')->nullable();
            $table->json('links')->nullable();
            $table->json('media')->nullable();
            $table->string('isbn')->nullable();
            $table->string('category')->nullable();
            $table->text('synopsis')->nullable();
            $table->text('comments')->nullable();
            $table->integer('views')->default(0);
            $table->timestamps();
        });

        // Aquí no crearemos las tablas pivote de momento.
    }

    public function down()
    {
        Schema::dropIfExists('quote_books');
    }
}
