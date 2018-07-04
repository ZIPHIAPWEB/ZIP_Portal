<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialProvider extends Model
{
    protected $fillable = [
        'user_id',
        'provider_id',
        'provider'
    ];
}
