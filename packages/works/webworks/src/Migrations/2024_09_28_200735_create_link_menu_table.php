<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // En el archivo de migración `create_link_menu_table.php`

    public function up()
    {
        Schema::create('link_menu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('link_id')->constrained()->onDelete('cascade');
            $table->foreignId('custom_menu_id')->constrained()->onDelete('cascade');
            $table->integer('order'); // Orden de los enlaces
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('link_menu');
    }
};
