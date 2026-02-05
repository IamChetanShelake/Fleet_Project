<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Hub extends Model
{
    protected $fillable = [
        'name',
        'country_id',
        'city_id',
        'code',
        'status',
        'address',
        'contact_person',
        'contact_number',
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

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
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
