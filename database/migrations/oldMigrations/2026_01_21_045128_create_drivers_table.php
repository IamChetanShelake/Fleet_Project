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
            $table->string('driver_id')->unique();
            $table->string('name');
            $table->string('blood_group');
            $table->string('phone');
            $table->string('emergency_phone');
            $table->text('address');
            $table->string('license_number');
            $table->date('license_expiry');
            $table->string('license_type');
            $table->integer('total_trips')->default(0);
            $table->integer('experience_years');
            $table->enum('status', ['on_duty', 'off_duty', 'on_leave'])->default('off_duty');
            $table->string('avatar_path')->nullable();
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
