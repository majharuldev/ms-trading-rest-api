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
        Schema::create('stock_out_products', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('product_category')->nullable();
            $table->string('purchase_id')->nullable();
            $table->string('product_name')->nullable();
            $table->string('quantity')->nullable();
            $table->string('vehicle_name')->nullable();
            $table->string('driver_name')->nullable();
            $table->string('stock_in')->nullable();
            $table->string('stock_out')->nullable();
            $table->string('total_stock')->nullable();
            $table->string('ref_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_out_products');
    }
};
