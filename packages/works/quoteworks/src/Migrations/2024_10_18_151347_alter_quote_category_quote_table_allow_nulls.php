<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterQuoteCategoryQuoteTableAllowNulls extends Migration
{
    public function up()
    {
        Schema::table('quote_category_quote', function (Blueprint $table) {
            // Permitir valores nulos en las columnas deseadas
            $table->bigInteger('quote_link_id')->nullable()->change();
            $table->bigInteger('quote_school_id')->nullable()->change();
            $table->bigInteger('quote_author_id')->nullable()->change();
            $table->bigInteger('quote_book_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('quote_category_quote', function (Blueprint $table) {
            // Restaurar a no nulos
            $table->bigInteger('quote_link_id')->nullable(false)->change();
            $table->bigInteger('quote_school_id')->nullable(false)->change();
            $table->bigInteger('quote_author_id')->nullable(false)->change();
            $table->bigInteger('quote_book_id')->nullable(false)->change();
        });
    }
}
