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
        Schema::table('generalsettings', function (Blueprint $table) {
            $table->string('social_banner')->nullable()->after('favicon');
        });
    }

    public function down()
    {
        Schema::table('generalsettings', function (Blueprint $table) {
            $table->dropColumn('social_banner');
        });
    }
};
