<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Church extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name', 'short_description', 'description'];

    protected $fillable = [
        'name',
        'slug',
        'short_description',
        'description',
        'village',
        'banner_media_id',
        'preview_media_id',
        'latitude',
        'longitude',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function bannerMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'banner_media_id');
    }

    public function previewMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'preview_media_id');
    }

    public function services(): HasMany
    {
        return $this->hasMany(ChurchService::class)->orderBy('order');
    }

    public function contact(): HasOne
    {
        return $this->hasOne(ChurchContact::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ChurchImage::class)->orderBy('order');
    }
}