<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
      protected $appends = ['documents'];
    protected $hidden = [
    'invoice',
    'packageSlip',
    'deliveryChallan',
    'CargoDocs',
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
     * Generate a unique order number with franchise prefix.
     * Format: FRANCHISE-CODE001 (e.g., UAE-TR001, QTR-TR001, SAU-TR001)
     */
    public static function generateOrderNo()
    {
        // Get franchise ID from session
        $franchiseId = session('franchise_id');
        $franchiseCode = 'UAE'; // Default
        
        if ($franchiseId) {
            $franchise = self::where('franchise_id', $franchiseId)->first();
            if ($franchise && $franchise->franchise) {
                $countryName = $franchise->franchise->country_name;
                switch ($countryName) {
                    case 'Qatar':
                        $franchiseCode = 'QTR';
                        break;
                    case 'Saudi Arabia':
                        $franchiseCode = 'SAU';
                        break;
                    case 'United Arab Emirates':
                        $franchiseCode = 'UAE';
                        break;
                    default:
                        $franchiseCode = substr(strtoupper($countryName), 0, 3);
                }
            } else {
                // Fallback to session data
                $franchiseName = session('selected_franchise_name');
                if ($franchiseName) {
                    switch ($franchiseName) {
                        case 'Qatar':
                            $franchiseCode = 'QTR';
                            break;
                        case 'Saudi Arabia':
                            $franchiseCode = 'SAU';
                            break;
                        case 'United Arab Emirates':
                            $franchiseCode = 'UAE';
                            break;
                        default:
                            $franchiseCode = substr(strtoupper($franchiseName), 0, 3);
                    }
                }
            }
        }
        
        // Get the last order number for this franchise
        $lastTransport = self::where('order_no', 'like', $franchiseCode . '-%')
            ->orderBy('id', 'desc')
            ->first();
        
        $lastNumber = 0;
        if ($lastTransport && !empty($lastTransport->order_no)) {
            // Extract the numeric part from the last order number
            $parts = explode('-', $lastTransport->order_no);
            if (isset($parts[1])) {
                $numericPart = substr($parts[1], 2); // Skip 'TR' prefix
                $lastNumber = (int) $numericPart;
            }
        }
        
        // Increment and pad with zeros
        $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        
        // Generate with franchise prefix
        return $franchiseCode . '-TR' . $newNumber;
    }
    public function getDocumentsAttribute()
    {
        return [
            'invoice' => $this->invoice
                ? asset($this->invoice)
                : null,
    
            'packageSlip' => $this->packageSlip
                ? asset($this->packageSlip)
                : null,
    
            'deliveryChallan' => $this->deliveryChallan
                ? asset($this->deliveryChallan)
                : null,
    
            'CargoDocs' => $this->CargoDocs
                ? asset($this->CargoDocs)
                : null,
        ];
    }

      public function driver(): belongsTo //one consignment has one driver
    {
        return $this->belongsTo(Driver::class, 'assigned_driver_id', 'id');
    // Parameter 1: Related model
    // Parameter 2: Foreign key on transports table
    // Parameter 3: Owner key on drivers table
    
    }
}
