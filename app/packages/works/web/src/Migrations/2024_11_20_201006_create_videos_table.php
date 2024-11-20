<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('web_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('subtitle')->nullable();
            $table->text('description')->nullable();
            $table->string('author')->nullable();
            $table->string('url')->nullable();
            $table->string('youtube_id')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
