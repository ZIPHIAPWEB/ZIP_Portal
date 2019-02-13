<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secondary extends Model
{
    protected $fillable = [
        'user_id',
        'school_name',
        'address',
        'date_graduated'
    ];
}
