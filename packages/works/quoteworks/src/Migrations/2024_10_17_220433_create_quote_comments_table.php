<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteCommentsTable extends Migration
{
    public function up()
    {
        Schema::create('quote_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('comment');

            // Relación polimórfica
            $table->nullableMorphs('commentable'); 

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_comments');
    }
}
