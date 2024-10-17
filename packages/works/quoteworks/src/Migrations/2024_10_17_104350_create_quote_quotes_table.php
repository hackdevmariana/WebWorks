<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteQuotesTable extends Migration
{
    public function up()
    {
        Schema::create('quote_quotes', function (Blueprint $table) {
            $table->id();
            $table->text('quote');
            $table->integer('views')->default(0);
            $table->unsignedBigInteger('id_book')->nullable(); // Campo opcional
            $table->unsignedBigInteger('id_link')->nullable(); // Campo opcional
            $table->foreignId('author_id')->nullable()->constrained('quote_authors')->onDelete('set null'); // Relación opcional

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_quotes');
    }
}
