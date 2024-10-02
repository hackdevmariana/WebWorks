<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevelopedsTable extends Migration
{
    public function up()
    {
        Schema::create('developeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')->constrained()->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('author')->nullable();
            $table->string('url')->nullable();
            $table->string('technology')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('developed');
    }
}
