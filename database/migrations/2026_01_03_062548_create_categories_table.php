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
        Schema::create('categories', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('language_id');
            $table->string('title', 191)->nullable();
            $table->string('slug', 100)->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('color', 20)->nullable();
            $table->integer('category_order')->nullable();
            $table->tinyInteger('show_at_homepage')->nullable()->default(1);
            $table->tinyInteger('show_on_menu')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
