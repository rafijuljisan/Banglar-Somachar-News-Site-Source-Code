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
        Schema::create('trivia_answers', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('trivia_question_id');
            $table->string('answer_title')->nullable();
            $table->tinyInteger('correct_answer')->nullable()->default(0);
            $table->string('answer_photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trivia_answers');
    }
};
