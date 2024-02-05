<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAdditional extends Model
{
    protected $fillable = [
        'user_id',
        'requirement_id',
        'status',
        'path'
    ];

    public function additional()
    {
        return $this->hasOne('App\AdditionalRequirement', 'requirement_id', 'id');
    }

    public function getById($id)
    {
        return $this->find($id);
    }
}
