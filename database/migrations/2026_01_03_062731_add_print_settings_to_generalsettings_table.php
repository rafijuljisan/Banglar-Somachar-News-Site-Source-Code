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
            // Adding new columns for the Print Feature
            $table->string('print_logo', 191)->nullable()->after('logo'); // Logo specifically for the print page
            $table->text('print_header_text')->nullable()->after('print_logo'); // Custom text for the print header
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('generalsettings', function (Blueprint $table) {
            $table->dropColumn(['print_logo', 'print_header_text']);
        });
    }
};