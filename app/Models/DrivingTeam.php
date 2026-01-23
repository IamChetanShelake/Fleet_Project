<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DrivingTeam extends Model
{
    protected $fillable = [
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
        'status',
        'kyc_status'
    ];

    protected $casts = [
        'license_expiry' => 'date',
        'status' => 'string'
    ];

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class, 'driver_id');
    }
}
