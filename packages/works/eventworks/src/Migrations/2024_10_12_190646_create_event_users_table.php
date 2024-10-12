<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventUsersTable extends Migration
{
    public function up()
    {
        Schema::create('event_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role'); // Ej. 'participant', 'organizer', etc.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_users');
    }
}
