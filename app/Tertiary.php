<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tertiary extends Model
{
    protected $fillable = [
        'user_id',
        'school_name',
        'address',
        'degree',
        'date_graduated'
    ];
}
