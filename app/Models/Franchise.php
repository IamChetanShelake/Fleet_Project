<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Franchise extends Model
{
    protected $fillable = [
        'country_name',
        'currency',
        'has_tax',
        'tax_percentage',
        'is_active'
    ];

    protected $casts = [
        'has_tax' => 'boolean',
        'is_active' => 'boolean',
        'tax_percentage' => 'decimal:2'
    ];
}
