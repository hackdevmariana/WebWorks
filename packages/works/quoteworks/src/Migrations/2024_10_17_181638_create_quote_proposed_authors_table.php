<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteProposedAuthorsTable extends Migration
{
    public function up()
    {
        Schema::create('quote_proposed_authors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname');
            $table->string('slug')->unique();
            $table->text('media')->nullable();
            $table->text('areas_of_study')->nullable();
            $table->string('school')->nullable();
            $table->text('collaborations')->nullable();
            $table->text('urls')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->date('date_of_death')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('place_of_death')->nullable();
            $table->text('biography')->nullable();
            $table->text('published_books')->nullable();
            $table->text('links_to_articles')->nullable();
            $table->string('author_slug')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_proposed_authors');
    }
}
