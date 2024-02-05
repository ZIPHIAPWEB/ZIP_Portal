<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoordinatorAction extends Model
{
    protected $fillable = [
        'user_id',
        'client_id',
        'actions'
    ];
}
