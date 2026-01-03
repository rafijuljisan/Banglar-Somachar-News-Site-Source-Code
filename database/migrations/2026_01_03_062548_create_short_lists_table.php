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
        Schema::create('short_lists', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('post_id');
            $table->string('item_title')->nullable();
            $table->string('item_photo')->nullable();
            $table->text('item_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('short_lists');
    }
};
