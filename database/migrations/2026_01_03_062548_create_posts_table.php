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
        Schema::create('posts', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('language_id')->nullable();
            $table->string('title', 500)->nullable()->index('title');
            $table->string('slug', 500)->nullable()->fulltext('slug');
            $table->string('post_type', 100)->nullable();
            $table->string('meta_tag')->nullable();
            $table->tinyInteger('show_right_column')->default(0);
            $table->tinyInteger('is_feature')->default(0);
            $table->tinyInteger('is_slider')->default(0);
            $table->tinyInteger('slider_left')->default(0);
            $table->tinyInteger('slider_right')->default(0);
            $table->tinyInteger('is_trending')->default(0);
            $table->boolean('is_videoGallery')->nullable()->default(false);
            $table->text('tags')->nullable();
            $table->text('description')->nullable()->fulltext('description');
            $table->longText('image_big')->nullable();
            $table->longText('rss_image')->nullable();
            $table->longText('image_small')->nullable();
            $table->longText('video')->nullable();
            $table->longText('audio')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('subcategories_id')->nullable();
            $table->tinyInteger('schedule_post')->default(0);
            $table->timestamp('schedule_post_date')->nullable();
            $table->tinyInteger('is_pending')->default(0);
            $table->integer('admin_id');
            $table->enum('status', ['true', 'false', 'draft'])->nullable()->default('false');
            $table->tinyInteger('is_draft')->default(0);
            $table->string('rss_link', 191)->nullable();
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->longText('short_description')->nullable();
            $table->longText('video_embed')->nullable();
            $table->longText('image_caption')->nullable();
            $table->longText('video_link')->nullable();
            $table->tinyInteger('is_video')->default(0);

            $table->fullText(['description'], 'description_2');
            $table->fullText(['slug'], 'slug_2');
            $table->index(['title'], 'title_2');
            $table->index(['title'], 'title_3');
            $table->fullText(['title'], 'title_4');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
