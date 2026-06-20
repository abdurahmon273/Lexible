<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class WordSense extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'word_id',
        'part_of_speech',
        'level',
        'order_number',
        'meaning_note',
    ];

    public function word(): BelongsTo
    {
        return $this->belongsTo(Word::class);
    }

    public function definitions(): HasMany
    {
        return $this->hasMany(WordDefinition::class);
    }

    public function translations(): HasMany
    {
        return $this->hasMany(WordTranslation::class);
    }

    public function synonyms(): HasMany
    {
        return $this->hasMany(WordSynonym::class);
    }

    public function antonyms(): HasMany
    {
        return $this->hasMany(WordAntonym::class);
    }
}
