<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('quote_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');  // Nombre de la categoría
            $table->string('slug')->unique();  // Slug para la URL
            $table->text('description')->nullable();  // Descripción opcional
            $table->text('related_fields')->nullable();  // Campos relacionados opcionales
            $table->timestamps();
        });

        // Tabla intermedia para la relación many-to-many
        Schema::create('quote_category_quote', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quote_category_id')->constrained('quote_categories')->onDelete('cascade');
            $table->foreignId('quote_link_id')->constrained('quote_links')->onDelete('cascade');
            $table->foreignId('quote_school_id')->constrained('quote_schools')->onDelete('cascade');
            $table->foreignId('quote_quote_id')->constrained('quote_quotes')->onDelete('cascade');
            $table->foreignId('quote_author_id')->constrained('quote_authors')->onDelete('cascade');
            $table->foreignId('quote_book_id')->constrained('quote_books')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_category_quote');
        Schema::dropIfExists('quote_categories');
    }
}
