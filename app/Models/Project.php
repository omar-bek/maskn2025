<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'title',
        'description',
        'property_type',
        'style',
        'area',
        'location',
        'neighborhood',
        'floors',
        'majlis_count',
        'bedrooms',
        'guest_bedrooms',
        'bathrooms',
        'parking_spaces',
        'other_rooms',
        'finishing_level',
        'additional_features',
        'additional_notes',
        'estimated_cost',
        'budget_min',
        'budget_max',
        'status',
        'selected_consultant_id',
        'selected_contractor_id',
        'selected_supplier_id',
        'published_at',
        'consultant_selected_at',
        'design_ready_at',
        'contractor_selected_at',
        'supplier_selected_at',
        'started_at',
        'completed_at'
    ];

    protected $casts = [
        'area' => 'decimal:2',
        'estimated_cost' => 'decimal:2',
        'budget_min' => 'decimal:2',
        'budget_max' => 'decimal:2',
        'additional_features' => 'array',
        'published_at' => 'datetime',
        'consultant_selected_at' => 'datetime',
        'design_ready_at' => 'datetime',
        'contractor_selected_at' => 'datetime',
        'supplier_selected_at' => 'datetime',
        'started_at' => 'datetime',
        'completed_at' => 'datetime'
    ];

    // Relationships
    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function selectedConsultant()
    {
        return $this->belongsTo(User::class, 'selected_consultant_id');
    }

    public function selectedContractor()
    {
        return $this->belongsTo(User::class, 'selected_contractor_id');
    }

    public function selectedSupplier()
    {
        return $this->belongsTo(User::class, 'selected_supplier_id');
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }

    public function consultantOffers()
    {
        return $this->hasMany(Offer::class)->where('professional_type', 'consultant');
    }

    public function contractorOffers()
    {
        return $this->hasMany(Offer::class)->where('professional_type', 'contractor');
    }

    public function supplierOffers()
    {
        return $this->hasMany(Offer::class)->where('professional_type', 'supplier');
    }

    public function files()
    {
        return $this->hasMany(ProjectFile::class);
    }

    public function designFiles()
    {
        return $this->hasMany(ProjectFile::class)->where('file_type', 'design');
    }

    // Helper methods
    public function isPublished()
    {
        return $this->status === 'published';
    }

    public function isConsultantSelected()
    {
        return $this->status === 'consultant_selected';
    }

    public function isDesignReady()
    {
        return $this->status === 'design_ready';
    }

    public function isContractorBidding()
    {
        return $this->status === 'contractor_bidding';
    }

    public function isSupplierBidding()
    {
        return $this->status === 'supplier_bidding';
    }

    public function isInProgress()
    {
        return $this->status === 'in_progress';
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function getStatusTextAttribute()
    {
        $statuses = [
            'draft' => 'مسودة',
            'published' => 'منشور',
            'consultant_selected' => 'تم اختيار الاستشاري',
            'design_ready' => 'التصميم جاهز',
            'contractor_bidding' => 'مفتوح للمقاولين',
            'contractor_selected' => 'تم اختيار المقاول',
            'supplier_bidding' => 'مفتوح للموردين',
            'supplier_selected' => 'تم اختيار المورد',
            'in_progress' => 'قيد التنفيذ',
            'completed' => 'مكتمل',
            'cancelled' => 'ملغي'
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    public function getPropertyTypeTextAttribute()
    {
        $types = [
            'residential' => 'سكني',
            'commercial' => 'تجاري',
            'villa' => 'فيلا'
        ];

        return $types[$this->property_type] ?? $this->property_type;
    }

    public function getStyleTextAttribute()
    {
        $styles = [
            'modern' => 'عصري',
            'classic' => 'كلاسيكي',
            'traditional' => 'تقليدي'
        ];

        return $styles[$this->style] ?? $this->style;
    }

    public function getFinishingLevelTextAttribute()
    {
        $levels = [
            'low' => 'منخفض',
            'medium' => 'متوسط',
            'high' => 'عالي'
        ];

        return $levels[$this->finishing_level] ?? $this->finishing_level;
    }

    public function getAdditionalFeaturesTextAttribute()
    {
        if (!$this->additional_features) {
            return 'لا توجد إضافات';
        }

        $features = [
            'garden' => 'حديقة',
            'pool' => 'مسبح',
            'elevator' => 'مصعد',
            'basement' => 'قبو'
        ];

        $textFeatures = [];
        foreach ($this->additional_features as $feature) {
            if (isset($features[$feature])) {
                $textFeatures[] = $features[$feature];
            }
        }

        return empty($textFeatures) ? 'لا توجد إضافات' : implode(', ', $textFeatures);
    }

    // Get total rooms count
    public function getTotalRoomsAttribute()
    {
        return $this->bedrooms + $this->guest_bedrooms + $this->majlis_count + $this->other_rooms;
    }

    // Get total bathrooms count
    public function getTotalBathroomsAttribute()
    {
        return $this->bathrooms;
    }
}
