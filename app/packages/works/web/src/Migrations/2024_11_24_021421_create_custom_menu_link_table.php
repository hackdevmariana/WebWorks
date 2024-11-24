<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomMenuLinkTable extends Migration
{
    public function up()
    {
        Schema::create('custom_menu_link', function (Blueprint $table) {
            $table->id();
            $table->foreignId('custom_menu_id')->constrained()->onDelete('cascade');
            $table->foreignId('link_id')->constrained()->onDelete('cascade');
            $table->integer('order')->nullable();  // Si necesitas un campo 'order'
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('custom_menu_link');
    }
}
