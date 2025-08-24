<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'display_name_ar',
        'display_name_en',
        'description_ar',
        'description_en'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    // Helper methods
    public function getDisplayNameAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->display_name_ar : $this->display_name_en;
    }

    public function getDescriptionAttribute()
    {
        return app()->getLocale() === 'ar' ? $this->description_ar : $this->description_en;
    }
}
