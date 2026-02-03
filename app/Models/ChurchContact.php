<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChurchContact extends Model
{
    use HasFactory;

    protected $fillable = ['church_id', 'name', 'phone', 'address', 'email'];

    public function church(): BelongsTo
    {
        return $this->belongsTo(Church::class);
    }
}