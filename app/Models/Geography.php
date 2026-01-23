<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Geography extends Model
{
    protected $fillable = [
        'name',
        'code',
        'currency',
        'region',
        'description',
        'status',
        'created_by',
        'updated_by'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function cities(): HasMany
    {
        return $this->hasMany(City::class, 'country_id');
    }

    public function hubs(): HasMany
    {
        return $this->hasMany(Hub::class, 'country_id');
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
