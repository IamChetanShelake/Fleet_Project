<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class Driver extends Model
{
    use HasApiTokens;
    
    protected $fillable = [
        'driver_id',
        'name',
        'blood_group',
        'phone',
        'emergency_phone',
        'address',
        'license_number',
        'license_expiry',
        'license_type',
        'total_trips',
        'experience_years',
        'status',
        'avatar_path'
    ];

    protected $casts = [
        'license_expiry' => 'date',
        'total_trips' => 'integer',
        'experience_years' => 'integer'
    ];

    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}
