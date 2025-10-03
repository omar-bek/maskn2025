<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'proposal_id',
        'tender_item_id',
        'unit_price',
        'total_price',
        'notes',
        'is_available'
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'is_available' => 'boolean'
    ];

    // Relationships
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function tenderItem()
    {
        return $this->belongsTo(TenderItem::class);
    }

    // Helper methods
    public function getFormattedUnitPriceAttribute()
    {
        return number_format($this->unit_price, 2) . ' درهم إماراتي';
    }

    public function getFormattedTotalPriceAttribute()
    {
        return number_format($this->total_price, 2) . ' درهم إماراتي';
    }

    // Calculate total price based on quantity and unit price
    public function calculateTotalPrice()
    {
        if ($this->tenderItem && $this->tenderItem->quantity) {
            $this->total_price = $this->tenderItem->quantity * $this->unit_price;
            $this->save();
        }
    }

    // Scopes
    public function scopeAvailable($query)
    {
        return $query->where('is_available', true);
    }
}
