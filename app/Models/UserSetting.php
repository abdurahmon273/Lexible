<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserSetting extends Model
{
    use softDeletes;

    protected $fillable=[
      'user_id',
      'repeat_count',
    ];
}
