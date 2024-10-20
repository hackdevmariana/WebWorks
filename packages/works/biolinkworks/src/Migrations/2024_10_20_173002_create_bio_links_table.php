<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBioLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bio_links', function (Blueprint $table) {
            $table->id();
            $table->string('text');
            $table->string('url');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            
            // Foreign key hacia la tabla bio_users
            $table->foreignId('bio_user_id')->constrained('bio_users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bio_links');
    }
}
