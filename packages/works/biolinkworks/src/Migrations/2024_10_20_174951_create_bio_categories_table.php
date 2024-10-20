<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBioCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bio_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Tabla pivote para la relación muchos a muchos entre BioUser y BioCategory
        Schema::create('bio_category_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bio_user_id')->constrained('bio_users')->onDelete('cascade');
            $table->foreignId('bio_category_id')->constrained('bio_categories')->onDelete('cascade');
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
        Schema::dropIfExists('bio_category_user');
        Schema::dropIfExists('bio_categories');
    }
}
