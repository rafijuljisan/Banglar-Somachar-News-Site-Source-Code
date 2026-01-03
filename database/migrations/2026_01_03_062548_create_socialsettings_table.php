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
        Schema::create('socialsettings', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('fclient_id', 100)->nullable();
            $table->string('fclient_secret', 100)->nullable();
            $table->string('fredirect', 100)->nullable();
            $table->string('gclient_id', 100)->nullable();
            $table->string('gclient_secret', 100)->nullable();
            $table->string('gredirect', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('socialsettings');
    }
};
