<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $fillable = [
        'name',
        'country_id',
        'hub_id',
        'status',
        'postal_code',
        'latitude',
        'longitude',
        'timezone',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Geography::class, 'country_id');
    }

    public function hub(): BelongsTo
    {
        return $this->belongsTo(Hub::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
