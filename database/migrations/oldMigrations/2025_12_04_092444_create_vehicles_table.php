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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('brand');
            $table->string('model');
            $table->string('vehicle_number');
            $table->date('purchase_date');
            $table->integer('registration_year');
            $table->string('color');
            $table->string('fuel_type');
            $table->string('average');
            $table->string('max_weight');
            $table->string('current_odometer');
            $table->string('insurance_valid_till');
            $table->string('puc_expiry');
            $table->string('vehicle_type');
            $table->enum('status', ['available', 'not_available'])->default('available');
            $table->foreignId('driver_id')->nullable();
            $table->string('image_path')->nullable();
            $table->string('documents_path')->nullable();
            $table->timestamps();
            
            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
