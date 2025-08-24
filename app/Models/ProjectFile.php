<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'uploaded_by',
        'file_type',
        'original_name',
        'file_name',
        'file_path',
        'mime_type',
        'file_size',
        'title',
        'description',
        'visibility'
    ];

    protected $casts = [
        'file_size' => 'integer'
    ];

    // Relationships
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function uploadedBy()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    // Helper methods
    public function getFileTypeTextAttribute()
    {
        $types = [
            'design' => 'تصميم',
            'contract' => 'عقد',
            'material_list' => 'قائمة المواد',
            'other' => 'أخرى'
        ];

        return $types[$this->file_type] ?? $this->file_type;
    }

    public function getVisibilityTextAttribute()
    {
        $visibilities = [
            'public' => 'عام',
            'client_only' => 'للعميل فقط',
            'professional_only' => 'للمحترفين فقط'
        ];

        return $visibilities[$this->visibility] ?? $this->visibility;
    }

    public function getFormattedFileSizeAttribute()
    {
        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getFileExtensionAttribute()
    {
        return pathinfo($this->original_name, PATHINFO_EXTENSION);
    }

    public function isImage()
    {
        return in_array($this->mime_type, [
            'image/jpeg',
            'image/png',
            'image/gif',
            'image/webp'
        ]);
    }

    public function isPdf()
    {
        return $this->mime_type === 'application/pdf';
    }

    public function isDocument()
    {
        return in_array($this->mime_type, [
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-excel',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
        ]);
    }
}
