<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transport extends Model
{
    protected $fillable = [
        'order_no',
        'franchise_id',
        'customer_id',
        'consignment_type',
        'consigner',
        'pickup_location',
        'source_pincode',
        'source_city',
        'source_state',
        'source_country',
        'source_building_no',
        'source_maps_link',
        'delivery_location',
        'address_line',
        'building_no',
        'dest_pincode',
        'dest_state',
        'dest_country',
        'dest_building_no',
        'dest_maps_link',
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
        'total_distance',
        'total_travel_time',
    ];

    protected $casts = [
        'pickup_datetime' => 'datetime',
        'delivery_date' => 'date',
        'expense_types' => 'array',
        'expense_amounts' => 'array',
        'expense_remarks' => 'array',
    ];

    /**
     * Get the customer that owns this transport.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the franchise that owns this transport.
     */
    public function franchise()
    {
        return $this->belongsTo(Franchise::class);
    }

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transport) {
            // Auto-generate order number if not set
            if (empty($transport->order_no)) {
                $transport->order_no = self::generateOrderNo();
            }
        });
    }

    /**
     * Generate a unique order number.
     * Format: XX001 (2 letters + 3 digit sequential number)
     */
    public static function generateOrderNo()
    {
        // Get the last order number
        $lastTransport = self::orderBy('id', 'desc')->first();
        
        $lastNumber = 0;
        if ($lastTransport && !empty($lastTransport->order_no)) {
            // Extract the numeric part from the last order number
            $numericPart = substr($lastTransport->order_no, 2);
            $lastNumber = (int) $numericPart;
        }
        
        // Increment and pad with zeros
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        
        // Generate with current year prefix (e.g., "TR" for 2026)
        $prefix = 'TR';
        
        return $prefix . $newNumber;
    }
}
