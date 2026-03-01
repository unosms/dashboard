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
        Schema::create('dashboard_apps', function (Blueprint $table) {
            $table->id();
            $table->string('app_key', 100)->unique();
            $table->string('name', 150);
            $table->string('theme', 100)->nullable();
            $table->string('url', 2048)->nullable();
            $table->string('username', 255)->nullable();
            $table->string('password', 255)->nullable();
            $table->unsignedInteger('position')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dashboard_apps');
    }
};

