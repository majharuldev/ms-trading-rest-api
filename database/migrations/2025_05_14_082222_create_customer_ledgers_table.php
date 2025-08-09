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
    Schema::create('customer_ledgers', function (Blueprint $table) {
        $table->id();
        $table->string('customer_name')->nullable();
        $table->string('bill_date')->nullable();
        $table->string('woring_date')->nullable();
        $table->string('vehicle_no')->nullable();
        $table->string('qty')->nullable();
        $table->string('load_point')->nullable();
        $table->string('unload_point')->nullable();
        $table->string('bill_amount')->nullable();
        $table->string('vat')->nullable();
        $table->string('total_amount')->nullable();
        $table->string('due_amount')->nullable();
        $table->string('status')->nullable();
        $table->string('chalan')->nullable();
        $table->string('fuel_cost')->nullable();
        $table->string('body_cost')->nullable();
        $table->string('created_by')->nullable();
        $table->string('payment_rec_id')->nullable();
        $table->string('do')->nullable();
        $table->string('co')->nullable();
        $table->string('delar_name')->nullable();
        $table->string('masking')->nullable();
        $table->string('unload_charge')->nullable();
        $table->string('extra_fare')->nullable();
        $table->string('vehicle_mode')->nullable();
        $table->string('no_of_trip')->nullable();
        $table->string('per_truck_rent')->nullable();
        $table->string('goods')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_ledgers');
    }
};
