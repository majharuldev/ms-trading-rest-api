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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('driver_name')->nullable();
            $table->string('driver_mobile')->nullable();
            $table->string('nid')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('address')->nullable();
            $table->string('note')->nullable();
            $table->string('license')->nullable();
            $table->string('license_expire_date')->nullable();
            $table->string('status')->nullable();
            $table->string('license_image')->nullable();
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
        Schema::dropIfExists('drivers');
    }
};
