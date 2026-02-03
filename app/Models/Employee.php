<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class Employee extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['name', 'position', 'bio'];

    protected $fillable = [
        'name',
        'position',
        'department',
        'photo_media_id',
        'bio',
        'order',
        'is_chairman',
    ];

    protected $casts = [
        'is_chairman' => 'boolean',
    ];

    public function photoMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'photo_media_id');
    }
}