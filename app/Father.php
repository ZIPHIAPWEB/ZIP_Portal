<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Father extends Model
{
    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'occupation',
        'company',
        'contact_no'
    ];

    public function student()
    {
        return $this->belongsTo('App\Student', 'user_id', 'user_id');
    }
}
