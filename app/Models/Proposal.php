<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;

    protected $fillable = [
        'tender_id',
        'consultant_id',
        'proposal_text',
        'proposed_price',
        'duration_months',
        'terms_conditions',
        'attachments',
        'status',
        'client_notes'
    ];

    protected $casts = [
        'proposed_price' => 'decimal:2',
        'attachments' => 'array'
    ];

    // Relationships
    public function tender()
    {
        return $this->belongsTo(Tender::class);
    }

    public function consultant()
    {
        return $this->belongsTo(User::class, 'consultant_id');
    }

    public function proposalItems()
    {
        return $this->hasMany(ProposalItem::class);
    }

    // Helper methods
    public function getFormattedPriceAttribute()
    {
        return number_format($this->proposed_price, 0, '.', ',') . ' درهم إماراتي';
    }

    public function getFormattedDurationAttribute()
    {
        return $this->duration_months ? $this->duration_months . ' شهر' : 'غير محدد';
    }

    public function getAttachmentsUrlsAttribute()
    {
        if ($this->attachments && is_array($this->attachments)) {
            return array_map(function($attachment) {
                return asset('storage/' . $attachment);
            }, $this->attachments);
        }
        return [];
    }

    public function isAccepted()
    {
        return $this->status === 'accepted';
    }

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
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

    public function scopeByConsultant($query, $consultantId)
    {
        return $query->where('consultant_id', $consultantId);
    }
}
