<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $fillable = [
        'consigner',
        'pickup_location',
        'source_pincode',
        'source_city',
        'source_state',
        'source_country',
        'delivery_location',
        'address_line',
        'building_no',
        'dest_pincode',
        'dest_state',
        'dest_country',
        'pickup_datetime',
        'delivery_date',
        'receiver_name',
        'receiver_mobile',
        'party_lr_no',
        'packages',
        'weight',
        'invoice_no',
        'invoice_value',
        'trip_type',
        'vehicle_type',
        'assigned_vehicle_no',
        'assigned_driver',
        'assigned_driver_id',
        'handling_instructions',
        'third_party_name',
        'third_party_vehicle',
        'freight_weight',
        'weight_unit',
        'rate_per_unit',
        'total_packages',
        'rate_per_package',
        'fixed_cost',
        'expense_types',
        'expense_amounts',
        'expense_remarks',
        'final_notes',
        'status',
        'total_cost',
    ];

    protected $casts = [
        'pickup_datetime' => 'datetime',
        'delivery_date' => 'date',
        'expense_types' => 'array',
        'expense_amounts' => 'array',
        'expense_remarks' => 'array',
    ];
}
