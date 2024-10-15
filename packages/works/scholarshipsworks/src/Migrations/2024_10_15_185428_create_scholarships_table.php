<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScholarshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scholarships', function (Blueprint $table) {
            $table->id();
            $table->string('event')->nullable();
            $table->enum('status', ['approved', 'pending'])->nullable();
            $table->unsignedBigInteger('candidate')->nullable(); // id_userscholarship
            $table->unsignedBigInteger('benefactor')->nullable(); // id_userscholarship
            $table->string('type_scholarship')->nullable();
            $table->timestamps();

            // For foreign keys
            $table->foreign('candidate')->references('id')->on('user_scholarships');
            $table->foreign('benefactor')->references('id')->on('user_scholarships');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('scholarships');
    }
}
