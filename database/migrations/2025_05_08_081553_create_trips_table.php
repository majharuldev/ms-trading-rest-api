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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('customer')->nullable();
            $table->string('date')->nullable();
            $table->string('load_point')->nullable();
            $table->string('unload_point')->nullable();
            $table->string('transport_type')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('total_rent')->nullable();
            $table->string('quantity')->nullable();
            $table->string('dealer_name')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('fuel_cost')->nullable();
            $table->string('do_si')->nullable();
            $table->string('driver_mobile')->nullable();
            $table->string('challan')->nullable();
            $table->string('sti')->nullable();
            $table->string('model_no')->nullable();
            $table->string('co_u')->nullable();
            $table->string('masking')->nullable();
            $table->string('unload_charge')->nullable();
            $table->string('extra_fare')->nullable();
            $table->string('vehicle_rent')->nullable();
            $table->string('goods')->nullable();
            $table->string('distribution_name')->nullable();
            $table->string('remarks')->nullable();
            $table->string('no_of_trip')->nullable();
            $table->string('vehicle_mode')->nullable();
            $table->string('per_truck_rent')->nullable();
            $table->string('vat')->nullable();
            $table->string('total_rent_cost')->nullable();
            $table->string('driver_commission')->nullable();
            $table->string('road_cost')->nullable();
            $table->string('food_cost')->nullable();
            $table->string('total_exp')->nullable();
            $table->string('trip_rent')->nullable();
            $table->string('advance')->nullable();
            $table->string('due_amount')->nullable();
            $table->string('ref_id')->nullable();
            $table->string('body_fare')->nullable();
            $table->string('parking_cost')->nullable();
            $table->string('night_guard')->nullable();
            $table->string('toll_cost')->nullable();
            $table->string('feri_cost')->nullable();
            $table->string('police_cost')->nullable();
            $table->string('driver_adv')->nullable();
            $table->string('chada')->nullable();
            $table->string('labor')->nullable();
             $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
