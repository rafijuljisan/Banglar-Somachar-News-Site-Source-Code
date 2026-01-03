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
        Schema::create('widget_settings', function (Blueprint $table) {
            $table->integer('id', true);
            $table->tinyInteger('feature_inhome')->default(0);
            $table->tinyInteger('category_inhome')->default(0);
            $table->tinyInteger('follow_inhome')->default(0);
            $table->tinyInteger('tag_inhome')->default(0);
            $table->tinyInteger('poll_inhome')->default(0);
            $table->tinyInteger('calendar_inhome')->default(0);
            $table->tinyInteger('newsletter_inhome')->default(0);
            $table->tinyInteger('category_incategory')->default(0);
            $table->tinyInteger('newsletter_incategory')->default(0);
            $table->tinyInteger('calendar_incategory')->default(0);
            $table->tinyInteger('category_indetails')->default(0);
            $table->tinyInteger('newsletter_indetails')->default(0);
            $table->tinyInteger('calendar_indetails')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('widget_settings');
    }
};
