<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasicRequirement extends Model
{
    protected $fillable = [
        'requirement_id',
        'status',
        'path'
    ];
}
