<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = ['user_id', 'company', 'address', 'start_date', 'end_date', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
