<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{
    protected $fillable = ['user_id', 'firstName', 'middleName', 'lastName', 'department', 'position', 'contact'];
}
