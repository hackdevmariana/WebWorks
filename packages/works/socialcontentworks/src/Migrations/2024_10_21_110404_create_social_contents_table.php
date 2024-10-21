<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialContentsTable extends Migration
{
    public function up()
    {
        Schema::create('social_contents', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('platform');
            $table->string('url');
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('social_contents');
    }
}
