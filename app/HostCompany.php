<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HostCompany extends Model
{
    protected $fillable = [
        'name',
        'states'
    ];
}
