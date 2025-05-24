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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('branch')->nullable();
            $table->string('person_name')->nullable();
            $table->string('type')->nullable();
            $table->string('amount')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('ref')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('accounts');
    }
};
