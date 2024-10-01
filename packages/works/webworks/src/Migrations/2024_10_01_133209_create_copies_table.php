<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCopiesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('copies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')->constrained()->onDelete('cascade'); 
            $table->string('name');    // declarative tag
            $table->enum('copy', ['copyleft', 'copyright']); 
            $table->string('license')->nullable(); // (GPL, BSD, etc.)
            $table->string('author')->nullable();
            $table->string('url')->nullable(); // Enlace del author link
            $table->text('text')->nullable(); // Main text of the copy
            $table->text('subtext')->nullable(); // Optional secondary text
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('copies');
    }
}
