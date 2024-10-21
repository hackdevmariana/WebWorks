<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSocialCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create social_categories table
        Schema::create('social_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Pivot table for SocialAccount and SocialCategory
        Schema::create('social_account_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained('social_accounts')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('social_categories')->onDelete('cascade');
            $table->timestamps();
        });

        // Pivot table for SocialContent and SocialCategory
        Schema::create('social_content_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_id')->constrained('social_contents')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('social_categories')->onDelete('cascade');
            $table->timestamps();
        });

        // Pivot table for SocialList and SocialCategory
        Schema::create('social_list_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('list_id')->constrained('social_lists')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('social_categories')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('social_list_category');
        Schema::dropIfExists('social_content_category');
        Schema::dropIfExists('social_account_category');
        Schema::dropIfExists('social_categories');
    }
}
