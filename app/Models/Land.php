<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Land extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'land_type',
        'area',
        'price',
        'city',
        'district',
        'address',
        'transaction_type',
        'description',
        'features',
        'contact_name',
        'contact_phone',
        'contact_whatsapp',
        'contact_email',
        'desired_locations',
        'status',
        'views',
        'images'
    ];

    protected $casts = [
        'area' => 'decimal:2',
        'price' => 'decimal:2',
        'features' => 'array',
        'desired_locations' => 'array',
        'images' => 'array',
        'views' => 'integer'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function offers()
    {
        return $this->hasMany(LandOffer::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeByCity($query, $city)
    {
        return $query->where('city', $city);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('land_type', $type);
    }

    public function scopeByTransactionType($query, $transactionType)
    {
        return $query->where('transaction_type', $transactionType);
    }

    // Accessors
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price) . ' ريال';
    }

    public function getFormattedAreaAttribute()
    {
        return number_format($this->area) . ' متر مربع';
    }

    public function getLocationAttribute()
    {
        return $this->city . ' - ' . $this->district;
    }

    public function getTypeTextAttribute()
    {
        $types = [
            'residential' => 'سكنية',
            'commercial' => 'تجارية',
            'agricultural' => 'زراعية',
            'industrial' => 'صناعية'
        ];
        return $types[$this->land_type] ?? $this->land_type;
    }

    public function getTransactionTypeTextAttribute()
    {
        $types = [
            'sale' => 'بيع',
            'exchange' => 'تبادل',
            'both' => 'بيع أو تبادل'
        ];
        return $types[$this->transaction_type] ?? $this->transaction_type;
    }

    public function getStatusTextAttribute()
    {
        $statuses = [
            'active' => 'نشط',
            'pending' => 'معلق',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي'
        ];
        return $statuses[$this->status] ?? $this->status;
    }

    public function getCityTextAttribute()
    {
        $cities = [
            'riyadh' => 'الرياض',
            'jeddah' => 'جدة',
            'dammam' => 'الدمام',
            'makkah' => 'مكة المكرمة',
            'medina' => 'المدينة المنورة',
            'taif' => 'الطائف',
            'abha' => 'أبها',
            'jubail' => 'الجبيل',
            'yanbu' => 'ينبع',
            'other' => 'مدينة أخرى'
        ];
        return $cities[$this->city] ?? $this->city;
    }
}


