<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = ['user_id', 'company', 'address', 'start_date', 'end_date', 'description'];

    public function student()
    {
        return $this->belongsTo('App\Student', 'user_id', 'user_id');
    }
}
