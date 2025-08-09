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
        Schema::create('driver_ledgers', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('trip_id')->nullable();
            $table->string('load_point')->nullable();
            $table->string('unload_point')->nullable();
            $table->string('driver_commission')->nullable();
            $table->string('driver_adv')->nullable();
            $table->string('parking_cost')->nullable();
            $table->string('night_guard')->nullable();
            $table->string('toll_cost')->nullable();
            $table->string('feri_cost')->nullable();
            $table->string('police_cost')->nullable();
            $table->string('chada')->nullable();
            $table->string('labor')->nullable();
            $table->string('total_exp')->nullable();
            $table->string('due_amount')->nullable();
            $table->string('opening_balance')->nullable();
            $table->string('balance')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_ledgers');
    }
};
