<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdditionalRequirement extends Model
{
    protected $fillable = [
        'program_id',
        'name',
        'description',
        'path'
    ];

    public function studentAdditional()
    {
        return $this->belongsTo('App\StudentAdditional', 'id', 'requirement_id');
    }

    public function getById($id)
    {
        return $this->find($id);
    }

    public function getByProgram($programId)
    {
        return $this->where('program_id', '=', $programId)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
}
