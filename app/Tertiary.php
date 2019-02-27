<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tertiary extends Model
{
    protected $fillable = [
        'user_id',
        'school_name',
        'address',
        'degree',
        'date_graduated'
    ];

    public function school()
    {
        return $this->hasOne('App\School', 'id', 'school_name');
    }
}
