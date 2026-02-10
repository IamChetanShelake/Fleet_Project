<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'role_id',
        'franchise_id',
        'department',
        'position',
        'date_of_joining',
        'status',
        'profile_image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_joining' => 'date',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the franchise that owns the user.
     */
    public function franchise(): BelongsTo
    {
        return $this->belongsTo(Franchise::class);
    }

    /**
     * Get the role name for the user
     */
    public function getRoleNameAttribute()
    {
        return $this->role ? $this->role->name : 'No Role';
    }

    /**
     * Check if user belongs to a specific franchise
     */
    public function belongsToFranchise($franchiseId): bool
    {
        return $this->franchise_id == $franchiseId;
    }

    /**
     * Check if user is super admin (can access all franchises)
     */
    public function isSuperAdmin(): bool
    {
        return $this->franchise_id === null || $this->role_id === 1;
    }
}
