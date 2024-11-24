<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomMenusTable extends Migration
{
    public function up()
    {
        Schema::create('custom_menus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('web_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('custom_menus');
    }
}
