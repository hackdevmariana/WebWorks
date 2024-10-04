<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublicationPeriodsTable extends Migration
{
    public function up()
    {
        Schema::create('publication_periods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')->constrained('websites');
            $table->foreignId('content_id')->constrained('contents');
            $table->date('start_day')->nullable();
            $table->date('end_day')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('publication_periods');
    }
}
