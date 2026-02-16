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
        Schema::table('drivers', function (Blueprint $table) {
            $table->string('email')->unique()->after('name');
            $table->string('nationality')->nullable()->after('email');
            $table->date('dob')->nullable()->after('nationality');
            $table->json('alternateMobile')->nullable()->after('phone');
            $table->string('emergencyRelation')->nullable()->after('emergency_phone');
            $table->string('residenceId')->nullable()->after('emergencyRelation');
            $table->string('passport')->nullable()->after('residenceId');
            $table->date('passportExpiryDate')->nullable()->after('passport');
            $table->enum('residencePermitStatus', ['valid', 'expired'])->nullable()->after('passportExpiryDate');
            $table->string('LicenseCategory')->nullable()->after('residencePermitStatus');
            $table->date('LicenseValidity')->nullable()->after('LicenseCategory');
            $table->string('vehicleBrandAndModel')->nullable()->after('LicenseValidity');
            $table->string('vehicleManufactureYear')->nullable()->after('vehicleBrandAndModel');
            $table->string('vehicleRegstrationNo')->nullable()->after('vehicleManufactureYear');
            $table->string('vehicleFuelType')->nullable()->after('vehicleRegstrationNo');
            $table->enum('heavyVehiclePermit', ['valid', 'expired'])->nullable()->after('vehicleFuelType');
            $table->date('InsuranceExpiryDate')->nullable()->after('heavyVehiclePermit');
            $table->date('LicenseExpiryDate')->nullable()->after('InsuranceExpiryDate');
            $table->boolean('LicenseExpiryAlert')->default(false)->after('LicenseExpiryDate');
            $table->string('drivingLicenseNo')->nullable()->after('LicenseExpiryAlert');
            $table->string('driverType')->nullable()->after('drivingLicenseNo');
            $table->string('driverPhoto')->nullable()->after('driverType');
            $table->string('drivingLicense')->nullable()->after('driverPhoto');
            $table->string('vehicleInsurance')->nullable()->after('drivingLicense');
            $table->boolean('consent')->default(false)->after('vehicleInsurance');
            $table->boolean('TermsConditions')->default(false)->after('consent');
            $table->string('RlcGatepass')->nullable()->after('TermsConditions');
            $table->string('MicGatepass')->nullable()->after('RlcGatepass');
            $table->string('qatarId')->nullable()->after('MicGatepass');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('drivers', function (Blueprint $table) {
            $table->dropColumn([
                'email','nationality','dob','alternateMobile','emergencyRelation','residenceId','passport','passportExpiryDate',
                'residencePermitStatus','LicenseCategory','LicenseValidity','vehicleBrandAndModel','vehicleManufactureYear','vehicleRegstrationNo','vehicleFuelType','heavyVehiclePermit','InsuranceExpiryDate',
                'LicenseExpiryDate','LicenseExpiryAlert','drivingLicenseNo','driverType','driverPhoto','drivingLicense','vehicleInsurance','consent','TermsConditions','RlcGatepass','MicGatepass','qatarId',
            ]);
        });
    }
};
