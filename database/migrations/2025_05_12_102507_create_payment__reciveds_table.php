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
        Schema::create('payment__reciveds', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('bill_ref')->nullable();
            $table->string('amount')->nullable();
            $table->string('status')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('remarks')->nullable();
            $table->string('cash_type')->nullable();
            $table->string('created_by')->nullable();
            $table->string('ref_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment__reciveds');
    }
};
