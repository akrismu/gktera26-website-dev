<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

class ChurchService extends Model
{
    use HasFactory, HasTranslations;

    public $translatable = ['service'];

    protected $fillable = ['church_id', 'service', 'order'];

    public function church(): BelongsTo
    {
        return $this->belongsTo(Church::class);
    }
}