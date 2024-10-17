<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotePublishersTable extends Migration
{
    public function up()
    {
        Schema::create('quote_publishers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('email')->nullable(); // Campo opcional
            $table->string('address')->nullable(); // Campo opcional
            $table->string('phone')->nullable(); // Campo opcional
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_publishers');
    }
}
