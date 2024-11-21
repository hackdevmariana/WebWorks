<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaylistsTable extends Migration
{
    public function up()
    {
        Schema::create('playlists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('web_id')->constrained('webs')->onDelete('cascade');
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('playlist_video', function (Blueprint $table) {
            $table->id();
            $table->foreignId('playlist_id')->constrained('playlists')->onDelete('cascade');
            $table->foreignId('video_id')->constrained('videos')->onDelete('cascade');
            $table->integer('order')->default(0);
        });
    }

    public function down()
    {
        Schema::dropIfExists('playlist_video');
        Schema::dropIfExists('playlists');
    }
}
