<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolLinksTable extends Migration
{
    public function up()
    {
        Schema::create('school_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained('quote_schools')->onDelete('cascade');
            $table->foreignId('link_id')->constrained('quote_links')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('school_links');
    }
}
