<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthorsTable extends Migration
{
    public function up()
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')->constrained('websites');
            $table->string('username');
            $table->string('name');
            $table->string('surname');
            $table->text('links')->nullable();
            $table->string('photo')->nullable();
            $table->text('biography')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('authors');
    }
}
