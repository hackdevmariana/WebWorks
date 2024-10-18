<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToQuoteQuotesTable extends Migration
{
    public function up()
    {
        Schema::table('quote_quotes', function (Blueprint $table) {
            $table->string('slug')->unique()->nullable();
        });
    }

    public function down()
    {
        Schema::table('quote_quotes', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}
