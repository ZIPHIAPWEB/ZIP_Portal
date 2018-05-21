<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentRequirement extends Model
{
    protected $fillable = [
        'requirement_id',
        'status',
        'path'
    ];
}
