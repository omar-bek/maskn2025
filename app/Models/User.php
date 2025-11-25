<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type_id',
        'phone',
        'whatsapp',
        'address',
        'city',
        'country',
        'is_verified',
        'is_active',
        'email_verified_at',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'is_verified' => 'boolean',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relationships
    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    // Project relationships


    public function tenders()
    {
        return $this->hasMany(Tender::class, 'client_id');
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class, 'consultant_id');
    }

    public function designs()
    {
        return $this->hasMany(Design::class, 'consultant_id');
    }

    // Helper methods
    public function isClient()
    {
        return $this->userType && $this->userType->name === 'client';
    }

    public function isConsultant()
    {
        return $this->userType && $this->userType->name === 'consultant';
    }

    public function isAdmin()
    {
        return $this->userType && $this->userType->name === 'admin';
    }

    public function isContractor()
    {
        return $this->userType && $this->userType->name === 'contractor';
    }

    public function isSupplier()
    {
        return $this->userType && $this->userType->name === 'supplier';
    }

    public function getDashboardRoute()
    {
        if ($this->isAdmin()) {
            return route('admin.dashboard');
        }

        switch ($this->userType?->name) {
            case 'client':
                return route('client.dashboard');
            case 'consultant':
                return route('consultant.dashboard');
            case 'contractor':
                return route('contractor.dashboard');
            case 'supplier':
                return route('supplier.dashboard');
            default:
                return route('home');
        }
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/' . ltrim($this->avatar, '/'));
        }

        return null;
    }
}
