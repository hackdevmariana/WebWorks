<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('publication_patterns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('featured_content_id')->constrained()->cascadeOnDelete();
            $table->text('pattern'); 
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publication_patterns');
    }
};
