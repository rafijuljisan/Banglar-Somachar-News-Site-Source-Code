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
        Schema::create('admins', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('name', 191);
            $table->string('email', 100);
            $table->string('phone', 100)->nullable();
            $table->integer('role_id')->default(1);
            $table->string('photo', 191)->nullable();
            $table->string('password', 191);
            $table->string('token', 191)->nullable();
            $table->tinyInteger('verify')->default(0);
            $table->tinyInteger('status')->default(1);
            $table->string('remember_token', 191)->nullable();
            $table->timestamp('created_at')->useCurrentOnUpdate()->useCurrent();
            $table->timestamp('updated_at')->nullable();
            $table->longText('designation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
