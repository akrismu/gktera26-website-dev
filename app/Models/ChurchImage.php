<?php

namespace App\Models;

use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChurchImage extends Model
{
    use HasFactory;

    protected $fillable = ['church_id', 'media_id', 'order'];

    public function church(): BelongsTo
    {
        return $this->belongsTo(Church:: class);
    }

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }
}