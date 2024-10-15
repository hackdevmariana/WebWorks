<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDictionaryTermsTable extends Migration
{
    public function up()
    {
        Schema::create('dictionary_terms', function (Blueprint $table) {
            $table->id();
            $table->string('term');
            $table->string('slug')->unique();
            $table->text('abstract');
            $table->text('definition');
            $table->unsignedInteger('views')->default(0);
            $table->text('usage')->nullable();
            $table->string('author');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });

        // Relaciones autoasociativas para hipónimos, hiperónimos, sinónimos y antónimos
        Schema::create('dictionary_term_relations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('term_id')->constrained('dictionary_terms')->onDelete('cascade');
            $table->foreignId('related_term_id')->constrained('dictionary_terms')->onDelete('cascade');
            $table->enum('relation_type', ['hyponym', 'hypernym', 'synonym', 'antonym']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dictionary_term_relations');
        Schema::dropIfExists('dictionary_terms');
    }
}
