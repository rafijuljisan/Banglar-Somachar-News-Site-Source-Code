<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('personality_answers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('personality_question_id');
            $table->string('answer_title')->nullable();
            $table->string('answer_photo')->nullable();
            $table->string('answer_option')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personality_answers');
    }
};
