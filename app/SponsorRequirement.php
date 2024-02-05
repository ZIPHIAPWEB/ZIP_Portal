<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorRequirement extends Model
{
    protected $fillable = [
        'sponsor_id',
        'name',
        'description',
        'path'
    ];

    public function studentVisa()
    {
        return $this->belongsTo('App\StudentSponsor', 'id', 'requirement_id');
    }

    public function getBySponsor($sponsorId)
    {
        return $this->where('sponsor_id', $sponsorId)->orderBy('created_at', 'desc')->get();
    }
}
