<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transmitter'); // ID del emisor
            $table->unsignedBigInteger('receiver'); // ID del receptor
            $table->string('thread'); // Identificador de la conversación o hilo
            $table->text('text'); // Texto del mensaje
            $table->timestamps();

            // Claves foráneas
            $table->foreign('transmitter')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('receiver')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
