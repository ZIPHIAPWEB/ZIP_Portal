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
        return $this->belongsTo('App\StudentSponsor', 'id', 'requirement_id')
                    ->withDefault([
                        'sponsor_id'    =>  false,
                        'name'          =>  false,
                        'description'   =>  false,
                        'path'          =>  false,
                        'status'        =>  false
                    ]);
    }

    public function getById($id)
    {
        return $this->find($id);
    }

    public function getBySponsor($sponsorId)
    {
        return $this->where('sponsor_id', $sponsorId)->orderBy('created_at', 'desc')->get();
    }
}
