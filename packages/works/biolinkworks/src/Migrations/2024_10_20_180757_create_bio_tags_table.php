<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBioTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bio_tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Tabla pivote para la relación muchos a muchos entre BioUser y BioTag
        Schema::create('bio_tag_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bio_user_id')->constrained('bio_users')->onDelete('cascade');
            $table->foreignId('bio_tag_id')->constrained('bio_tags')->onDelete('cascade');
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
        Schema::dropIfExists('bio_tag_user');
        Schema::dropIfExists('bio_tags');
    }
}
