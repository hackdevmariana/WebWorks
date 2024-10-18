<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorSchoolsTable extends Migration
{
    public function up()
    {
        Schema::create('author_schools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('school_id')->constrained('quote_schools')->onDelete('cascade');
            $table->foreignId('author_id')->constrained('quote_authors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('author_schools');
    }
}
