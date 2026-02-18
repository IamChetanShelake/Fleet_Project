<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Transport;
use Illuminate\Notifications\Notifiable;

class Driver extends Model
{
    use HasApiTokens;

    protected $fillable = [
        'driver_id',
        'name',
        'email',
        'nationality',
        'countryLevel',
        'dob',
        'blood_group',
        'phone',
        'alternateMobile',
        'franchise',
        'emergency_phone',
        'emergencyRelation',
        'residenceId',
        'passport',
        'passportExpiryDate',
        'residencePermitStatus',
        'LicenseCategory',
        'LicenseValidity',
        'vehicleBrandAndModel',
        'vehicleManufactureYear',
        'vehicleRegstrationNo',
        'vehicleFuelType',
        'heavyVehiclePermit',
        'InsuranceExpiryDate',
        'LicenseExpiryDate',
        'LicenseExpiryAlert',
        'drivingLicenseNo',
        'driverType',
        'driverPhoto',
        'signature',
        'drivingLicense',
        'vehicleInsurance',
        'consent',
        'TermsConditions',
        'RlcGatepass',
        'MicGatepass',
        'qatarId',
        'address',
        'license_number',
        'license_expiry',
        'license_type',
        'total_trips',
        'experience_years',
        'status',
        'activeStatus',
        'kyc_status',
        'createdBy',
        'avatar_path',
        'latitude',
        'longitude',
        'recordedAt',
    ];

    protected $casts = [
        'dob'                  => 'date',
        'license_expiry'       => 'date',
        'LicenseExpiryDate'    => 'date',
        'LicenseValidity'      => 'date',
        'passportExpiryDate'   => 'date',
        'InsuranceExpiryDate'  => 'date',
        'recordedAt'           => 'datetime',
        'alternateMobile'      => 'array',
        'LicenseExpiryAlert'   => 'boolean',
        'consent'              => 'boolean',
        'TermsConditions'      => 'boolean',
        'total_trips'          => 'integer',
        'experience_years'     => 'integer',
        'latitude'             => 'decimal:7',
        'longitude'            => 'decimal:7',
    ];

    /**
     * Boot the model — auto-generate driver_id.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($driver) {
            if (empty($driver->driver_id)) {
                $driver->driver_id = self::generateDriverId();
            }
        });
    }

    /**
     * Generate a unique driver ID: DRV001, DRV002, …
     */
    public static function generateDriverId(): string
    {
        $last = self::orderBy('id', 'desc')->first();
        $lastNumber = 0;

        if ($last && !empty($last->driver_id)) {
            $lastNumber = (int) substr($last->driver_id, 3);
        }

        return 'DRV' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Get the vehicles for this driver.
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
    
    public function consignments(): HasMany //consignment can have many drivers
    {
        return $this->HasMany(Transport::class);
    }
    
    public function getDocumentsAttribute()
    {
         return [
        'qatarId' => $this->qatarId ? asset($this->qatarId) : null,
        'residenceId' => $this->residenceId ? asset($this->residenceId) : null,
        'driverPhoto' => $this->driverPhoto ? asset($this->driverPhoto) : null,
        'signature' => $this->signature ? asset($this->signature) : null,
        'passport' => $this->passport ? asset($this->passport) : null,
        'drivingLicense' => $this->drivingLicense ? asset($this->drivingLicense) : null,
        'vehicleInsurance' => $this->vehicleInsurance ? asset($this->vehicleInsurance) : null,
    ];
    }
}
