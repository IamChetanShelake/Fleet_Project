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
        Schema::table('driving_teams', function (Blueprint $table) {
            $table->string('name');
            $table->string('driver_id')->unique();
            $table->string('phone_number');
            $table->string('emergency_number');
            $table->text('address');
            $table->string('blood_group');
            $table->string('license_number')->unique();
            $table->date('license_expiry');
            $table->string('license_type');
            $table->string('experience');
            $table->string('driver_photo')->nullable();
            $table->string('license_photo')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('driving_teams', function (Blueprint $table) {
            $table->dropColumn([
                'name',
                'driver_id',
                'phone_number',
                'emergency_number',
                'address',
                'blood_group',
                'license_number',
                'license_expiry',
                'license_type',
                'experience',
                'driver_photo',
                'license_photo',
                'status'
            ]);
        });
    }
};
