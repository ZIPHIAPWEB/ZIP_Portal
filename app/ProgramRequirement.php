<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProgramRequirement extends Model
{
    protected $fillable = ['program_id', 'name', 'description'];
}
