<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')->constrained('webs')->onDelete('cascade');
            $table->string('username')->unique();
            $table->string('name');
            $table->string('surname');
            $table->json('links')->nullable();
            $table->string('photo')->nullable();
            $table->text('biography')->nullable();
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('authors');
    }
};
