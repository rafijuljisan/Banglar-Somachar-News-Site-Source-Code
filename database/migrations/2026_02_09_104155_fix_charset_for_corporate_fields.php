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
            $table->text('corp_address')->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable()->change();
            $table->string('corp_mobile')->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable()->change();
            $table->string('corp_email_address')->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('generalsettings', function (Blueprint $table) {
            //
        });
    }
};
