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
        Schema::table('generalsettings', function (Blueprint $table) {
            // Adding Corporate Office columns after their respective registered counterparts
            $table->text('corp_address')->nullable()->after('address');
            $table->string('corp_mobile')->nullable()->after('mobile');
            $table->string('corp_email_address')->nullable()->after('email_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('generalsettings', function (Blueprint $table) {
            // Drop the columns if we rollback
            $table->dropColumn(['corp_address', 'corp_mobile', 'corp_email_address']);
        });
    }
};