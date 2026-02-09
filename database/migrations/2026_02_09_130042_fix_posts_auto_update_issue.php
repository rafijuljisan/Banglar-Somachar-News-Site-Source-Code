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
        // This sets the column to be a standard Timestamp WITHOUT "On Update" behavior
        DB::statement("ALTER TABLE `posts` CHANGE `created_at` `created_at` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP");
    }

    public function down()
    {
        // Optional: Revert it back if needed (usually not necessary for this fix)
    }
};
