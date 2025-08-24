<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'professional_id',
        'professional_type',
        'price',
        'description',
        'duration_days',
        'terms_conditions',
        'status',
        'client_notes',
        'responded_at',
        'attachments'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'attachments' => 'array',
        'responded_at' => 'datetime'
    ];

    // Relationships
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function professional()
    {
        return $this->belongsTo(User::class, 'professional_id');
    }

    // Helper methods
    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isAccepted()
    {
        return $this->status === 'accepted';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    public function isWithdrawn()
    {
        return $this->status === 'withdrawn';
    }

    public function getStatusTextAttribute()
    {
        $statuses = [
            'pending' => 'في الانتظار',
            'accepted' => 'مقبول',
            'rejected' => 'مرفوض',
            'withdrawn' => 'مسحوب'
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    public function getProfessionalTypeTextAttribute()
    {
        $types = [
            'consultant' => 'استشاري',
            'contractor' => 'مقاول',
            'supplier' => 'مورد'
        ];

        return $types[$this->professional_type] ?? $this->professional_type;
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 0) . ' درهم';
    }

    public function getDurationTextAttribute()
    {
        if (!$this->duration_days) {
            return 'غير محدد';
        }

        if ($this->duration_days < 30) {
            return $this->duration_days . ' يوم';
        } elseif ($this->duration_days < 365) {
            $months = round($this->duration_days / 30);
            return $months . ' شهر';
        } else {
            $years = round($this->duration_days / 365);
            return $years . ' سنة';
        }
    }
}
