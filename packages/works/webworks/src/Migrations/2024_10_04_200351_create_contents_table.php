<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('website_id')->constrained('websites');
            $table->string('name');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->text('text')->nullable();
            $table->string('image')->nullable();
            $table->string('url')->nullable();
            $table->string('alt')->nullable();
            $table->string('content_type');
            $table->boolean('is_default')->default(false);
            $table->boolean('draft')->default(false);
            $table->foreignId('author_id')->nullable()->constrained('authors');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
