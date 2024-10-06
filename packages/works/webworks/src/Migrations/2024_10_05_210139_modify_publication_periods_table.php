<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyPublicationPeriodsTable extends Migration
{
    public function up()
    {
        Schema::table('publication_periods', function (Blueprint $table) {
            $table->unsignedBigInteger('content_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('publication_periods', function (Blueprint $table) {
            $table->unsignedBigInteger('content_id')->nullable(false)->change();
        });
    }
}
