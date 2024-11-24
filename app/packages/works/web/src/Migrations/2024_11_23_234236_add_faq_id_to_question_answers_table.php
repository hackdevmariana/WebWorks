<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('question_answers', function (Blueprint $table) {
            $table->foreignId('faq_id')->nullable()->constrained('faqs')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('question_answers', function (Blueprint $table) {
            $table->dropForeign(['faq_id']);
            $table->dropColumn('faq_id');
        });
    }
};
