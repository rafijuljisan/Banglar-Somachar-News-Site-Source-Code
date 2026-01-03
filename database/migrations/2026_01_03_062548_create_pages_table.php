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
        Schema::create('pages', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('language_id');
            $table->string('title', 100)->nullable();
            $table->string('slug', 100)->nullable();
            $table->text('description')->nullable();
            $table->string('placement', 100)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('wbsite_right_column')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
