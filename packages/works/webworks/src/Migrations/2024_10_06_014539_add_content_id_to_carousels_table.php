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
        Schema::table('carousels', function (Blueprint $table) {
            // Agregar la columna content_id con su respectiva clave foránea
            $table->foreignId('content_id')->constrained('contents')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carousels', function (Blueprint $table) {
            // Eliminar la columna content_id y la clave foránea
            $table->dropForeign(['content_id']);
            $table->dropColumn('content_id');
        });
    }
};
