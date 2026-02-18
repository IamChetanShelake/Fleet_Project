<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Transport;
use Illuminate\Notifications\Notifiable;

class Driver extends Model
{
    use HasApiTokens,Notifiable;
    
    protected $guarded = [
        
    ];

    protected $casts = [
        'license_expiry' => 'date',
        'passportExpiryDate'=>'date',
        'InsuranceExpiryDate'=>'date',
        'LicenseExpiryDate'=>'date',
        'license_expiry'=>'date',
        'dob'=>'date',
        'status'=>'string',
        'total_trips' => 'integer',
        'experience_years' => 'integer',
        'alternateMobile' => 'array',
    ];
    
    protected $appends = ['documents'];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($driver) {
            // Auto-generate driver_id if not set
            if (empty($driver->driver_id)) {
                $driver->driver_id = self::generateDriverId();
            }
        });
    }

    /**
     * Generate a unique driver ID.
     * Format: DR-001, DR-002, etc.
     */
    public static function generateDriverId()
    {
        // Get the last driver
        $lastDriver = self::orderBy('id', 'desc')->first();
        
        $lastNumber = 0;
        if ($lastDriver && !empty($lastDriver->driver_id)) {
            // Extract the numeric part from the last driver_id
            $parts = explode('-', $lastDriver->driver_id);
            if (isset($parts[1])) {
                $lastNumber = (int) $parts[1];
            }
        }
        
        // Increment and pad with zeros
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        
        return 'DR-' . $newNumber;
    }

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
