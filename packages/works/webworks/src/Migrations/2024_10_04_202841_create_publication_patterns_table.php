<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationPatternsTable extends Migration
{
    public function up()
    {
        Schema::create('publication_patterns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')->constrained('websites');
            $table->string('pattern_name');
            $table->integer('day_of_the_week')->nullable(); // 1 for Monday, 7 for Sunday
            $table->integer('day_of_the_month')->nullable(); // 1 to 31
            $table->date('specific_day')->nullable();
            $table->enum('type', ['weekly', 'monthly', 'specific']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('publication_patterns');
    }
}
