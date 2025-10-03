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
        'quantity' => 'decimal:2',
        'unit_price' => 'decimal:2',
        'total_price' => 'decimal:2',
        'item_order' => 'integer'
    ];

    // Relationships
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

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
            return $this->quantity * $this->unit_price;
        }
        return 0;
    }

    public function updateTotalPrice()
    {
        $this->total_price = $this->calculateTotalPrice();
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

    public function scopeByProject($query, $projectId)
    {
        return $query->where('project_id', $projectId);
    }

    // Formatted attributes
    public function getFormattedQuantityAttribute()
    {
        return number_format($this->quantity, 2);
    }

    public function getFormattedUnitPriceAttribute()
    {
        return number_format($this->unit_price, 2) . ' درهم إماراتي';
    }

    public function getFormattedTotalPriceAttribute()
    {
        return number_format($this->total_price, 2) . ' درهم إماراتي';
    }
}
