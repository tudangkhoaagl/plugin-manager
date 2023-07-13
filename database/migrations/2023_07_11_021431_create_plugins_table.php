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
        Schema::create('plugins', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('machine_name')->index();
            $table->string('description')->nullable();
            $table->string('provider');
            $table->enum('status', [PLUGIN_STATUS_ENABLE, PLUGIN_STATUS_DISABLE])->default(PLUGIN_STATUS_DISABLE);
            $table->unsignedBigInteger('priovity');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plugins');
    }
};
