<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['confirm_bot_token','green_percentage'])]
class GlobalSetting extends Model
{
    public static function current(): self
    {
        return static::query()->firstOrCreate(['id' => 1]);
    }
}
