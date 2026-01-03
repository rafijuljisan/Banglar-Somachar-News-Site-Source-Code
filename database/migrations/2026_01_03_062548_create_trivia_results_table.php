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
        Schema::create('trivia_results', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('post_id');
            $table->string('result_title')->nullable();
            $table->string('result_photo')->nullable();
            $table->text('result_description')->nullable();
            $table->integer('min')->nullable();
            $table->integer('max')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trivia_results');
    }
};
