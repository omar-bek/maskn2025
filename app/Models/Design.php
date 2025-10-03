<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Design extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultant_id',
        'title',
        'description',
        'style',
        'area',
        'location',
        'price',
        'bedrooms',
        'bathrooms',
        'floors',
        'features',
        'consultant_name',
        'consultant_phone',
        'consultant_email',
        'main_image',
        'images',
        'status',
        'is_featured',
        'rating',
        'views_count'
    ];

    protected $casts = [
        'area' => 'decimal:2',
        'price' => 'decimal:2',
        'features' => 'array',
        'images' => 'array',
        'is_featured' => 'boolean',
        'rating' => 'decimal:2'
    ];

    // Relationships
    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }

    public function items()
    {
        return $this->hasMany(Item::class, 'design_id');
    }

    public function tenders()
    {
        return $this->hasMany(Tender::class);
    }

    // Helper methods
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0, '.', ',') . ' درهم إماراتي';
    }

    public function getFormattedAreaAttribute()
    {
        return number_format($this->area, 0, '.', ',') . ' متر مربع';
    }

    public function getMainImageUrlAttribute()
    {
        if ($this->main_image) {
            return asset('storage/' . $this->main_image);
        }
        return asset('images/design-placeholder.jpg');
    }

    public function getImagesUrlsAttribute()
    {
        if ($this->images && is_array($this->images)) {
            return array_map(function($image) {
                return asset('storage/' . $image);
            }, $this->images);
        }
        return [];
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByStyle($query, $style)
    {
        return $query->where('style', $style);
    }
}
