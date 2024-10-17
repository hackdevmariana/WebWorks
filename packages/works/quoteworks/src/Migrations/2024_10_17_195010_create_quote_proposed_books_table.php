<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteProposedBooksTable extends Migration
{
    public function up()
    {
        Schema::create('quote_proposed_books', function (Blueprint $table) {
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
            $table->decimal('weight', 8, 2)->nullable();  // Peso en kg
            $table->string('dimensions')->nullable(); // Ejemplo: "15x23x2 cm"
            $table->text('links')->nullable();
            $table->text('media')->nullable();
            $table->string('isbn')->nullable()->unique();
            $table->string('category')->nullable();
            $table->text('synopsis')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_proposed_books');
    }
}
