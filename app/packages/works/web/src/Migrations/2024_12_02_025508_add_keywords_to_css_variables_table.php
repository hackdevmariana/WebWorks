<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('css_variables', function (Blueprint $table) {
            $table->string('keywords')->nullable();  // o usa otro tipo de datos si prefieres
        });
    }

    public function down()
    {
        Schema::table('css_variables', function (Blueprint $table) {
            $table->dropColumn('keywords');
        });
    }

};
