<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('webs', function (Blueprint $table) {
            $table->id();
            $table->string('url')->unique();
            $table->string('home')->nullable();
            $table->string('title')->index();
            $table->text('description')->nullable();
            $table->string('keywords')->nullable();
            $table->string('favicon')->nullable();
            $table->string('name')->unique();   
            $table->string('slug')->unique();    
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('webs');
    }
};
