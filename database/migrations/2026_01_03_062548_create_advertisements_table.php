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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('add_placement', 191)->nullable();
            $table->string('banner_type', 191)->nullable();
            $table->enum('addSize', ['size_728', 'size_468', 'size_234'])->nullable();
            $table->string('photo', 191)->nullable();
            $table->text('banner_code')->nullable();
            $table->string('link')->nullable();
            $table->tinyInteger('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
