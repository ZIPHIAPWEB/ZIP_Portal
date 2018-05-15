<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorRequirement extends Model
{
    protected $fillable = [
        'sponsor_id',
        'name',
        'description',
        'path'
    ];
}
