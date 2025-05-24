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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('apply_date')->nullable();
            $table->string('status')->nullable();
            $table->string('leave_from')->nullable();
            $table->string('leave_to')->nullable();
            $table->string('leave_type')->nullable();
            $table->text('remark')->nullable();
            $table->text('created_by')->nullable();
            $table->text('ref_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
