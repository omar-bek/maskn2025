<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'description',
        'is_public'
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'value' => 'string'
    ];

    // Helper method to get setting value
    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();

        if (!$setting) {
            return $default;
        }

        // Handle different types
        switch ($setting->type) {
            case 'json':
                return json_decode($setting->value, true) ?? $default;
            case 'image':
                return $setting->value ? Storage::url($setting->value) : $default;
            default:
                return $setting->value ?? $default;
        }
    }

    // Helper method to set setting value
    public static function set($key, $value, $type = 'text')
    {
        $setting = static::where('key', $key)->first();

        if (!$setting) {
            $setting = static::create([
                'key' => $key,
                'value' => $value,
                'type' => $type
            ]);
        } else {
            $setting->update([
                'value' => $value,
                'type' => $type
            ]);
        }

        return $setting;
    }

    // Get all public settings
    public static function getPublicSettings()
    {
        return static::where('is_public', true)->get()->mapWithKeys(function ($setting) {
            return [$setting->key => static::get($setting->key)];
        });
    }

    // Get image URL
    public function getImageUrlAttribute()
    {
        if ($this->type === 'image' && $this->value) {
            return Storage::url($this->value);
        }
        return null;
    }

    // Get JSON value
    public function getJsonValueAttribute()
    {
        if ($this->type === 'json') {
            return json_decode($this->value, true);
        }
        return null;
    }

    // Scope for public settings
    public function scopePublic($query)
    {
        return $query->where('is_public', true);
    }

    // Scope for image settings
    public function scopeImages($query)
    {
        return $query->where('type', 'image');
    }
}
