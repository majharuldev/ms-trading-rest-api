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
        Schema::create('vendor_ledgers', function (Blueprint $table) {
           $table->id();
            $table->string('customer')->nullable();
            $table->string('trip_id')->nullable();
            $table->string('date')->nullable();
            $table->string('load_point')->nullable();
            $table->string('unload_point')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('vehicle_no')->nullable();
            $table->string('trip_rent')->nullable();
            $table->string('advance')->nullable();
            $table->string('due_amount')->nullable();
          
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendor_ledgers');
    }
};
