<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Model
{
    use HasFactory, HasApiTokens;

    protected $fillable = [
        'name',
        'address',
        'mobile_no',
        'email',
        'password',
        'photo',
    ];

    protected $hidden = [
        'password',
    ];

    protected $appends = ['profile'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function getProfileAttribute()
    {
        return $this->photo ? asset('assets/'.$this->photo) : null;
    }
}
