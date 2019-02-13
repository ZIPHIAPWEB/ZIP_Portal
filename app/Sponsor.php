<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsor extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'description'
    ];

    public function student()
    {
        return $this->belongsTo('App\Student', 'visa_sponsor_id', 'id');
    }

    public function sponsorRequirement()
    {
        return $this->hasMany('App\SponsorRequirement', 'sponsor_id', 'id');
    }
}
