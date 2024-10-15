<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeScholarshipsTable extends Migration
{
    public function up()
    {
        Schema::create('type_scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('event')->nullable();
            $table->enum('name', ['registration', 'transportation', 'accommodation', 'books'])->nullable();
            $table->decimal('price', 10, 2)->nullable(); 
            $table->string('place_of_origin')->nullable();
            $table->json('books_to_buy')->nullable(); 
            $table->unsignedBigInteger('id_user_candidate')->nullable();
            $table->unsignedBigInteger('id_user_benefactor')->nullable(); 
            $table->timestamps();

            $table->foreign('id_user_candidate')->references('id')->on('user_scholarships')->onDelete('cascade');
            $table->foreign('id_user_benefactor')->references('id')->on('user_scholarships')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('type_scholarships');
    }
}
