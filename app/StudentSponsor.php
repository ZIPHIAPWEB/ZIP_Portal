<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentSponsor extends Model
{
    protected $fillable = [
        'user_id',
        'requirement_id',
        'status',
        'path'
    ];

    public function visa()
    {
        return $this->hasOne('App\SponsorRequirement', 'requirement_id', 'id');
    }
}
