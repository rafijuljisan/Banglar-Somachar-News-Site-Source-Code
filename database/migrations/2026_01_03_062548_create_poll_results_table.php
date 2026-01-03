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
        Schema::create('poll_results', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('poll_question_id');
            $table->integer('poll_answer_id');
            $table->string('ip_address', 191)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poll_results');
    }
};
