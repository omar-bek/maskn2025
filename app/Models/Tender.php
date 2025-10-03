<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tender extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'design_id',
        'title',
        'description',
        'requirements',
        'budget',
        'location',
        'deadline',
        'status',
        'is_featured',
        'views_count',
        'client_notes'
    ];

    protected $casts = [
        'budget' => 'decimal:2',
        'deadline' => 'date',
        'is_featured' => 'boolean'
    ];

    // Relationships
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function design()
    {
        return $this->belongsTo(Design::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function tenderItems()
    {
        return $this->hasMany(TenderItem::class);
    }

    // Helper methods
    public function getFormattedBudgetAttribute()
    {
        return $this->budget ? number_format($this->budget, 0, '.', ',') . ' درهم إماراتي' : 'غير محدد';
    }

    public function getFormattedDeadlineAttribute()
    {
        return $this->deadline ? $this->deadline->format('Y-m-d') : '';
    }

    public function getDaysRemainingAttribute()
    {
        if (!$this->deadline) return null;

        $days = now()->diffInDays($this->deadline, false);
        return $days > 0 ? $days : 0;
    }

    public function getProposalsCountAttribute()
    {
        return $this->proposals()->count();
    }

    public function isOpen()
    {
        return $this->status === 'open' && $this->deadline > now();
    }

    public function isExpired()
    {
        return $this->deadline < now();
    }

    // Scopes
    public function scopeOpen($query)
    {
        return $query->where('status', 'open')->where('deadline', '>', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
