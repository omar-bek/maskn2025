<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'design_id',
        'category_id',
        'item_name',
        'quantity',
        'unit',
        'unit_price',
        'total_price',
        'item_order',
        'notes'
    ];

    protected $casts = [
        'quantity' => 'float',
        'unit_price' => 'float',
        'total_price' => 'float',
        'item_order' => 'integer'
    ];

    // Relationships

    public function design()
    {
        return $this->belongsTo(Design::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Helper methods
    public function calculateTotalPrice()
    {
        if ($this->quantity && $this->unit_price) {
            return (float)$this->quantity * (float)$this->unit_price;
        }
        return 0.0;
    }

    public function updateTotalPrice()
    {
        $calculatedPrice = $this->calculateTotalPrice();
        $this->total_price = round($calculatedPrice, 2);
        $this->save();
    }

    // Scope for ordering
    public function scopeOrdered($query)
    {
        return $query->orderBy('item_order');
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    // Note: scopeByProject removed as project_id field is not used

    // Formatted attributes
    public function getFormattedQuantityAttribute()
    {
        return number_format((float)$this->quantity, 2);
    }

    public function getFormattedUnitPriceAttribute()
    {
        return number_format((float)$this->unit_price, 2) . ' درهم إماراتي';
    }

    public function getFormattedTotalPriceAttribute()
    {
        return number_format((float)$this->total_price, 2) . ' درهم إماراتي';
    }
}
