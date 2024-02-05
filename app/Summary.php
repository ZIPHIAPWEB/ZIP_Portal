<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summary extends Model
{
    protected $fillable = [
        'year',
        'program',
        'total',
        'new_applicant',
        'assessed',
        'confirmed',
        'hired',
        'for_visa_interview',
        'visa_approved',
        'visa_denied',
        'cancel'
    ];
}
