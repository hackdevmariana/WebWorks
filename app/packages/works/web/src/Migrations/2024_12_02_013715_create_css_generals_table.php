<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('css_generals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('web_id');
            $table->string('key');
            $table->string('value');
            $table->timestamps();
        
            $table->foreign('web_id')->references('id')->on('webs')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('css_generals');
    }
};
