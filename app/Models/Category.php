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

    public function projectItems($projectId)
    {
        return $this->hasMany(Item::class)->where('project_id', $projectId);
    }

    // Helper methods
    public function getTotalPrice($projectId = null)
    {
        $query = $this->items();

        if ($projectId) {
            $query->where('project_id', $projectId);
        }

        return $query->sum('total_price') ?? 0;
    }

    public function getItemsCount($projectId = null)
    {
        $query = $this->items();

        if ($projectId) {
            $query->where('project_id', $projectId);
        }

        return $query->count();
    }

    // Scope for ordering
    public function scopeOrdered($query)
    {
        return $query->orderBy('category_order');
    }
}
