<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBioSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bio_subcategories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Tabla pivote para la relación muchos a muchos entre BioUser y BioSubcategory
        Schema::create('bio_subcategory_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bio_user_id')->constrained('bio_users')->onDelete('cascade');
            $table->foreignId('bio_subcategory_id')->constrained('bio_subcategories')->onDelete('cascade');
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
        Schema::dropIfExists('bio_subcategory_user');
        Schema::dropIfExists('bio_subcategories');
    }
}
