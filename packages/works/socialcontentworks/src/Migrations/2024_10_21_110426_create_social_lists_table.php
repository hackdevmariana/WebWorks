<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialListsTable extends Migration
{
    public function up()
    {
        Schema::create('social_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->json('contents');
            $table->string('platform');
            $table->enum('privacy', ['public', 'private']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('social_lists');
    }
}
