<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DrivingTeam extends Model
{
    protected $guarded = [
      
    ];

    protected $casts = [
        'license_expiry' => 'date',
        'passportExpiryDate'=>'date',
        'InsuranceExpiryDate'=>'date',
        'LicenseExpiryDate'=>'date',
        'license_expiry'=>'date',
        'dob'=>'date',
        'status' => 'string',
        'total_trips' => 'integer',
        'experience_years' => 'integer'
    ];

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'driver_id');
    }
}
