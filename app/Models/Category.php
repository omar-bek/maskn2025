<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'category_order',
        'description'
    ];

    protected $casts = [
        'category_order' => 'integer'
    ];

    // Relationships
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    // Note: projectItems method removed as project_id field is not used

    // Helper methods
    public function getTotalPrice()
    {
        return $this->items()->sum('total_price') ?? 0;
    }

    public function getItemsCount()
    {
        return $this->items()->count();
    }

    // Scope for ordering
    public function scopeOrdered($query)
    {
        return $query->orderBy('category_order');
    }
}
