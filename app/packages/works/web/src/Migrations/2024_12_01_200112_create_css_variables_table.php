<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCssVariablesTable extends Migration
{
    public function up()
    {
        Schema::create('css_variables', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('value')->nullable();
            $table->foreignId('web_id')->constrained('webs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('css_variables');
    }
}
