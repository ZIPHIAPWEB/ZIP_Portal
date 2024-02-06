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
        'start_date',
        'date_graduated'
    ];

    public function school()
    {
        return $this->hasOne('App\School', 'id', 'school_name');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
