<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Word extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'language_id',
        'word',
        'phonetic',
        'audio_url',
        'status',
    ];

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function senses(): HasMany
    {
        return $this->hasMany(WordSense::class);
    }
}
