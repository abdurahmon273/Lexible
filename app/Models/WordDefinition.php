<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class WordDefinition extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'word_sense_id',
        'definition',
        'example',
        'source',
    ];

    public function sense(): BelongsTo
    {
        return $this->belongsTo(WordSense::class, 'word_sense_id');
    }
}
