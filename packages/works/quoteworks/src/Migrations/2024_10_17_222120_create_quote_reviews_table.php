<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('quote_reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Definir user_id sin la restricción de clave foránea
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('review');

            // Relación polimórfica
            $table->nullableMorphs('reviewable');  // Esto crea los campos 'reviewable_id' y 'reviewable_type'

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('quote_reviews');
    }
}
