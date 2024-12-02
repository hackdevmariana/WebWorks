<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyKeyColumnInCssVariablesTable extends Migration
{
    public function up()
    {
        Schema::table('css_variables', function (Blueprint $table) {
            $table->string('key')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('css_variables', function (Blueprint $table) {
            $table->string('key')->nullable(false)->change();
        });
    }
}
