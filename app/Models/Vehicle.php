<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\DrivingTeam;

class Vehicle extends Model
{
    protected $fillable = [
        'brand',
        'model',
        'vehicle_number',
        'purchase_date',
        'registration_year',
        'color',
        'fuel_type',
        'average',
        'max_weight',
        'current_odometer',
        'insurance_valid_till',
        'puc_expiry',
        'vehicle_type',
        'status',
        'driver_id',
        'image_path',
        'documents_path'
    ];

    protected $casts = [
        'purchase_date' => 'date',
        'registration_year' => 'integer'
    ];

    public function driver(): BelongsTo
    {
        return $this->belongsTo(DrivingTeam::class, 'driver_id');
    }
}
