<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pod extends Model
{
    use HasFactory;

    protected $fillable = [
        'transport_id',
        'file_name',
        'original_name',
        'file_path',
    ];

     protected $appends = ['proof_of_delivery'];

    /**
     * Get the transport that owns the POD
     */
    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }

      public function getProofOfDeliveryAttribute()
{
    return $this->file_path 
        ? asset($this->file_path)
        : null;
}
}
