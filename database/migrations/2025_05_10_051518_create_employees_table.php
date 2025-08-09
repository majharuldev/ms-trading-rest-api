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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable();
            $table->string('email')->nullable();
            $table->string('join_date')->nullable();
            $table->string('designation')->nullable();
            $table->string('gender')->nullable();
            $table->string('mobile')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('address')->nullable();
            $table->string('image')->nullable();
            $table->string('salary')->nullable();
            $table->string('status')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('created_by')->nullable();
            $table->string('nid')->nullable();
            $table->string('blood_group')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
