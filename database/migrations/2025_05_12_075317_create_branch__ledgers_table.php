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
        Schema::create('branch__ledgers', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('remarks')->nullable();
            $table->string('mode')->nullable();
            $table->string('destination')->nullable();
            $table->string('trip_expense')->nullable();
            $table->string('due')->nullable();
            $table->string('cash_in')->nullable();
            $table->string('cash_out')->nullable();
            $table->string('ref')->nullable();
            $table->string('user_name')->nullable();
            $table->string('status')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('created_by')->nullable();
            $table->string('ref_id')->nullable();
            $table->string('customer')->nullable();
            $table->string('balance')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch__ledgers');
    }
};
