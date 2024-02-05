<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Primary extends Model
{
    protected $fillable = [
        'user_id',
        'school_name',
        'address',
        'date_graduated'
    ];


}
