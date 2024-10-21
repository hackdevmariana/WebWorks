<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialAccountsTable extends Migration
{
    public function up()
    {
        Schema::create('social_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('real_name');
            $table->string('username')->unique();
            $table->string('platform');
            $table->string('link');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('social_accounts');
    }
}
