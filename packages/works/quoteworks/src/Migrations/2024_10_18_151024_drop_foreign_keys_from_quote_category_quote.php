<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropForeignKeysFromQuoteCategoryQuote extends Migration
{
    public function up()
    {
        Schema::table('quote_category_quote', function (Blueprint $table) {
            // Eliminar las restricciones de clave foránea
            $table->dropForeign(['quote_author_id']);
            $table->dropForeign(['quote_link_id']);
            $table->dropForeign(['quote_school_id']);
            $table->dropForeign(['quote_book_id']);
        });
    }

    public function down()
    {
        Schema::table('quote_category_quote', function (Blueprint $table) {
            // Restaurar las restricciones de clave foránea
            $table->foreign('quote_author_id')->references('id')->on('quote_authors')->onDelete('cascade');
            $table->foreign('quote_link_id')->references('id')->on('quote_links')->onDelete('cascade');
            $table->foreign('quote_school_id')->references('id')->on('quote_schools')->onDelete('cascade');
            $table->foreign('quote_book_id')->references('id')->on('quote_books')->onDelete('cascade');
        });
    }
}
