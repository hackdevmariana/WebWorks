<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifySpeakerInActivitiesTable extends Migration
{
    public function up()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->string('speaker')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('activities', function (Blueprint $table) {
            $table->string('speaker')->nullable(false)->change();
        });
    }
}
