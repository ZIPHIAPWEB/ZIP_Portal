<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    protected $fillable = [
        'year',
        'label',
        'value',
        'program'
    ];
}
