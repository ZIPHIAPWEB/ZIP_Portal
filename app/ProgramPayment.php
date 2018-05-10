<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramPayment extends Model
{
    protected $fillable = [
        'program_id',
        'name',
        'description'
    ];
}
