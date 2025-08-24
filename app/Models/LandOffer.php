<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LandOffer extends Model
{
    use HasFactory;

    protected $fillable = [
        'land_id',
        'offerer_id',
        'offer_type',
        'offer_price',
        'offer_message',
        'offerer_name',
        'offerer_phone',
        'offerer_email',
        'status'
    ];

    protected $casts = [
        'offer_price' => 'decimal:2'
    ];

    // Relationships
    public function land()
    {
        return $this->belongsTo(Land::class);
    }

    public function offerer()
    {
        return $this->belongsTo(User::class, 'offerer_id');
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeAccepted($query)
    {
        return $query->where('status', 'accepted');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

    // Accessors
    public function getOfferTypeTextAttribute()
    {
        $types = [
            'purchase' => 'شراء',
            'exchange' => 'تبادل'
        ];
        return $types[$this->offer_type] ?? $this->offer_type;
    }

    public function getStatusTextAttribute()
    {
        $statuses = [
            'pending' => 'معلق',
            'accepted' => 'مقبول',
            'rejected' => 'مرفوض'
        ];
        return $statuses[$this->status] ?? $this->status;
    }

    public function getFormattedOfferPriceAttribute()
    {
        if ($this->offer_type === 'exchange') {
            return $this->offer_price ?: 'مقابل أرض أخرى';
        }
        return number_format($this->offer_price) . ' ريال';
    }
}


