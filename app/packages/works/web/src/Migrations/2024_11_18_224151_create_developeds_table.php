<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('developeds', function (Blueprint $table) {
            $table->id();
            $table->foreignId('web_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('text')->nullable();
            $table->string('author')->nullable();
            $table->string('url')->nullable();
            $table->string('technology')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('developeds');
    }
};
