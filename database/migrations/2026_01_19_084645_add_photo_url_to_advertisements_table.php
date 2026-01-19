<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('advertisements', function (Blueprint $table) {
            // Add a column for external image links
            $table->string('photo_url')->nullable()->after('photo');

            // Make sure these are nullable if they aren't already
            $table->string('photo')->nullable()->change();
            $table->text('banner_code')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('advertisements', function (Blueprint $table) {
            $table->dropColumn('photo_url');
        });
    }
};
