<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Ministry extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['title', 'short_description', 'description', 'sub_departments', 'goals'];

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'sub_departments',
        'goals',
        'banner_media_id',
        'order',
        'is_active',
    ];

    protected $casts = [
        'sub_departments' => 'array',
        'goals' => 'array',
        'is_active' => 'boolean',
    ];

    public function bannerMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'banner_media_id');
    }

    public function images()
    {
        return $this->hasMany(MinistryImage::class)->orderBy('order');
    }
}
