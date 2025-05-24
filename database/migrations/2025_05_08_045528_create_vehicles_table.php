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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_name')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('vehicle_category')->nullable();
            $table->string('vehicle_size')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('registration_serial')->nullable();
            $table->string('registration_zone')->nullable();
            $table->string('registration_date')->nullable();
            $table->string('tax_date')->nullable();
            $table->string('road_permit_date')->nullable();
            $table->string('fitness_date')->nullable();
            $table->string('status')->nullable();
            $table->string('fuel_capacity')->nullable();
            $table->string('created_by')->nullable();
            $table->string('ref_id')->nullable();
            $table->string('insurance_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
