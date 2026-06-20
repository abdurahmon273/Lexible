<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'status',
    ];

    public function words(): HasMany
    {
        return $this->hasMany(Word::class);
    }

    public function wordTranslations(): HasMany
    {
        return $this->hasMany(WordTranslation::class, 'target_language_id');
    }
}
