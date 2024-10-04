<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarouselsTable extends Migration
{
    public function up()
    {
        Schema::create('carousels', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')->constrained('websites');
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carousels');
    }
}
