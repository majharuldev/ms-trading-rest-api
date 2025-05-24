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
            $table->string('customer_name');
            $table->string('bill_date');
            $table->string('woring_date');
            $table->string('vehicle_no');
            $table->string('qty');
            $table->string('load_point');
            $table->string('unload_point');
            $table->string('bill_amount');
            $table->string('vat');
            $table->string('total_amount');
            $table->string('due_amount');
            $table->string('status');
            $table->string('created_by');
            $table->string('ref_id');
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
