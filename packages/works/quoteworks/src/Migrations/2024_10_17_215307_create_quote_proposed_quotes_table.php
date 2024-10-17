<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteProposedQuotesTable extends Migration
{
    public function up()
    {
        Schema::create('quote_proposed_quotes', function (Blueprint $table) {
            $table->id();
            $table->text('quote');
            $table->foreignId('author')->nullable()->constrained('quote_authors')->onDelete('cascade');
            $table->foreignId('book')->nullable()->constrained('quote_books')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_proposed_quotes');
    }
}
