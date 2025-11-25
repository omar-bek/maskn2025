<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'avatar',
        'bio_ar',
        'bio_en',
        'company_name',
        'license_number',
        'experience_years',
        'specializations',
        'services',
        'website',
        'linkedin',
        'instagram',
        'facebook',
        'emirate',
        'area',
        'latitude',
        'longitude',
        'rating',
        'reviews_count',
        'is_featured',
        'is_premium',
        'premium_until'
    ];

    protected $casts = [
        'specializations' => 'array',
        'services' => 'array',
        'rating' => 'decimal:2',
        'is_featured' => 'boolean',
        'is_premium' => 'boolean',
        'premium_until' => 'datetime',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Helper methods
    public function getBioAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->bio_ar : $this->bio_en;
    }

    public function getSpecializationsArrayAttribute()
    {
        return is_array($this->specializations) ? $this->specializations : [];
    }

    public function getServicesArrayAttribute()
    {
        return is_array($this->services) ? $this->services : [];
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/' . ltrim($this->avatar, '/'));
        }

        return null;
    }
}
