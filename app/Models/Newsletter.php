<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Newsletter extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['title'];

    protected $fillable = [
        'title',
        'year',
        'file_path',
        'file_name',
        'file_type',
        'is_active',
        'order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'year' => 'integer',
    ];

    /**
     * Get the download URL for the newsletter file.
     */
    public function getDownloadUrlAttribute(): string
    {
        return route('about.newsletter.download', $this->id);
    }
}
