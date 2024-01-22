<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coordinator extends Model
{
    protected $fillable = [
        'user_id',
        'firstName',
        'middleName',
        'lastName',
        'department',
        'program',
        'position',
        'contact'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }

    public function selectedProgram()
    {
        return $this->hasOne(Program::class, 'id', 'program');
    }
}
