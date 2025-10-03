<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'tender_id',
        'category_id',
        'item_name',
        'quantity',
        'unit',
        'description',
        'item_order'
    ];

    protected $casts = [
        'quantity' => 'decimal:2'
    ];

    // Relationships
    public function tender()
    {
        return $this->belongsTo(Tender::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function proposalItems()
    {
        return $this->hasMany(ProposalItem::class);
    }

    // Helper methods
    public function getFormattedQuantityAttribute()
    {
        return $this->quantity ? number_format($this->quantity, 2) : '-';
    }

    // Scopes
    public function scopeOrdered($query)
    {
        return $query->orderBy('item_order');
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }
}
